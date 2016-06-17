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
		$sql="SELECT COUNT(DENUMIRE) AS NRLINII FROM PLANTE where username='".$_SESSION['username']."'";
		try{
			$rez=$db->execFetchAll($sql);
		}catch(Exception $e){
			die("<p>Serverul a intampinat o eroare: ".$e->getMessage()."</p>");
		}
		foreach ($rez as $r) {
			$Nr_linii=$r['NRLINII'];
		}
		if($Nr_linii==0){
			die("Nu exista plante de afisat.");
		}
		$paginare= new Paginare();
		$sql= "SELECT f.*
			FROM (
				SELECT t.*, rownum r
				FROM (
						SELECT ID_PLANTA,DENUMIRE
						FROM PLANTE
						WHERE username='".$_SESSION['username']."'
					ORDER BY ID_PLANTA) t
				WHERE rownum <= :rezt) f
			WHERE r >= :offs";
		$Num_Pages="OK";	
		$rez=$paginare->rasfoieste($Page,30,$Nr_linii,$sql,$Num_Pages);
	echo "<table>";
	  echo "<tr>";
	    echo "<th>DENUMIRE</th>";
	    echo "<th>STERGERE</th>";
	     echo "<th>EDITEAZA</th>";
	   echo "</tr>";
	

	foreach($rez as $r){
		?>
		<tr>
			<td><?=$r['DENUMIRE'];?></td>
			<td><a href="apps/delplanta.php?id=<?=$r['ID_PLANTA']?>">Stergere</a> </td>
			<td><a href="modificare_planta.php?id=<?=$r['ID_PLANTA']?>">Editeaza</a> </td>
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