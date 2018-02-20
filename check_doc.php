<?php
	include ("connect.php");
	$c_id = $_POST['c_id'];
	// var_dump($c_id);
	$sql="Select * from admin_responses where Docs='yes' and Complaint_ID='$c_id'";
	$query=mysqli_query($conn,$sql);
	$result=mysqli_fetch_assoc($query);

	if(is_null($result))
		echo "no";
	else
		echo "yes";
?>