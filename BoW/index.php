<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>BoW</title>
	<link rel="stylesheet" type="text/css" href="resources/css/main.css">
	<script src="resources/js/afisareplante.js" type="text/javascript"></script>
	<script src="resources/js/afisarebutoane.js" type="text/javascript"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script>
		function start(){
			showButton();
			showPlants("top");
		}
	</script>
</head>
<body onload="start()">
<div class="container">
	<?php
		require_once("header.php");
		require_once("leftside.php");
	?>
	<div class="main-content">
		<h2>Plante</h2>
		<form>
			<label for="sort" class="sr-only">Display</label>
			<select name="afisare" onchange="showPlants(this.value)" id="sort">
				<option value="top">Top plante</option>
				<option value="new">Cele mai noi plante</option>
			</select>
		</form>
		<div id="plante"></div>
		<?php
			require_once("footer.php");
		?>
	</div>
</div>
</body>
</html>