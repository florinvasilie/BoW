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
		if(!htmlspecialchars($_REQUEST["parola"])){
			echo "<p>Nu ati specificat parola!</p>";
			die();
		}
		if(!htmlspecialchars($_REQUEST["nume"])){
			echo "<p>Nu ati introdus numele dvs!</p>";
			die();
		}
		if(!htmlspecialchars($_REQUEST["datan"])){
			echo "<p>Nu ati specificat data nasterii!</p>";
			die();
		}
		try{
		$db = new Database();
		}catch(Exception $e){
			header("refresh:2;url=\\BoW/index.php");
			die("Eroare server: ".$e->getMessage());
		}
		$sql="UPDATE utilizatori SET passwd=:parola,
	    	nume=:nume,
	    	data_nasterii=TO_DATE(:datan,'YYYY-MM-DD')
	    	WHERE username=:username";
		try{
			$db->execute($sql,array(array(":parola",htmlspecialchars($_REQUEST['parola']),-1),array(":nume",htmlspecialchars($_REQUEST['nume']),-1),array(":datan",htmlspecialchars($_REQUEST['datan']),-1),array(":username",htmlspecialchars($_REQUEST['username']),-1)));
		}catch(Exception $e){
			header("refresh:2;url=\\BoW/index.php");
			die("Eroare server: ".$e->getMessage());
		}
		$_SESSION['password']=$_REQUEST['parola'];
		echo "<p>Datele au fost modificate cu succes! Veti fi redirectionat pe pagina contului</p>";
		header("Location: \\BoW/userpage.php");
	?>
</body>
</html>