<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Paginare user</title>
</head>
<body>

	<?php
		require_once("database.php");
		
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
	//$rez=$db->execFetchAll("SELECT manage_utilizatori.isUser(:email2) AS TEST FROM DUAL",array(array(":email2",htmlspecialchars($_REQUEST['email']),-1)));
	//$rez=$db->execFetchAll("select id_planta,denumire,username,data_postarii from plante where upper(denumire) LIKE upper('%".$_REQUEST['search']."%')");
	$offset=30*($Page-1)+1; $nrez=30+($Page-1)*30;
	$sql= "SELECT f.*
			FROM (
				SELECT t.*, rownum r
				FROM (
						SELECT ID_PLANTA,DENUMIRE,USERNAME,DATA_POSTARII
						FROM PLANTE WHERE CATEGORIE='".$_REQUEST['conifere']."' 
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
	
		<select onchange="paginareUser(this.value)">
			<?php
				for($it=1; $it<=$Num_Pages; $it++)
					echo "<option  value=\"".$it."\">".$it;
			?>
		</select>


</body>
</html>