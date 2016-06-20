<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Inregistrare gradina</title>
</head>
<body>
	<?php
		require_once("manage.php");

		$nume_gradi=htmlspecialchars($_REQUEST['nume_gradi']);
		$spatiu_gradi=htmlspecialchars($_REQUEST['spatiu']); //todo
		$username=htmlspecialchars($_SESSION['username']);


		
		$manageGradini= new manageGradini();
		$manageGradini->registerGradina($username,$nume_gradi,$spatiu_gradi);
		
		header("Location: \\BoW/gradina.php");
	?>

</body>
</html>