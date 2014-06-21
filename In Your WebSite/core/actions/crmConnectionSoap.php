<?php
/** connection using soap 
la variable de sesión "recuperar_login" le indica a el código dedicado al manejo visual
en qué estado del proceso de recuperación de contraseña se encuentra. **/
session_start();
include('parameters.php');

// Login a webservices soap.
$soapClient = new SoapClient("http://crm.blancomartin.cl/service/v4_1/soap.php?wsdl");
try{
    $info = $soapClient->login(
	    array(
	        'user_name' => $username,
	        'password' => md5($password),
	        )
    );

}catch(SoapFault $fault){
    die("E_CONNECT");
}

$session = $info->id;


if($_POST['type_action'] == 'retrieve'){
	// accion de recuperar contraseña por medio del envío de un email
	//$emailEnc = md5($_POST['email']);
	$module_name = 'Contacts';
	//$query = "md5(username_c) = '".$userEnc."' AND md5(password_c) = '".$passEnc."'";
	//$order_by = "contacts.id DESC";

// Now let's try to find the contact we just created by e-mail address
	try {
	    $info = $soapClient->get_entry_list(
        	$session,
        	'Contacts',
        	"length( contacts_cstm.username_c ) > 0 and contacts.id in (
            SELECT eabr.bean_id
                FROM email_addr_bean_rel eabr JOIN email_addresses ea
                    ON (ea.id = eabr.email_address_id)
                WHERE eabr.deleted=0 AND ea.email_address = '".$_POST['email']."')",
        	'contacts.date_modified DESC',
        	0,
        	array('id','first_name','last_name'),
        	10,
        	-1
        );
	}
	catch (SoapFault $fault) {
	    die("Sorry, the service returned the following ERROR: ".$fault->faultcode."-".$fault->faultstring.".");
	}
 	$found = false;
	foreach ( $info->entry_list as $entry ) {
    	$found = true;
    	break;   	
	}
	if ( !$found ) {
		// en este punto tengo que decirle al usuario que no se encontró su email
		// en ninguna cuenta de nuestra base de datos.
	    die("Failure: Could not find the Contact by searching by email");
	}
	// en este punto en $entry->id tengo el id del contacto. con este, creo una tarea, la cual tiene un 
	// hash. Ese hash, es el que envío por email con un link para actualizar la contraseña.
	try {
    	$info = $soapClient->set_entry(
        $session,
        'Tasks',
        array(
            array('name' => 'name', 'value' => 'Cambio de Contraseña'),
            array('name' => 'parent_type', 'value' => 'Contacts'),
            array('name' => 'parent_id', 'value' => $entry->id),
            )
        );
	}
	catch (SoapFault $fault) {
    	die("Sorry, the service returned the following ERROR: ".$fault->faultcode."-".$fault->faultstring.".");
	}
	
	$_SESSION['recuperarlogin_view'] = 2;

}elseif($_POST['type_action'] == 'hash'){
	/* accion de introducir el hash para que deje cambiar la contraseña.
	Tengo el hash de la tarea (task). Con este hash hash me conecto a suite por soap
	una vez conectado, get_entry del hash y asi obtengo el parent_id.
	paso a la siguiente etapa.
	*/
	$_SESSION['task_hash'] = $_POST['task_hash'];
	try{
		$soapResponse = $soapClient->get_entry(
			$session,
			'Tasks',
			$_POST['task_hash'],
			array('id','name','parent_id','parent_type','date_due','status'),
			array(array('name' =>  'contacts', 'value' => array('id', 'name'))), // link name to fields array
			false // trackview
		);		
	}
	catch (SoapFault $fault) {
    	die("Sorry, the service returned the following ERROR: ".$fault->faultcode."-".$fault->faultstring.".");
	}
	echo '<pre>';
	echo '<br />';
	$vencimiento = $soapResponse->entry_list[0]->name_value_list[4]->value;
	//var_dump($vencimiento);
	//var_dump(strtotime($vencimiento));
	$ahora = date("Y-m-d h:i:s");
	//var_dump($ahora);
	//var_dump(strtotime($ahora));
	
	if ($vencimiento > $ahora && $soapResponse->entry_list[0]->name_value_list[2]->value != 'In Progress'){ 
		// se encuentra dentro del vencimiento
		$_SESSION['recuperarlogin_view'] = 3;
		$_SESSION['user_hash'] = $soapResponse->entry_list[0]->name_value_list[2]->value;
	}else{
		// clave para recuperar la contraseña vencida.
		die("La clave de recuperación de contraseña: {$_POST['task_hash']} se encuentra vencida");
	}
	

}elseif($_POST['type_action'] == 'newpass'){
	/* accion de generar nuevamente la contraseña. tengo el id del contacto
	con la contraseña confirmada hago un set_entry
	(ver temas de seguridad md5 si fuera posible)
	y cambio la contraseña del usuario.
	una vez cambiadaa la contraseña, hago un set_entry sobre la tarea
	y cambio el estado a "usada" .-.-.- */
	/*$info = $soapClient->set_entry(
        $session,
        'Tasks',
        array(
            array('name' => 'name', 'value' => 'Cambio de Contraseña'),
            array('name' => 'parent_type', 'value' => 'Contacts'),
            array('name' => 'parent_id', 'value' => $entry->id),
            )
        );*/
	
	//var_dump($_POST);die;
	try{
		$soapResponse = $soapClient->set_entry(
			$session,
			'Contacts',
			array(
				array(
					'name' => 'id', 
					'value' => $_POST['user_hash']
				),
				array(
					'name' => 'password_c', 
					'value' => $_POST['password_c']
				),
			)
		);	
	}
	catch (SoapFault $fault) {
    	die("Sorry, the service returned the following ERROR: ".$fault->faultcode."-".$fault->faultstring.".");
	}

	//var_dump($_POST);die;

	try{
		$soapResponse = $soapClient->set_entry(
			$session,
			'Tasks',
			array(
				array(
					'name' => 'id', 
					'value' => $_POST['task_hash'],
				),
				array(
					'name' => 'status', 
					'value' => 'Completed',
				),
			)
		);	
	}
	catch (SoapFault $fault) {
    	die("Sorry, the service returned the following ERROR: ".$fault->faultcode."-".$fault->faultstring.".");
	}	


	$_SESSION['recuperarlogin_view'] = 4;
	/* este estado, solamente prepara un nuevo mensaje para el usuario, indicandole que se cambió exitosamente
	 su contraseña, y ahora puede intentar loguear de nuevo, pero eso no se maneja en esta parte del proceso
	 sino en la parte visual.
	 */

}else{
	// accion de login normal


	// encripta usuario y contraseña para que no viaje la información abierta
	$userEnc = md5($_POST['username_c']);
	$passEnc = md5($_POST['password_c']);

	$module_name = 'Contacts';
	$query = "md5(username_c) = '".$userEnc."' AND md5(password_c) = '".$passEnc."'";
	$order_by = "contacts.id DESC";
	$offset = 0;
	$select_fields = array('id','first_name','last_name','email1');
	//$select_fields = array();
	$link_name_to_fields_array = array(
		array(
			'name' =>  'accounts', 
			'value' => 
				array('id', 'name')
			)
		);
	$max_results = 1;
	$deleted = 0;
	$favorites = false;

	try{
		$soapResponse = $soapClient->get_entry_list(
			$session,
			$module_name,
			$query,
			$order_by,
			$offset,
			$select_fields,
			$link_name_to_fields_array,
			$max_results,
			$deleted,
			$favorites
		);		
		//echo '<pre>';
		$array_empresas = $soapResponse->relationship_list[0]->link_list; // en este sub objeto, residen las empresas (primera relación de la lista traído por el soap anterior)
		// if(empty($array_empresas))  No tiene configuradas empresas

	}
	catch (SoapFault $fault) {
    	die("Sorry, the service returned the following ERROR: ".$fault->faultcode."-".$fault->faultstring.".");
	}
	

	// ahora trae las empresas (si es que tiene alguna)

	
	//var_dump($_SESSION['user_data']);
	if ($soapResponse->total_count == 1){ // autenticadautho
		$_SESSION['auth'] = 'OK';

	    $user_data = $soapResponse->entry_list[0]->name_value_list;
	    $_SESSION['user_arr'] = array();
	    $_SESSION['user_arr']['username'] = $_POST['username_c'];
	    foreach($user_data as $ud){
	        $_SESSION['user_arr'][$ud->name] = $ud->value;
	    }
	      
	}else{
	    $_SESSION['auth'] = 'FAIL';

	}

}

header('location:../../');


?>