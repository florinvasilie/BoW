<?php
	session_start();
	
?>
<html>
<head>
	<title>Delete</title>
</head>
<body>
	<?php
		require_once("manage.php");
		if (!ctype_digit($_GET['id'])){
			header("refresh:2;url=\\BoW/gradina.php");
			die("<p>Serverul a intampinat o eroare!</p>");
		}
		$id=$_GET['id'];
		$managePlante= new managePlante();
		$managePlante->deletePlanta($id);
		
		header("location:\\BoW/gradina.php");
	?>
</body>
</html>