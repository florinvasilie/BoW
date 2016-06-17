<?php
	session_start();
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
		try{
			$rez=$db->execFetchAll("SELECT id_planta, denumire, username, data_postarii FROM plante where upper(denumire) LIKE upper('%'||:req||'%')",array(array(":req",htmlspecialchars($_REQUEST['search']),-1)));
		}catch(Exception $e){
			die("Serverul a intalnit o eroare: ".$e->getMessage());
		}
		echo "<div class=\"main-content\">";
		if ($rez!=null){

			echo "<table>
				<tr>
				<th>Denumire</th>
				<th>Utilizator</th>
				<th>Data postarii</th>
				</tr>";
			foreach ($rez as $r) {
				echo "<tr>";
				echo "<td><a href=\"details.php?id=".$r['ID_PLANTA']."\">" . $r['DENUMIRE']."</a></td>";
			    echo "<td>" . $r['USERNAME'] . "</td>";
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
		
		require_once("leftside.php");
		require_once("footer.php");
	?>
</div>
</body>
</html>