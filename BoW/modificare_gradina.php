<?php 
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Modificare</title>
	<script src="resources/js/afisarebutoane.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="resources/css/main.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body onload="showButton()">
<div class=container>
	<?php
		require_once("header.php");
		require_once("apps/database.php")

	?>
	<div class="main-content new-petition">
		<?php
			if (!ctype_digit($_GET['id'])){
				header("refresh:2;url=\\BoW/gradina.php");
				die("<p>Serverul a intampinat o eroare!</p>");
			}
			if(!$_GET["id"]){
				die("A aparut o eroare!");
			}
			$id=$_GET['id'];
			try{
					$db=new Database();
				}
				catch(Exception $e){
					die("Serverul a intalnit o eroare: ".$e->getMessage());
				}
				$sql="select NUME_GRADI, SPATIU_GRADI  from GRADINI where id_gradina='".$id."'";
				try{
					$rez1=$db->execFetchAll($sql);
				}
				catch(Exception $e){
					die("Serverul a intalnit o eroare: ".$e->getMessage());
				}
				foreach($rez1 as $r){
				?>
				<form action="apps/editgradina.php" method="post" >
					<div class="form-group">
						<label for="denumir">Nume gradina</label>
						<input name="nume_gradi" type="text" placeholder="Nume Gradina"  pattern="[a-zA-Z0-9\s]{1,32}" title="Doar litere si cifre!" value="<?=$r['NUME_GRADI'] ?>" required>
					</div>
					<div class="form-group">
						<label for="spa">Spatiul alocat gradinii(mp)</label> 
						<input id="space" name="spatiu" type="number" min="<?=$r['SPATIU_GRADI'] ?>" max="9999999999" placeholder="Spatiul alocat plaintei(mp)"  required>
					</div>
					<button class="btn-primary pull-right" name="submit" type="submit">
					Trimite!</button>
			
				</form>
				<?php
				}
		?>


	</div>
	<?php
		require_once("leftside.php");
		require_once("footer.php");
	?>
</div>
</body>
</html>