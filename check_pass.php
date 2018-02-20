<?php
	$a=$_REQUEST['new1'];
	$b=$_REQUEST['new2'];
	
	if(strcmp($a,$b) != 0){  
		echo 'false';
    }else{
    	echo 'true';
    }

?>