<?php
	session_start();
    error_reporting(E_ALL & ~E_NOTICE);
?>
<!DOCTYPE html>
<html>
<head>
	<title>BoW</title>
	<script src="resources/js/afisarebutoane.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="resources/css/main.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body onload="showButton()">
<div class="container">
	<?php
		require_once("header.php");
		require_once("apps/database.php");


		try{
			$db= new Database();
		}catch(Exception $e){
			die("Serverul a intalnit o eroare: ".$e->getMessage());
		}
		$okBeneficii=0;
		$okCategorie=0;
		if (htmlspecialchars($_REQUEST["estetica"]) || htmlspecialchars($_REQUEST["beneficii"]) || htmlspecialchars($_REQUEST["parfum"]) || htmlspecialchars($_REQUEST["medicinal"]) || htmlspecialchars($_REQUEST["fructifer"])){
			$okBeneficii=1;
		}
		if (htmlspecialchars($_REQUEST["conifere"]) || htmlspecialchars($_REQUEST["mediteraneene"]) || htmlspecialchars($_REQUEST["asiatice"]) || htmlspecialchars($_REQUEST["medicinal"]) || htmlspecialchars($_REQUEST["foioase"]) || htmlspecialchars($_REQUEST["stepa"])){
			$okCategorie=1;
		}
		if($okCategorie==1 && $okBeneficii==1){
			try{
				$rez=$db->execFetchAll("select id_planta,denumire,username,data_postarii,categorie,beneficii from plante where (upper(categorie) LIKE upper('".$_REQUEST['conifere']."') OR upper(categorie) LIKE upper('".$_REQUEST['mediteraneene']."') OR upper(categorie) LIKE upper('".$_REQUEST['asiatice']."') OR upper(categorie) LIKE upper('".$_REQUEST['foioase']."') OR upper(categorie) LIKE upper('".$_REQUEST['stepa']."')) AND (upper(beneficii) LIKE upper('".$_REQUEST['estetica']."') OR upper(beneficii) LIKE upper('".$_REQUEST['parfum']."') OR upper(beneficii) LIKE upper('".$_REQUEST['meicinal']."') OR upper(beneficii) LIKE upper('".$_REQUEST['fructifer']."'))");
			}catch(Exception $e){
				die("Serverul a intalnit o eroare: ".$e->getMessage());
			}
			echo "<div class=\"main-content\">";
			if ($rez!=null){

				echo "<table>
					<tr>
					<th>Denumire</th>
					<th>Utilizator</th>
					<th>Categorie</th>
					<th>Beneficii</th>
					<th>Data postarii</th>
					</tr>";
				foreach ($rez as $r) {
					echo "<tr>";
					echo "<td><a href=\"details.php?id=".$r['ID_PLANTA']."\">" . $r['DENUMIRE']."</a></td>";
				    echo "<td>" . $r['USERNAME'] . "</td>";
				    echo "<td>" . $r['CATEGORIE'] . "</td>";
				    echo "<td>" . $r['BENEFICII'] . "</td>";
				    echo "<td>" . $r['DATA_POSTARII'] . "</td>";
				    echo "</tr>";
				}
				echo "</table>";
				echo "</div>";
				
			}
			else{
				echo "<p>Nu a fost gasit nici un rezultat</p>";
				echo "</div>";
				require_once("leftside.php");
				require_once("footer.php");
			}	
		}
		if($okCategorie==1 && $okBeneficii==0){
			try{
				$rez=$db->execFetchAll("select id_planta,denumire,username,data_postarii,categorie from plante where upper(categorie) LIKE upper('".$_REQUEST['conifere']."') OR upper(categorie) LIKE upper('".$_REQUEST['mediteraneene']."') OR upper(categorie) LIKE upper('".$_REQUEST['asiatice']."') OR upper(categorie) LIKE upper('".$_REQUEST['foioase']."') OR upper(categorie) LIKE upper('".$_REQUEST['stepa']."')");
			}catch(Exception $e){
				die("Serverul a intalnit o eroare: ".$e->getMessage());
			}
			echo "<div class=\"main-content\">";
			if ($rez!=null){

				echo "<table>
					<tr>
					<th>Denumire</th>
					<th>Utilizator</th>
					<th>Categorie</th>
					<th>Data postarii</th>
					</tr>";
				foreach ($rez as $r) {
					echo "<tr>";
					echo "<td><a href=\"details.php?id=".$r['ID_PLANTA']."\">" . $r['DENUMIRE']."</a></td>";
				    echo "<td>" . $r['USERNAME'] . "</td>";
				    echo "<td>" . $r['CATEGORIE'] . "</td>";
				    echo "<td>" . $r['DATA_POSTARII'] . "</td>";
				    echo "</tr>";
				}
				echo "</table>";
				echo "</div>";
				
			}
			else{
				echo "<p>Nu a fost gasit nici un rezultat</p>";
				echo "</div>";
				require_once("leftside.php");
				require_once("footer.php");
			}	
		}
		if($okCategorie==0 && $okBeneficii==1){
			try{
				$rez=$db->execFetchAll("select id_planta,denumire,username,data_postarii,beneficii from plante where upper(beneficii) LIKE upper('".$_REQUEST['estetica']."') OR upper(beneficii) LIKE upper('".$_REQUEST['parfum']."') OR upper(beneficii) LIKE upper('".$_REQUEST['meicinal']."') OR upper(beneficii) LIKE upper('".$_REQUEST['fructifer']."')");
			}catch(Exception $e){
				die("Serverul a intalnit o eroare: ".$e->getMessage());
			}
			echo "<div class=\"main-content\">";
			if ($rez!=null){

				echo "<table>
					<tr>
					<th>Denumire</th>
					<th>Utilizator</th>
					<th>Categorie</th>
					<th>Data postarii</th>
					</tr>";
				foreach ($rez as $r) {
					echo "<tr>";
					echo "<td><a href=\"details.php?id=".$r['ID_PLANTA']."\">" . $r['DENUMIRE']."</a></td>";
				    echo "<td>" . $r['USERNAME'] . "</td>";
				    echo "<td>" . $r['BENEFICII'] . "</td>";
				    echo "<td>" . $r['DATA_POSTARII'] . "</td>";
				    echo "</tr>";
				}
				echo "</table>";
				echo "</div>";
				
			}
			else{
				echo "<p>Nu a fost gasit nici un rezultat</p>";
				echo "</div>";
				require_once("leftside.php");
				require_once("footer.php");
			}	
		}

		require_once("leftside.php");
		require_once("footer.php");
	?>
</div>
</body>
</html>