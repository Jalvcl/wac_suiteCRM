<?php
    session_start();
    print(session_id());
/*** Conector rest a sugar para intercambiar datos con el sitio web de 
crmsync.me y la instancia de sugarcrm que tengo instalada yo ***/
    include_once('parameters.php');
    
    // Proceso de login
    // Preparar parametros del origen
    // en base a variables que traigo desde parameters

    $session = login_rest($sugarurl,$username,$password);

    // elijo el módulo al que me quiero conectar
    $module = 'Contacts'; // es el módulo al que me conecto de entrada
    
    // elijo qué campos voy a necesitar.
    // por ejemplo para la autenticación necesito username_c, password_c, first_name, last_name, y si tengo una empresa asociada 
    // o todas las asociadas.

    // primero armo el mapeo... pero lo armo solamente para traer los nombres de los campos (no necesito mapear nada en realidad)
    $mapeo = array(
        array(0,'first_name'),
        array(1,'last_name'),
        array(2,'username_c'),
        array(3,'password_c'),
        array(4,'email1'),
        //array(8,'account_name','account_name','directo'),
    );

    // armo el select fields, como lo necesita el web service (name, value).....
    $select_fields = array();
    foreach($mapeo as $map){
        $select_fields[] = $map[1];
    }
    
    // en este punto, teniendo el id de sesión autenticado, más los parámetros que deseo traer,
    // voy a ejecutar un get_entry list, entregando como valor de referencia el username_c
    echo '<br>';
    echo $_POST['username_c'];
    $params = array(
        'session' => $session,
        'module_name' => $module,
        'query' => "username_c = '".$_POST['username_c']."' AND password_c = '".$_POST['password_c']."'",
        //'order_by' => 'id',
        //'offset' => 0,
        //'select_fields' => array('id','first_name','last_name','username_c','password_c'),
        //'link_name_to_fields_array' => array(array('name' =>  'email_addresses', 'value' => array('id', 'email_address', 'opt_out', 'primary_address'))),
        //'max_results' => 2,
        'deleted' => 0,
        'favorites' => false
    );
    // Traer registro del origen
    $record = hacer_rest($sugarurl, 'get_entry_list', $params);
    echo '<pre>';
    var_dump($record);die;
    
    
    function login_rest($dir_sugar,$username,$password){
        $url = $dir_sugar; 
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true); 
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
        $login = array(
            'user_auth' => array(
                'user_name' => $username, 
                'password' => md5($password)
                    ),
            'application' => 'LoginWebsite CRMSync.me', 
            'name_value_list' => array(
                'language' => 'es_es',
                'notifyonsave' => 'true'
                )
            ); 
        $json_login = json_encode($login);
        //var_dump($json_login);die;
        $postArgs = 'method=login&input_type=JSON&response_type=JSON&rest_data='
        . $json_login;
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postArgs); 
        $response = curl_exec($curl);
        $result = json_decode($response);
        curl_close($curl);  
        return $result->id;
    }

    function hacer_rest($dir_sugar, $method, $params){
        $curl = curl_init($dir_sugar);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        $json = json_encode($params);
        $postArgs = 'method=' . $method . '&input_type=JSON&response_type=JSON&rest_data=' . $json;
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postArgs); 
        $response = curl_exec($curl);
        $result = json_decode($response); 
        curl_close($curl);
        return $result;
    }
?>
