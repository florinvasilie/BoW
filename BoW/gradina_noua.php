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
			<h2>Gradina Noua</h2>
			<form action="apps/inreggradina.php" method="post">
				<div class="form-group">
					<label for="denumir">Nume gradina</label>
					<input name="nume_gradi" type="text" placeholder="Nume Gradina" pattern="[a-zA-Z0-9-]{1,32}" title="Doar litere si cifre!" required>
				</div>
				<div class="form-group">
					<label for="spa">Spatiul alocat gradinii(mp)</label> 
					<input id="space" name="spatiu" type="number" min="1" max="9999999999" placeholder="Spatiul alocat plaintei(mp)" required>
				</div>
				<button class="btn-primary pull-right" name="submit" type="submit">Posteaza
				</button>
			</form>
		</div>
		<?php 
			require_once("footer.php");
		?>
	</div>
</body>
</html>