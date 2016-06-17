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
	<div class="main-content">
		<?php
		require_once("header.php");
		require_once("apps/database.php");
		require_once("apps/paginare.php");

		//Verific pt xss -> daca modifca in url si pune altceva in loc de nr, die!

		if (!ctype_digit($_GET['Page'])){
			header("refresh:2;url=\\BoW/rasfoieste.php?Page=1");
			die("<p>Serverul a intampinat o eroare!</p>");
		}
		if(!$_GET['Page']){
			$Page=1;
		}
		else $Page=$_GET['Page'];


		try{
			$db = new Database();
		}catch(Exception $e){
			die("<p> Serverul a intampinat o eroare: ".$e->getMessage()."</p>");
		}
		$sql="SELECT COUNT(DENUMIRE) AS NRLINII FROM PLANTE";

		try{
			$rez=$db->execFetchAll($sql);
		}catch(Exception $e){
			die("<p>Serverul a intampinat o eroare: ".$e->getMessage()."</p>");
		}
		foreach ($rez as $r) {
			$Nr_linii=$r['NRLINII'];
		}
		//in nr linii am numarul total de plante

		if($Nr_linii==0){
			die("Nu s-a gasit niciun rezultat.");
		}
		$paginare= new Paginare();

		$sql= "SELECT f.*
				FROM (
					SELECT t.*, rownum r
					FROM (
							SELECT ID_PLANTA,DENUMIRE,USERNAME,DATA_POSTARII
							FROM PLANTE
						ORDER BY ID_PLANTA DESC) t
					WHERE rownum <= :rezt) f
				WHERE r >= :offs";
		$ceva=NULL;
		$rez=$paginare->rasfoieste($Page,30,$Nr_linii,$sql,$ceva);
		// $rez va contine toate datele dupa interogare.
		?>
		<table>
		  <tr>
		    <th>DENUMIRE</th>
		    <th>UTILIZATOR</th>
		    <th>DATA</th>
		  </tr>
		<?php
		foreach($rez as $r){
			?>
			<tr>
				<?php
			    echo "<td><a href=\"details.php?id=".$r['ID_PLANTA']."\">".$r['DENUMIRE']."</a></td>";
			    ?>
			    <td><?=$r['USERNAME'];?></td>
			    <td><?=$r['DATA_POSTARII'];?></td>
			  </tr>
			<?php
		}
		?>
		</table>
<?php
	

	echo "</div>";
	require_once("leftside.php");
	require_once("footer.php");
?>
</div>
</body>
</html>