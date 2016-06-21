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


		$categorii = isset($_POST['categorie']) ? $_POST['categorie'] : array();
		$beneficii = isset($_POST['beneficii']) ? $_POST['beneficii'] : array();
		$origine = isset($_POST['origine']) ? $_POST['origine'] : array();
		$regim = isset($_POST['regim']) ? $_POST['regim'] : array();
		if(count($categorii)==0 && count($beneficii)==0 && count($origine==0) && count($regim==0)) die("".header("refresh:1;url=\\BoW/rasfoieste.php?Page=1"));
		$sql="SELECT id_planta,denumire,username,data_postarii,categorie,beneficii FROM plante WHERE 1=1";
		$index=0;
		if (count($categorii)!=0) $sql.=" AND ";
		foreach($categorii as $value) {
			$index++;
			if ($index>1) $sql.=" OR ";
			$sql.="(categorie='".$value."')";
		}
		$index=0;
		if (count($beneficii)!=0) $sql.=" AND ";
		foreach($beneficii as $value) {
			$index++;
			if ($index>1) $sql.=" OR ";
			$sql.="(beneficii='".$value."')";
		}
		if (count($origine)!=0) $sql.=" AND ";
		$index=0;
		foreach($origine as $value) {
			$index++;
			if ($index>1) $sql.=" OR ";
			$sql.="(origine='".$value."')";
		}
		if (count($regim)!=0) $sql.=" AND ";
		$index=0;
		foreach($regim as $value) {
			$index++;
			if ($index>1) $sql.=" OR ";
			$sql.="(regim_dezv='".$value."')";
		}
		//echo $sql;


		try{
			$db= new Database();
		}catch(Exception $e){
			die("Serverul a intalnit o eroare: ".$e->getMessage());
		}
		try{
			$rez=$db->execFetchAll($sql);
		}
		catch(Exception $e){
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

		require_once("leftside.php");
		require_once("footer.php");
	?>
</div>
</body>
</html>