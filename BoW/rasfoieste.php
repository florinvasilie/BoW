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
		
		$Per_page=30;
		
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
		if($Nr_linii==0){
			die("Nu s-a gasit niciun rezultat.");
		}
		$Prev_Page = $Page-1;
		$Next_Page = $Page+1;
		if($Nr_linii<=$Per_page)
		{
			$Num_Pages =1;
		}
		else if(($Nr_linii % $Per_page)==0)
		{
			$Num_Pages =($Nr_linii/$Per_page) ;
		}
		else
		{
			$Num_Pages =($Nr_linii/$Per_page)+1;
			$Num_Pages = (int)$Num_Pages;
		}
		if($Page>$Num_Pages){
			$Page=$Num_Pages;
		}
		if($Page<1){
			$Page=1;
		}
	?>
	<table>
	  <tr>
	    <th>DENUMIRE</th>
	    <th>UTILIZATOR</th>
	    <th>DATA</th>
	  </tr>
	<?php
	$offset=30*($Page-1)+1; $nrez=30+($Page-1)*30;
	$sql= "SELECT f.*
			FROM (
				SELECT t.*, rownum r
				FROM (
						SELECT ID_PLANTA,DENUMIRE,USERNAME,DATA_POSTARII
						FROM PLANTE
					ORDER BY ID_PLANTA DESC) t
				WHERE rownum <= :rezt) f
			WHERE r >= :offs";
	try{
		$rez=$db->execFetchAll($sql,array(array(":offs",$offset,-1),array(":rezt",$nrez,-1)));
	}catch(Exception $e){
		die("<p>Serverul a intampinat o eroare: ".$e->getMessage()."</p>");
	}
	if ($Page==$Num_Pages){
		if ($Num_Pages % $Per_page!=0){
			$limit=$Nr_linii-($Num_Pages-1)*$Per_page;
		}
	}
	else $limit=30;
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
	if($Prev_Page)
	{
		echo " <a class=\"btn-primary\" href='$_SERVER[SCRIPT_NAME]?Page=1'><< First</a> ";
		echo " <a class=\"btn-primary\" href='$_SERVER[SCRIPT_NAME]?Page=$Prev_Page'><< Back</a> ";
	}
	if($Page!=$Num_Pages)
	{
		echo " <a class=\"btn-primary\" href ='$_SERVER[SCRIPT_NAME]?Page=$Next_Page'>Next>></a> ";
		echo " <a class=\"btn-primary\" href ='$_SERVER[SCRIPT_NAME]?Page=$Num_Pages'>Last>></a> ";
	}

	echo "</div>";
	require_once("leftside.php");
	require_once("footer.php");
?>
</div>
</body>
</html>