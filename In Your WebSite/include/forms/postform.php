<?php
	if ( $_POST['first_name'] != "" ){
		header('Location: /falla');
	}else{
		// defino url del formulario
		$url = 'http://crm.blancomartin.cl/index.php?entryPoint=WebToLeadCapture'; 
		// Abrir una sesion CURL para hacer la llamada 
		$curl = curl_init($url);
		// Decirle a curl que se va a usar HTTP POST 
		curl_setopt($curl, CURLOPT_POST, true); 
		// Decirle a curl que NO devuelva encabezados, 
		curl_setopt($curl, CURLOPT_HEADER, false);
		// pero que retorne las respuestas
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $_POST); 
		// Se hace la llamada al WS REST call, devolviendo el resultado
		$response = curl_exec($curl);
		header( 'Location: ' . $_POST['redirect_url'] );
	}
?>
