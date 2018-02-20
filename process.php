<?php session_start();

	if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $_REQUEST['captcha_code']) != 0){  
		echo 'false';
    }else{
    	echo 'true';
    }
    // unset($_SESSION['captcha_code']);


?>