<?php
	include ("connect.php");
	$email=$_REQUEST['email'];
	$sql="Select ID from users where Email='$email'";
    $query=mysqli_query($conn,$sql);
    $result=mysqli_fetch_assoc($query);
    if($result)
    	echo 'false';
    else
    	echo 'true';
?>