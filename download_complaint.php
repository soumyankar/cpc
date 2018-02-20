<?php

	$c_id=$_GET['c_id'];
	$u_id=$_GET['u_id'];
	define("UPLOAD_DIR", getcwd());
	$name=UPLOAD_DIR."/uploads/" . $c_id . "_" . $u_id;
	// var_dump($name);

	//create a zip file
	$zip = new ZipArchive();
	$download_link=$name . '.zip';
	// var_dump($download_link);


	if($zip->open($download_link,ZIPARCHIVE::CREATE) !== true) {
	echo "could not open file";
	}

	$i=1;
	$search = $name."*";
	foreach (glob($search) as $file) 
	{
	// var_dump($file);
	$ext = substr($file, strrpos($file, '.'));
	$zip->addFile($file, $i . $ext);
	$i++;
	}

	$zip->close(); 
	header('Content-Type: application/zip');
	header('Content-disposition: attachment; filename="'.basename($download_link).'"');
	header('Content-Length: ' . filesize($download_link));
	readfile($download_link);

	//delete the created zip file from server
	unlink($download_link);
?>