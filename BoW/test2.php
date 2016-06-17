<?php
 
	$connection=oci_connect("c##florin","1234","localhost/orcl");
	

	if(isset($_POST["submit"])) {
   		if(!getimagesize($_FILES["fileToUpload"]["tmp_name"])){
   			die("Nu este imagine!".header("refresh:1;url=\\BoW/test.php"));
   		}
	}

	$image = file_get_contents($_FILES['fileToUpload']['tmp_name']);
	
	//$path = $_FILES['fileToUpload']['name'];
	$ext = pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
	echo $ext;
	die();
	$sql = "INSERT INTO imagini (imagine) VALUES (empty_blob()) RETURNING imagine INTO :image";

	$result = oci_parse($connection, $sql);
	$blob = oci_new_descriptor($connection, OCI_D_LOB);
	oci_bind_by_name($result, ":image", $blob, -1, OCI_B_BLOB);
	oci_execute($result, OCI_DEFAULT) or die ("Unable to execute query");

	if(!$blob->save($image)) {
	    oci_rollback($connection);
	}
	else {
	    oci_commit($connection);
	}

	oci_free_statement($result);
	$blob->free();
/*
	$connection=oci_connect("c##florin","1234","localhost/orcl");
	$sql = "SELECT imagine FROM imagini";
	$stid = oci_parse($connection, $sql);
	oci_execute($stid);

	while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
		$img = $row['IMAGINE']->load();
		print('<img src="data:img/'.$ext.';base64,'.base64_encode($img).'" />');
}*/

 ?>