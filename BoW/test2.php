<?php
 
	
	
$files=array();
		$fdata=$_FILES['fileToUpload'];
	if(isset($_POST["submit"])) {
		
		if(is_array($fdata['name'])){
		for($i=0;$i<count($fdata['name']);++$i){
		        $files[]=array(
			    'name'    =>$fdata['name'][$i],
			    'type'  => $fdata['type'][$i],
			    'tmp_name'=>$fdata['tmp_name'][$i],
			    'error' => $fdata['error'][$i], 
			    'size'  => $fdata['size'][$i]  
			    );
		    }
		}else $files[]=$fdata;
	} 
	
	foreach ($files as $file) {
		if(!getimagesize($file["tmp_name"])){
   			die("Nu este imagine!".header("refresh:1;url=\\BoW/test.php"));
   		}
   		echo $file['name'];
   	}
   	$sql = "INSERT INTO imagini (imagine) VALUES (empty_blob()) RETURNING imagine INTO :image";
   	die();
   	$connection=oci_connect("c##florin","1234","localhost/orcl");
   	foreach ($files as $file) {
		$result = oci_parse($connection, $sql);
		$blob = oci_new_descriptor($connection, OCI_D_LOB);
		oci_bind_by_name($result, ":image", $blob, -1, OCI_B_BLOB);
		oci_execute($result, OCI_DEFAULT) or die ("Unable to execute query");
		$image = file_get_contents($file['tmp_name']);
		if(!$blob->save($image)) {
	    oci_rollback($connection);
		}
		else {
		    oci_commit($connection);
		}

		oci_free_statement($result);
		$blob->free(); 

    	echo $file['name'];
    	
	}


//$image = file_get_contents($_FILES['fileToUpload']['tmp_name']);
	
	//$path = $_FILES['fileToUpload']['name'];
	//$ext = pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
	//echo $ext;
	$connection=oci_connect("c##florin","1234","localhost/orcl");
	$sql = "SELECT imagine FROM imagini";
	$stid = oci_parse($connection, $sql);
	oci_execute($stid);

	while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
		$img = $row['IMAGINE']->load();
		print('<img src="data:img/;base64,'.base64_encode($img).'" />');



}
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
	
}*/

 ?>