<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Modifica</title>
</head>
<body>
	<?php
		require_once("manage.php");
		$categorii=htmlspecialchars($_REQUEST['categorii']);
		$beneficii=htmlspecialchars($_REQUEST['beneficii']);
		$denumire=htmlspecialchars($_REQUEST['denumire']);
		$origine=htmlspecialchars($_REQUEST['origine']);
		$dezvoltare=htmlspecialchars($_REQUEST['dezvoltare']);
		$descriere=htmlspecialchars($_REQUEST['descriere']);
		$spatiu=htmlspecialchars($_REQUEST['spatiu']); //todo
		$perioada_cult=htmlspecialchars($_REQUEST['perioada']);
		$maniera_inmul=htmlspecialchars($_REQUEST['inmultire']);
		$id_gradina=htmlspecialchars($_SESSION['id_gradina']);
		$id_planta=htmlspecialchars($_REQUEST['id_planta']);
		
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
	   	$manage= new managePlante();
		$manage->updatePlanta($id_gradina,$id_planta,$categorii,$beneficii,$denumire,$origine,$dezvoltare,$descriere,$spatiu,$perioada_cult,$maniera_inmul,$files);
		
		//echo "<p>Datele au fost modificate cu succes! Veti fi redirectionat pe pagina contului</p>";
		header("Location: \\BoW/manage.php");
	?>
</body>
</html>