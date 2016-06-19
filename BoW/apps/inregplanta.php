<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Inregistrare planta</title>
</head>
<body>
	<?php
		require_once("manage.php");

		$categorii=htmlspecialchars($_REQUEST['categorii']);
		$beneficii=htmlspecialchars($_REQUEST['beneficii']);
		$username=htmlspecialchars($_SESSION['username']);
		$denumire=htmlspecialchars($_REQUEST['denumire']);
		$origine=htmlspecialchars($_REQUEST['origine']);
		$dezvoltare=htmlspecialchars($_REQUEST['dezvoltare']);
		$descriere=htmlspecialchars($_REQUEST['descriere']);
		$spatiu=htmlspecialchars($_REQUEST['spatiu']); //todo
		$perioada_cult=htmlspecialchars($_REQUEST['perioada']);
		$maniera_inmul=htmlspecialchars($_REQUEST['inmultire']);


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
	   			die("Nu este imagine!".header("refresh:1;url=\\BoW/planta_noua.php"));
	   		}
	   		//echo $file['name'];
	   	}

		$register= new register();
		$register->registerPlanta($categorii,$beneficii,$username,$denumire,$origine,$dezvoltare,$descriere,$spatiu,$perioada_cult,$maniera_inmul,$files);
		
		header("Location: \\BoW/index.php");
	?>

</body>
</html>