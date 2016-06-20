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
		require_once("paginare.php");
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
		$sql="SELECT COUNT(NUME_GRADI) AS NRLINII FROM GRADINI where username='".$_SESSION['username']."'";
		try{
			$rez=$db->execFetchAll($sql);
		}catch(Exception $e){
			die("<p>Serverul a intampinat o eroare: ".$e->getMessage()."</p>");
		}
		foreach ($rez as $r) {
			$Nr_linii=$r['NRLINII'];
		}
		if($Nr_linii==0){
			die("Nu exista gradini de afisat.");
		}
		$paginare= new Paginare();
		$sql= "SELECT f.*
			FROM (
				SELECT t.*, rownum r
				FROM (
						SELECT ID_GRADINA,NUME_GRADI
						FROM GRADINI
						WHERE username='".$_SESSION['username']."'
					ORDER BY ID_GRADINA) t
				WHERE rownum <= :rezt) f
			WHERE r >= :offs";
		$Num_Pages="OK";	
		$rez=$paginare->rasfoieste($Page,30,$Nr_linii,$sql,$Num_Pages);
		echo "<h2>Gradinile mele</h2>";
	echo "<table>";
	  echo "<tr>";
	    echo "<th>DENUMIRE</th>";
	    echo "<th>STERGERE</th>";
	     echo "<th>EDITEAZA</th>";
	   echo "</tr>";
	

	foreach($rez as $r){
		?>
		<tr>
			<td><a href="detailsgradi.php?id=<?=$r['ID_GRADINA']?>"><?=$r['NUME_GRADI'];?></a> </td>
			<td><a href="apps/delgradina.php?id=<?=$r['ID_GRADINA']?>">Stergere</a> </td>
			<td><a href="modificare_gradina.php?id=<?=$r['ID_GRADINA']?>">Editeaza</a> </td>
		</tr>
		<?php
	}
	?>
	
		<select onchange="paginareGradina(this.value)">
			<?php
				for($it=1; $it<=$Num_Pages; $it++)
					echo "<option  value=\"".$it."\">".$it;
			?>
		</select>


</body>
</html>