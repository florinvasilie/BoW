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
		if(isset($_SESSION['admin']) && $_SESSION['admin']=="ok"){
			$id=$_GET['id'];
			try{
				$db=new Database();
			}
			catch(Exception $e){
				die("Serverul a intalnit o eroare: ".$e->getMessage());
			}
			$sql="delete from utilizatori where username=:id";
			try{
				$db->execute($sql,array(array(":id",htmlspecialchars($id),-1)));
			}
			catch(Exception $e){
				die("Serverul a intalnit o eroare: ".$e->getMessage());
			}
			$sql="delete from plante where username=:id";
			try{
				$db->execute($sql,array(array(":id",htmlspecialchars($id),-1)));
			}
			catch(Exception $e){
				die("Serverul a intalnit o eroare: ".$e->getMessage());
			}
			header("location:\\BoW/admin.php");
	}
	else{
		header("Location:\\BoW/index.php");
	}
	?>
</body>
</html>