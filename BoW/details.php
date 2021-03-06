<?php
	session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Detalii</title>
	<script src="resources/js/afisarebutoane.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="resources/css/main.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://apis.google.com/js/platform.js" async defer>
  		{lang: 'ro'}
	</script>
</head>
<body onload="showButton()">
<div class="container">
	<?php
		require_once("header.php");
		require_once("apps/manage.php");
		require_once("apps/database.php");

		if (!ctype_digit($_GET['id'])){
			header("refresh:2;url=\\BoW/rasfoieste.php?Page=1");
			die("<p>Serverul a intampinat o eroare!</p>");
		}

		if(!$_GET["id"]){
			die("A aparut o eroare!");
		}
		$id=$_GET["id"];
		?>
		<div class="main-content new-petition">

		<?php
		$manage=new managePlante();
		$manage->details($id);
		$manage->showImage($id);
		
		try{
			$db=new Database();
			}
			catch(Exception $e){
				die("Serverul a intalnit o eroare: ".$e->getMessage());
			}
		if (isset($_SESSION['username'])){
			try{
				$sql="select passwd from utilizatori where username='".$_SESSION['username']."'";
				$rez=$db->execFetchAll($sql);
				foreach($rez as $r){
					$pass=$r['PASSWD'];
					$pass= preg_replace('/\s+/', '',$pass);
				}
				if ($pass==$_SESSION['password']){
					$sql="select count(username) as test from aprecieri where id_planta='".$id."' and username='".$_SESSION['username']."'";
					try{
						$rez=$db->execFetchAll($sql);
					}catch(Exception $e){
						echo "<p>A aparut o eroare.</p>";
					}
					foreach($rez as $r){
						$test=$r['TEST'];
					}
					if($test){
						echo "<p>Ati votat aceasta planta. Multumim! </p>";

					}

					else {
						echo "<a class=\"btn-primary\" href=\"apps/voteazaplanta.php?id=".$id."\">Voteaza</a><br><br>";
					}	
				}
				else{
					session_destroy();
					echo "<a class=\"btn-primary\" href=\"\\BoW/login.php\">Login</a>";
				}
				
			}catch(Exception $e){
				echo $e->getMessage();
			}
		}
		else{
			echo "<h2>Logati-va pentru a putea vota</h2>";
		}
		$sql="select count(username) as nrvoturi from aprecieri where id_planta='".$id."'";
		try{
			$rez=$db->execFetchAll($sql);
		}catch(Exception $e){
			echo "<p>A aparut o eroare.</p>";
		}
		foreach($rez as $r){
			echo "<h2>Aceasta planta a fost votata de ".$r['NRVOTURI']." ori!</h2>";
		}

	?>

	<div class="g-plusone" data-annotation="inline" data-width="300"></div>
	<a href="https://twitter.com/share" class="twitter-share-button" data-size="large">Tweet</a>
	<script>!
	function(d,s,id){
		var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
		if(!d.getElementById(id)){
			js=d.createElement(s);
			js.id=id;js.src=p+'://platform.twitter.com/widgets.js';
			fjs.parentNode.insertBefore(js,fjs);
		}
		}
		(document, 'script', 'twitter-wjs');
	</script>
	</div>
	<?php
	require_once("leftside.php");
	require_once("footer.php");
	?>
</div>
</body>
</html>