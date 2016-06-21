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
			$id_gradina=$_SESSION['id_gradina'];
			try{
				$db=new Database();
			}
			catch(Exception $e){
				die("Serverul a intalnit o eroare: ".$e->getMessage());
			}
			$sql="select CATEGORIE, BENEFICII, DENUMIRE, ORIGINE, REGIM_DEZV, DESCRIERE,SPATIU, PERIOADA_CULT, MANIERA_INMUL  from plante where id_planta='".$id."'";
			try{
				$rez1=$db->execFetchAll($sql);
			}
			catch(Exception $e){
				die("Serverul a intalnit o eroare: ".$e->getMessage());
			}
			try{
				$rez=$db->execFetchAll("SELECT SPATIU_GRADI FROM GRADINI where ID_GRADINA=:req",array(array(":req",($id_gradina),-1)));
			}catch(Exception $e){
				header("refresh:5;url=\\BoW/index.php");
				die("Eroare server: ".$e->getMessage());
			}
			foreach ($rez as $r) {
				$spatiu=$r['SPATIU_GRADI'];
			}
			foreach($rez1 as $r){
				?>
				<form action="apps/editplanta.php" method="post" enctype="multipart/form-data">
				
					<div class="form-group">
					<label for="den">Id_Planta</label>
					<input id="den" name="id_planta" type="text" value=<?=$id ?> readonly>
					</div>
					<div class="form-group">
						<label for="denumir">Denumire planta</label>
						<input name="denumire" type="text" placeholder="Denumire planta"   pattern="[a-zA-Z0-9\s]{1,50}" title="Doar litere si cifre!" value="<?=$r['DENUMIRE'] ?>" required>
					</div>
					<div class="form-group">
						<label for="category">Categorie planta</label>
						<input name="categorii" type="text" placeholder="Categorie planta" pattern="[a-zA-Z0-9\s]{1,50}" title="Doar litere si cifre!" value="<?=$r['CATEGORIE'] ?>" required>
					</div>
					<div class="form-group">
						<label for="benefits">Beneficiile plantei</label>
						<input name="beneficii" type="text" placeholder="Beneficiile plantei" pattern="[a-zA-Z0-9\s]{1,50}" title="Doar litere si cifre!" value="<?=$r['BENEFICII'] ?>" required>
					</div>
					<div class="form-group">
						<label for="dezv">Regim de dezvoltare</label>
						<input name="dezvoltare" type="text" placeholder="Regim de dezvoltare" pattern="[a-zA-Z0-9\s]{1,50}" title="Doar litere si cifre!" value="<?=$r['REGIM_DEZV'] ?>" required>
					</div>
					<div class="form-group">
						<label for="per">Perioada cultivarii</label>
						<input id="perioad" name="perioada" type="text" placeholder="Perioada cultivarii" pattern="[a-zA-Z0-9\s]{1,50}" title="Doar litere si cifre!" value="<?=$r['PERIOADA_CULT'] ?>" required>
					</div>
					<div class="form-group">
						<label for="inm">Maniera Inmultire</label>
						<input id="inmul" name="inmultire" type="text" placeholder="Maniera inmultire" pattern="[a-zA-Z0-9\s]{1,50}" title="Doar litere si cifre!" value="<?=$r['MANIERA_INMUL'] ?>" required>
					</div>
					<div class="form-group">
						<label for="orgi">Originea plantei</label>
						<input id="origin" name="origine" type="text" placeholder="Originea plantei" pattern="[a-zA-Z0-9\s]{1,50}" title="Doar litere si cifre!" value="<?=$r['ORIGINE'] ?>" required>
					</div>
					<div class="form-group">
						<label for="spa">Spatiul alocat plantei(mp)</label> 
						<input id="space" name="spatiu" type="number" min="1" max=<?=$spatiu ?> placeholder="Spatiul alocat plantei(mp)"  required>
					</div>
					<div class="form-group">
						<label for="img">Incarca imagine</label>
						<input type="file" name="fileToUpload[]" id="fileToUpload"  accept="image/*" multiple="" required>
					</div>
					<div class="form-group">
						<label for="desc">Descriere</label>
						<textarea name="descriere" id="desc" required><?=$r['DESCRIERE'] ?></textarea>
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