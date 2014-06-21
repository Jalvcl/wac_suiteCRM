<?php
	session_start();
	unset($_SESSION['user_arr']);
	unset($_SESSION['auth']);
	
	
	header('location:/');
?>