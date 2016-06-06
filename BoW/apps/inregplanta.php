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
		require_once("database.php");
		try{
			$db= new Database();
		}catch(Exception $e){
			die("Eroare server: ".$e->getMessage());
			header("refresh:5;url=\\BoW/index.php");
		}
		$sql="insert into plante(categorie,beneficii,data_postarii,username,vizualizari,denumire,origine,regim_dezv,descriere,imagine)". 
		"values(:categorii,:beneficii,SYSDATE,:username,0,:denumire,:origine,:dezvoltare,:descriere,:imagine)";

		try{
			$db->execute($sql,array(array(":categorii",$_REQUEST['categorii'],-1),array(":beneficii",htmlspecialchars($_REQUEST['beneficii']),-1),
			array(":username",htmlspecialchars($_SESSION['username']),-1),array(":denumire",htmlspecialchars($_REQUEST['denumire']),-1),array(":origine",htmlspecialchars($_REQUEST['origine']),-1),array(":dezvoltare",htmlspecialchars($_REQUEST['dezvoltare']),-1),array(":descriere",htmlspecialchars($_REQUEST['descriere']),-1),array(":imagine",htmlspecialchars($_REQUEST['imagine']),-1)));
		}catch(Exception $e){
			die("Eroare server: ".$e->getMessage()."Incercati mai tarziu!");
			header("refresh:5;url=\\BoW/index.php");
		}
		echo "<p>Planta a fost inregistrata! Veti fi redirectat catre pagina principala in 5 secunde.</p>";
		header("Location: \\BoW/index.php");
	?>

</body>
</html>