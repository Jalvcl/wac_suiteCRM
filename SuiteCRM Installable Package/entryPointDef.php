<?php
    /**** Definición de entrypoints para administración de cuentas
     * En sitio web
     * Módulos de
     * Login,
     * Recuperación de contraseña, 
     * Hash para recuperación de contraseña
     * Registro de nuevos usuarios,
     * Verificación de cuentas, y parametrización
     *
     ****/
  	$entry_point_registry['accessHashPwd'] = array(
        'file' => 'custom/extras/accessHashPwd.php',
        'auth' => false
    );
    $entry_point_registry['accessHashcreate'] = array(
        'file' => 'custom/extras/accessHashcreate.php',
        'auth' => false
    );
?>
