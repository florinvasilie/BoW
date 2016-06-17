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
		require_once("UsersManag.php");

		$categorii=htmlspecialchars($_REQUEST['categorii']);
		$beneficii=htmlspecialchars($_REQUEST['beneficii']);
		$username=htmlspecialchars($_SESSION['username']);
		$denumire=htmlspecialchars($_REQUEST['denumire']);
		$origine=htmlspecialchars($_REQUEST['orgine']);
		$dezvoltare=htmlspecialchars($_REQUEST['dezvoltare']);
		$descriere=htmlspecialchars($_REQUEST['descriere']);
		$spatiu=htmlspecialchars($_REQUEST['spatiu']); //todo
		$perioada_cult=htmlspecialchars($_REQUEST['perioada']);
		$maniera_inmul=htmlspecialchars($_REQUEST['inmultire']);


		if(isset($_POST["submit"])) {
	   		if(!getimagesize($_FILES["fileToUpload"]["tmp_name"])){
	   			die("Nu este imagine!".header("refresh:1;url=\\BoW/test.php"));
	   		}
		}
		$image = file_get_contents($_FILES['fileToUpload']['tmp_name']);
		$ext = pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);

		$register= new register();
		$register->registerPlanta($categorii,$beneficii,$username,$denumire,$origine,$dezvoltare,$descriere,$spatiu,$perioada_cult,$maniera_inmul,$image,$ext);
		
		header("Location: \\BoW/index.php");
	?>

</body>
</html>