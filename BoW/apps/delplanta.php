<?php
	session_start();
	
?>
<html>
<head>
	<title>Delete</title>
</head>
<body>
	<?php
		require_once("database.php");
		$id=$_GET['id'];
		try{
			$db=new Database();
		}
		catch(Exception $e){
			die("Serverul a intalnit o eroare: ".$e->getMessage());
		}
		$sql="delete from plante where id_planta=:id";
		try{
			$db->execute($sql,array(array(":id",htmlspecialchars($id),-1)));
		}
		catch(Exception $e){
			die("Serverul a intalnit o eroare: ".$e->getMessage());
		}
		$sql="delete from aprecieri where id_planta=:id";
		try{
			$db->execute($sql,array(array(":id",htmlspecialchars($id),-1)));
		}
		catch(Exception $e){
			die("Serverul a intalnit o eroare: ".$e->getMessage());
		}
		header("location:\\BoW/userpage.php");
	?>
</body>
</html>