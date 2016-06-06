<?php
	session_start();
	
?>
<html>
<head>
	<title>Delete Mesaj</title>
</head>
<body>
	<?php
		require_once("database.php");
		
		try{
			$db=new Database();
		}
		catch(Exception $e){
			die("Serverul a intalnit o eroare: ".$e->getMessage());
		}
		$sql="delete from mesaje";
		try{
			$db->execFetchAll($sql);
		}
		catch(Exception $e){
			die("Serverul a intalnit o eroare: ".$e->getMessage());
		}
		header("location:\\BoW/admin.php");
	?>
</body>
</html>