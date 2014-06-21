<?php 
    session_start();
    set_include_path( get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT'] );
    //include_once('../include/logo.php');
    if(!isset($_GET['lang'])){
        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    }else{
        $lang = $_GET['lang'];
        //header('location:/');
    }
    //echo 'Menu: '.$_GET['menu'];$_GET['menu'] = '';
    if(!isset($_GET['menu'])){
        $menu = 'main';  
    }else{
        $menu = $_GET['menu'];
    }
    include_once('lang/text.php');
    $page_control = array(
        'main'=>'main',
        'gracias' => 'gracias',
        'falla' => 'falla',
    );
    //var_dump(array_search('', $page_control));

?>
