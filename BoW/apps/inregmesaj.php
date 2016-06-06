<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Inregistrare contact</title>
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
	
	$sql="insert into mesaje(nume,email,mesaj) values (:nume,:email,:continut)";
	try{
		$db->execute($sql,array(array(":nume",htmlspecialchars($_REQUEST['nume']),-1),array(":email",htmlspecialchars($_REQUEST['email']),-1),array(":continut",htmlspecialchars($_REQUEST['continut']),-1)));
	}catch(Exception $e){
		die("Eroare server: ".$e->getMessage());
		header("refresh:5;url=\\BoW/index.php");
	}
		echo "<p>Mesajul a fost inregistrat! Veti fi redirectionat catre pagina principala in 5 secunde.</p>";
		header("Location: \\BoW/index.php");
?>
</body>
</html>