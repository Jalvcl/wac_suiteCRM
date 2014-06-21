<?php
// candidato a ser eliminado
// eliminar también de la instancia de suitecrm que está subida!
    /**** siteLogin.php *****
     * Abre el contacto
     * Verifica el usuario y la contraseña contra username_c y password_c
     * Si existe, devuelve el nombre de usuario y devuelve el accounts correspondiente (por ahora un solo account, pero en el futuro puede ser más de una cuenta, ya que el mismo usuario puede administrar más de un sitio)
     * Busco si la cuenta tiene un contrato existente. Si no existe, permite configurar uno nuevo.
     * 
     * Parámetros de entrada:
     * username_c
     * password_c
     * remember_c
     *
     *****/
    //var_dump($_POST);
    session_start();
    print(session_id());
    if(!isset($_POST)){
        die('Entrada no autorizada');
    }
    
    if(isset($_POST['remember_c'])){
        $year = time() + 31536000;
        setcookie('remember_me', $_POST['username_c'], $year);
    //    echo 'hay que recordar';
    }
    else{
        if(isset($_COOKIE['remember_me'])) {
    //        echo 'hay que olvidar';
            $past = time() - 100;
            setcookie(remember_me, gone, $past);
        }
    }
    
    $contact = new Contact();
    $contact->retrieve_by_string_fields(array('username_c' => $_POST['username_c']));
    if(!empty($contact->id)){
        if($contact->password_c == $_POST['password_c']){
            // password OK y contacto está OK
            // devuelve el usuario y devuelve la account
            $_SESSION['is_logged_in'] == 1;
            $_SESSION['login_status'] == 'Login OK';    
        }
        else{
            // contacto OK y password erróneo
            // contraseña errónea
            unset($_SESSION['is_logged_in']);
            $_SESSION['login_status'] == 'Usuario y/o contraseña erróneos';    
        }
    }
    else{
        // contacto no existe
        unset($_SESSION['is_logged_in']);
        $_SESSION['login_status'] == 'Usuario y/o contraseña erróneos';
        
    }
    //header('location:http://crmsync.me');

?>
