<?php
?>
<!DOCTYPE html>
<html>
<head>
	<title>Modifica</title>
</head>
<body>
	<?php
		require_once("database.php");
		if(!htmlspecialchars($_REQUEST["id_planta"])){
			die();
		}
		if(!htmlspecialchars($_REQUEST["denumire"])){
			echo "<p>Nu ati specificat denumirea plantei!</p>";
			die();
		}
		if(!htmlspecialchars($_REQUEST["origine"])){
			echo "<p>Nu ati specificat originea plantei!</p>";
			die();
		}
		if(!htmlspecialchars($_REQUEST["descriere"])){
			echo "<p>Nu ati specificat descrierea plantei!</p>";
			die();
		}
		if(!htmlspecialchars($_REQUEST["imagine"])){
			echo "<p>Nu ati specificat imaginea plantei!</p>";
			die();
		}
		try{
		$db = new Database();
		}catch(Exception $e){
			header("refresh:2;url=\\BoW/index.php");
			die("Eroare server: ".$e->getMessage());
		}
		$sql="UPDATE plante SET categorie=:categorii,
	    	beneficii=:beneficii,
	    	data_postarii=SYSDATE,
	    	denumire=:denumire,
	    	origine=:origine,
	    	regim_dezv=:dezvoltare,
	    	descriere=:descriere,
	    	imagine=:imagine
	    	WHERE id_planta=:id_planta";
		try{
			$db->execute($sql,array(array(":categorii",htmlspecialchars($_REQUEST['categorie']),-1),array(":beneficii",htmlspecialchars($_REQUEST['beneficii']),-1),array(":denumire",htmlspecialchars($_REQUEST['denumire']),-1),array(":origine",htmlspecialchars($_REQUEST['origine']),-1),array(":dezvoltare",htmlspecialchars($_REQUEST['dezvoltare']),-1),array(":descriere",htmlspecialchars($_REQUEST['descriere']),-1),array(":imagine",htmlspecialchars($_REQUEST['imagine']),-1),array(":id_planta",htmlspecialchars($_REQUEST['id_planta']),-1)));
		}catch(Exception $e){
			header("refresh:2;url=\\BoW/index.php");
			die("Eroare server: ".$e->getMessage());
		}
		echo "<p>Datele au fost modificate cu succes! Veti fi redirectionat pe pagina contului</p>";
		header("Location: \\BoW/userpage.php");
	?>
</body>
</html>