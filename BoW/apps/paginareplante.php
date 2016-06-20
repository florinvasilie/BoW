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

		//DE SCHIMBAT IN INTERGOAREA CA ID_GRADINA DIN PLANTE SA FIE = ID_GRADINA
		//am id-ul din details
		$id=$_SESSION['id_gradina'];
		if(!$_GET['Page']){
			$Page=1;
		}
		else $Page=$_GET['Page'];
		try{
			$db = new Database();
		}catch(Exception $e){
			die("<p> Serverul a intampinat o eroare: ".$e->getMessage()."</p>");
		}
		$sql="SELECT COUNT(DENUMIRE) AS NRLINII FROM PLANTE where ID_GRADINA='".$id."'";
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
						WHERE ID_GRADINA='".$id."'
					ORDER BY ID_PLANTA) t
				WHERE rownum <= :rezt) f
			WHERE r >= :offs";
		$Num_Pages="OK";	
		$rez=$paginare->rasfoieste($Page,30,$Nr_linii,$sql,$Num_Pages);
	echo "<h2>Plante</h2>";	
	echo "<table>";
	  echo "<tr>";
	    echo "<th>DENUMIRE</th>";
	    echo "<th>STERGERE</th>";
	     echo "<th>EDITEAZA</th>";
	   echo "</tr>";
	
	foreach($rez as $r){
		?>
		<tr>
			<td><a href="details.php?id=<?=$r['ID_PLANTA']?>"><?=$r['DENUMIRE'];?></a> </td>
			<td><a href="apps/delplanta.php?id=<?=$r['ID_PLANTA']?>">Stergere</a> </td>
			<td><a href="modificare_planta.php?id=<?=$r['ID_PLANTA']?>">Editeaza</a> </td>
		</tr>
		<?php
	}
	?>
	
		<select onchange="paginarePlante(this.value)">
			<?php
				for($it=1; $it<=$Num_Pages; $it++)
					echo "<option  value=\"".$it."\">".$it;
			?>
		</select>


</body>
</html>