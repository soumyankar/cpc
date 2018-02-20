<?php
include("connect.php");
session_start();
$pinc=$_POST['id'];
// $pincode = (string)mysql_real_escape_string($pincode);
	$pincode=$pinc;
	// echo("alerrrrrt!!");
	$sql = "SELECT * FROM pincode WHERE pincode = ".$pincode.";";
	$data = $conn->query($sql);
	if($data == false)
	{
		echo mysqli_error($conn);
	}
	if($data->num_rows > 0)
	{
		
	$row = $data->fetch_assoc();

	$taluka = $row['Taluk'];
	$district = $row['Districtname'];
	$state = $row['statename'];
	$state = str_replace("\r\n", "", $state);
	$taluka = strtolower($taluka);
	$district = strtolower($district);
	$state = strtolower($state);
	header('Content-type: application/json');
	$array = array('Taluk'=>$taluka, 'Districtname'=>$district, 'statename'=>$state);
	
	echo json_encode($array);
}
else
echo("-1");
?>