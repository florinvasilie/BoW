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
			$id=$_GET['id'];
			try{
					$db=new Database();
				}
				catch(Exception $e){
					die("Serverul a intalnit o eroare: ".$e->getMessage());
				}
				$sql="select denumire,categorie,beneficii,origine,regim_dezv,descriere,imagine from plante where id_planta='".$id."'";
				try{
					$rez=$db->execFetchAll($sql);
				}
				catch(Exception $e){
					die("Serverul a intalnit o eroare: ".$e->getMessage());
				}
				foreach($rez as $r){
				?>
				<form action="apps/editplanta.php" method="post">
				
					<div class="form-group">
					<label for="den">Id_Planta</label>
					<input id="den" name="id_planta" type="text" value=<?=$id ?> readonly>
					</div>
					<div class="form-group">
					<label for="den">Denumire</label>
					<input id="den" name="denumire" type="text" value=<?=$r['DENUMIRE'] ?> required>
					</div>
					
					<div class="form-group">
						<label for="category">Categorii plante</label>
						<select name="categorii" placeholder="Categorii plante" id="category">
							<option value="Mediteraneene" <?php if ("Mediteraneene" ==$r['CATEGORIE'] ) echo "selected"; ?>>Plante mediteraneene</option>
							<option value="Asiatice" <?php if ("Asiatice" ==$r['CATEGORIE'] ) echo "selected"; ?>>Plante asiatice</option>
							<option value="Conifere" <?php if ("Conifere" ==$r['CATEGORIE'] ) echo "selected"; ?>>Conifere</option>
							<option value="Foioase" <?php if ("Foioase" ==$r['CATEGORIE'] ) echo "selected"; ?>>Foioase</option>
							<option value="Stepa" <?php if ("Stepa" ==$r['CATEGORIE'] ) echo "selected"; ?>>Plante de stepa</option>
						</select>
					</div>
					<div class="form-group">
						<label for="benefits">Beneficiile plantei</label>
						<select name="beneficii" placeholder="Beneficiile plantei" id="category">
							<option value="Estetica" <?php if ("Estetica" ==$r['BENEFICII'] ) echo "selected"; ?>>Estetica</option>
							<option value="Parfum" <?php if ("Parfum" ==$r['BENEFICII'] ) echo "selected"; ?>>Parfum</option>
							<option value="Medicinal" <?php if ("Medicinal" ==$r['BENEFICII'] ) echo "selected"; ?>>Uz medicinal</option>
							<option value="Fructifer" <?php if ("Fructifer" ==$r['BENEFICII'] ) echo "selected"; ?>>Plante fructifere</option>
						</select>
					</div>
					<div class="form-group">
						<label for="orig">Origine</label>
						<input id="orig" name="origine" type="text"  value=<?=$r['ORIGINE'] ?> required>
					</div>
					<div class="form-group">
						<label for="dezv">Regim de dezvoltare</label>
						<select name="dezvoltare" placeholder="Regim de dezvoltare" id="category">
							<option value="Teren deschis" <?php if ("Teren deschis" ==$r['REGIM_DEZV'] ) echo "selected"; ?>>Teren deschis</option>
							<option value="Ghiveci" <?php if ("Ghiveci" ==$r['REGIM_DEZV'] ) echo "selected"; ?>>Ghiveci</option>
							<option value="Sera" <?php if ("Sera" ==$r['REGIM_DEZV'] ) echo "selected"; ?>>Sera</option>
						</select>
					</div>
					<div class="form-group">
					<label for="den">Descriere</label>
					<input id="den" name="descriere" type="text" value="<?=$r['DESCRIERE'] ?>" required>
					</div>
					<div class="form-group">
					<label for="den">Link imagine</label>
					<input id="den" name="imagine" type="text" value="<?=$r['IMAGINE'] ?>" required>
					</div>
					<button class="btn-primary pull-right" name="buton" type="submit">
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