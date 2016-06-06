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
		$req=$_GET['q'];
		if($req=="top"){
			$sql="SELECT * FROM (SELECT id_planta,denumire,username,data_postarii,vizualizari FROM plante ORDER BY vizualizari DESC) WHERE rownum<=5";
		}
		else{
			$sql="SELECT * FROM (SELECT id_planta,denumire,username,data_postarii,vizualizari FROM plante ORDER BY data_postarii DESC) WHERE ROWNUM<=5";
		}
		if ($sql!=''){
			try{
				$db=new Database();
				$rez=$db->execFetchAll($sql);
				if($rez==null){
					echo "<p>Nu sunt plante de afisat!</p>";
					die();
				}
				echo "<table>
				<tr>
				<th>Denumire</th>
				<th>Utilizator</th>
				<th>Data postarii</th>
				<th>Vizualizari</th>
				</tr>";
				foreach ($rez as $r) {
					echo "<tr>";
					echo "<td><a href=\"details.php?id=".$r['ID_PLANTA']."\">". $r['DENUMIRE'] . "</a></td>";
				    echo "<td>" . $r['USERNAME'] . "</td>";
				    echo "<td>" . $r['DATA_POSTARII'] . "</td>";
				     echo "<td>" . $r['VIZUALIZARI'] . "</td>";
				    echo "</tr>";
				}
				echo "</table>";
			}catch(Exception $e){
				echo $e->getMessage();
			}
		}
	?>
</body>
</html>