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
						<form action="apps/inregplanta.php" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label for="denumir">Denumire planta</label>
								<input name="denumire" type="text" placeholder="Denumire planta" pattern="[a-zA-Z0-9-]{1,50}" title="Doar litere si cifre!" required>
							</div>
							<div class="form-group">
								<label for="category">Categorii plante</label>
								<input name="categorii" type="text" placeholder="Categorii plante" pattern="[a-zA-Z0-9-]{1,50}" title="Doar litere si cifre!" required>
							</div>
							<div class="form-group">
								<label for="benefits">Beneficiile plantei</label>
								<input name="beneficii" type="text" placeholder="Beneficiile plantei" pattern="[a-zA-Z0-9-]{1,50}" title="Doar litere si cifre!" required>
							</div>
							<div class="form-group">
								<label for="dezv">Regim de dezvoltare</label>
								<input name="dezvoltare" type="text" placeholder="Regim de dezvoltare" pattern="[a-zA-Z0-9-]{1,50}" title="Doar litere si cifre!" required>
							</div>
							<div class="form-group">
								<label for="per">Perioada cultivarii</label>
								<input id="perioad" name="perioada" type="text" placeholder="Perioada cultivarii" pattern="[a-zA-Z0-9-]{1,50}" title="Doar litere si cifre!" required>
							</div>
							<div class="form-group">
								<label for="inm">Maniera Inmultire</label>
								<input id="inmul" name="inmultire" type="text" placeholder="Maniera inmultire" pattern="[a-zA-Z0-9-]{1,50}" title="Doar litere si cifre!" required>
							</div>
							<div class="form-group">
								<label for="orgi">Originea plantei</label>
								<input id="origin" name="origine" type="text" placeholder="Originea plantei" pattern="[a-zA-Z0-9-]{1,50}" title="Doar litere si cifre!" required>
							</div>
							<div class="form-group">
								<label for="spa">Spatiul alocat plantei(km)</label> <!--TODO DE VERIFICAT SPATIUL DUPA CE FAC GRADINA -->
								<input id="space" name="spatiu" type="text" placeholder="Spatiul alocat plaintei(km)" pattern="[0-9]{1,10}" title="Doar cifre!" required>
							</div>
							<div class="form-group">
								<label for="img">Incarca imagine</label>
								<input name="fileToUpload" type="file" accept="image/*" required>
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