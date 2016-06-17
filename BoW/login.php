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
		<h2>LogIn</h2>
			<form action="apps/login.php" method="post">
				<div class="form-group">
					<label for="username">Username</label>
					<input name="nume" type="text" placeholder="Username" id="username" pattern="[a-zA-Z0-9-]+" title="Doar litere si cifre!" required>
				</div>
				<div class="form-group">
					<label for="password">Parola</label>
					<input name="passwd" type="password" placeholder="Parola" id="password" required>
				</div>
				<button name="buton" type="submit" class="btn-primary pull-right">
				Trimite!</button>
			</form>

		<a href="register.php" class="btn-primary">Cont nou!</a>
	</div>
	<?php
		require_once("leftside.php");
		require_once("footer.php");
	?>
</div>
</body>
</html>