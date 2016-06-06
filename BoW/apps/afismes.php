<?php
?>
<!DOCTYPE html>
<html>
<head>
	<title>BoW</title>
</head>
<body>
	<?php
		require_once("database.php");
		if(!$_GET['Page']){
			$Page=1;
		}
		else $Page=$_GET['Page'];
		try{
			$db = new Database();
		}catch(Exception $e){
			die("<p> Serverul a intampinat o eroare: ".$e->getMessage()."</p>");
		}
		$sql="SELECT COUNT(NUME) AS NRLINII FROM MESAJE";
		try{
			$rez=$db->execFetchAll($sql);
		}catch(Exception $e){
			die("<p>Serverul a intampinat o eroare: ".$e->getMessage()."</p>");
		}
		foreach ($rez as $r) {
			$Nr_linii=$r['NRLINII'];
		}
		if($Nr_linii==0){
			die("Nu exista mesaje de afisat.");
		}
		$Per_page=30;
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
	echo "<table>";
	  echo "<tr>";
	    echo "<th>NUME</th>";
	    echo "<th>EMAIL</th>";
	    echo "<th>MESAJ</th>";
	   echo "</tr>";
	
	$offset=30*($Page-1)+1; $nrez=30+($Page-1)*30;
	$sql= "SELECT f.*
			FROM (
				SELECT t.*, rownum r
				FROM (
						SELECT *
						FROM MESAJE
					ORDER BY NUME) t
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
			<td><?=$r['NUME'];?></td>
			<td><?=$r['EMAIL'];?></td>
			<td><?=$r['MESAJ'];?></td>
		</tr>
		<?php
	}
	?>
	
	<select onchange="mesajeAdmin(this.value)">
			<?php
				for($it=1; $it<=$Num_Pages; $it++)
					echo "<option  value=\"".$it."\">".$it;
			?>
		</select>
</body>
</html>