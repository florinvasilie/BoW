<?php
	session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Voteaza</title>
</head>
<body>
	<?php
		require_once("database.php");

		$id=$_GET['id'];

		try{
			$db=new Database();
		}catch(Exception $e){
			header("refresh:5;url=\\BoW/index.php");
			die("A aparut o eroare: ".$e->getMessage().". Veti fi redirectionat in 5 secunde");
		}
		$sql="insert into aprecieri (id_planta, username) values (:id,'".$_SESSION['username']."')";
		try{
			$db->execute($sql,array(array(":id",$id,-1)));
		}catch(Exception $e){
			header("refresh:5;url=\\BoW/index.php");
			die("A aparut o eroare: ".$e->getMessage().". Veti fi redirectionat in 5 secunde");
		}
		echo "<p>Ati votat. Multumim! Veti fi redirectionat.</p>";
		header("Location: \\BoW/details.php?id=".$id);
	?>
</body>
</html>