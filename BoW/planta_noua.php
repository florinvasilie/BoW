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
	require_once("apps/database.php");

	if(isset($_SESSION['username'])){
		try{
			$db=new Database();
			$sql="select passwd from utilizatori where username='".$_SESSION['username']."'";
			$rez=$db->execFetchAll($sql);
			foreach($rez as $r){
				$pass=$r['PASSWD'];
				$pass= preg_replace('/\s+/', '',$pass);
				if ($pass==$_SESSION['password']){
					?>
					<div class="main-content new-petition">
						<h2>Planta Noua</h2>
						<form action="apps/inregplanta.php" method="post">
							<div class="form-group">
								<label for="denumir">Denumire planta</label>
								<input name="denumire" type="text" placeholder="Denumire planta" required>
							</div>
							<div class="form-group">
								<label for="category">Categorii plante</label>
								<select name="categorii" placeholder="Categorii plante" id="category">
									<option value="Mediteraneene">Plante mediteraneene</option>
									<option value="Msiatice">Plante asiatice</option>
									<option value="Conifere">Conifere</option>
									<option value="Foioase">Foioase</option>
									<option value="Stepa">Plante de stepa</option>
								</select>
							</div>
							<div class="form-group">
								<label for="benefits">Beneficiile plantei</label>
								<select name="beneficii" placeholder="Beneficiile plantei" id="category">
									<option value="Estetica">Estetica</option>
									<option value="Parfum">Parfum</option>
									<option value="Medicinal">Uz medicinal</option>
									<option value="Fructifer">Plante fructifere</option>
								</select>
							</div>
							<div class="form-group">
								<label for="dezv">Regim de dezvoltare</label>
								<select name="dezvoltare" placeholder="Regim de dezvoltare" id="category">
									<option value="Teren deschis">Teren deschis</option>
									<option value="Ghiveci">Ghiveci</option>
									<option value="Sera">Sera</option>
								</select>
							</div>
							<div class="form-group">
								<label for="org">Originea plantei</label>
								<input id="origin" name="origine" type="text" placeholder="Originea plantei" required>
							</div>
							<div class="form-group">
								<label for="img">Link imagine</label>
								<input name="imagine" type="text" placeholder="Link imagine" required>
							</div>
							<div class="form-group">
								<label for="desc">Descriere</label>
								<textarea name="descriere" id="desc" required></textarea>
							</div>
							<button class="btn-primary pull-right" name="buton" type="submit">Posteaza
							</button>
						</form>
					</div>
					<?php
				}
				else{
					session_destroy();
					die("Logati-va pentru a posta o planta.");
				}
			}
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}
	else{
		die("Logati-va pentru a posta o planta.");
	}

	require_once("leftside.php");
	require_once("footer.php");
	
?>
</div>
</body>
</html>