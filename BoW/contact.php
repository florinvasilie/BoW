<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>BoW</title>
	<link rel="stylesheet" type="text/css" href="resources/css/main.css">
	<script src="resources/js/afisarebutoane.js" type="text/javascript"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body onload="showButton()">
<div class="container">
<?php
	require_once("header.php");
?>
	<div class="main-content new-petition">
		<h2>Contacteaza-ne</h2>
		<form action="apps/inregmesaj.php" method="post">
			<div class="form-group">
				<label for="username">Nume</label>
				<input name="nume" type="text" placeholder="Nume" id="username" required>
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input id="email" name="email" type="email" placeholder="Email" required>
			</div>
			<div class="form-group">
				<label for="message">Mesaj</label>
				<textarea name="continut" id="message" required></textarea>
			</div>
			<button class="btn-primary pull-right" name="buton" type="submit">
			Trimite!</button>
		</form>
	</div>
	<?php
		require_once("leftside.php");
		require_once("footer.php");
	?>
</div>
</body>
</html>