<!DOCTYPE html>
<html>
<head>
	<title>BoW</title>
	<link rel="stylesheet" type="text/css" href="resources/css/main.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body >
<div class="container">
<?php
	require_once("admin.php");
?>
	<div class="main-content">
		<?php
		require_once("apps/database.php");
		require_once("apps/paginare.php");
		if(isset($_SESSION['admin']) && $_SESSION['admin']=="ok"){
		
			if (!ctype_digit($_GET['Page'])){
			header("refresh:2;url=\\BoW/utilizatori.php?Page=1");
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
			$sql="SELECT COUNT(USERNAME) AS NRLINII FROM UTILIZATORI";
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
			$paginare= new Paginare();
			$sql= "SELECT f.*
				FROM (
					SELECT t.*, rownum r
					FROM (
							SELECT USERNAME,EMAIL
							FROM UTILIZATORI
						ORDER BY USERNAME DESC) t
					WHERE rownum <= :rezt) f
				WHERE r >= :offs";
			$ceva=NULL;	
			$rez=$paginare->rasfoieste($Page,30,$Nr_linii,$sql,$ceva);
		?>
		<table>
		  <tr>
		    <th>USERNAME</th>
		    <th>EMAIL</th>
		    <th>STERGE</th>
		  </tr>
		<?php
			foreach($rez as $r){
				?>
				<tr>
					<td><?=$r['USERNAME'];?></td>
				    <td><?=$r['EMAIL'];?></td>
				    <td><a href="apps/delutilizator.php?id=<?=$r['USERNAME']?>">Sterge utilizator</a> </td>
				 </tr>
			<?php
			}
	}
	else{
			header("Location:\\BoW/index.php");
		}
	?>

</table>
<?php
	echo "</div>";
?>
</div>
</body>
</html>