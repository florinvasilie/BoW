<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Modifica</title>
</head>
<body>
	<?php
		require_once("manage.php");
	
		$spatiu=htmlspecialchars($_REQUEST['spatiu']); //todo
		$nume_gradi=htmlspecialchars($_REQUEST['nume_gradi']);
		$id_gradina=htmlspecialchars($_SESSION['id_gradina']);
	
		
	   	$manage= new manageGradini();
		$manage->updateGradina($id_gradina,$nume_gradi,$spatiu);
		
		//echo "<p>Datele au fost modificate cu succes! Veti fi redirectionat pe pagina contului</p>";
		header("Location: \\BoW/manage.php");
	?>
</body>
</html>