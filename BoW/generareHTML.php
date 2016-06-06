<?php
?>
<html>
<head>
	<title>Raport HTML</title>
	<link rel="stylesheet" type="text/css" href="resources/css/main.css">
</head>
<body>
	<?php
		require_once('apps/database.php');
		require_once('admin.php');
		$html="<html>
		<head>
			<title>Raport HTML</title>
		</head>
		<body>";
		try{
			$db= new Database();
		}catch(Exception $e){
			die("Eroare server: ".$e->getMessage());
		}
		try{
			$rez=$db->execFetchAll("select titlu,vizualizari as maxim from petitii where vizualizari=(select max(vizualizari) from petitii)");
		}catch(Exception $e){
			die("Eroare server: ".$e->getMessage());
		}
		$html.="<p>Cea mai vizualizata petitie: </p>";
		foreach($rez as $r){
					$html.="<p>".$r['TITLU'].": " . $r['MAXIM']. " vizualizari</p>";
		}
		
		try{
			$rez=$db->execFetchAll("SELECT * FROM (SELECT titlu,data_postarii FROM petitii ORDER BY data_postarii DESC) WHERE ROWNUM<=1");
		}catch(Exception $e){
			die("Eroare server: ".$e->getMessage());
		}
		$html.="<p>Cea mai recenta petitie: </p>";
		
		foreach($rez as $r){
					$html.="<p>".$r['TITLU'].": " ." din data: ".$r['DATA_POSTARII']."</p>";
		}
		
		$html.="<p>Cea/cele mai votata/e petitie este:</p>";
		try{
			$rez=$db->execFetchAll("SELECT P.TITLU,P.USERNAME,COUNT(S.ID_PETITIE),S.ID_PETITIE FROM SEMNATURI S JOIN PETITII P ON
									s.id_petitie=p.id_petitie group by p.username,p.titlu,s.id_petitie 
									having count(s.id_petitie)=(select max(count(id_petitie)) from semnaturi group by id_petitie)");
		}catch(Exception $e){
			die("Eroare server: ".$e->getMessage());
		}
		foreach($rez as $r){
					$html.="<p>".$r['TITLU'].": " ." si a fost propusa de: ".$r['USERNAME']."</p>";
		}

		$html.="<p>Utilizatorul/utilizatorii cu cele mai multe petitii propuse este/sunt:</p>";
		try{
			$rez=$db->execFetchAll("SELECT USERNAME,COUNT(username) FROM PETITII GROUP BY USERNAME
								HAVING COUNT(username)=(SELECT MAX(COUNT(username)) FROM petitii GROUP BY USERNAME)");
		}catch(Exception $e){
			die("Eroare server: ".$e->getMessage());
		}
		foreach($rez as $r){
					$html.="<p>".$r['USERNAME']."</p>";
		}

		$html.="<p>Utilizatorul care a votat cele mai multe petitii este:</p>";
		try{
			$rez=$db->execFetchAll("SELECT USERNAME,COUNT(USERNAME) FROM SEMNATURI GROUP BY USERNAME HAVING
						COUNT(USERNAME)=(SELECT MAX(COUNT(USERNAME)) FROM SEMNATURI GROUP BY USERNAME)");
		}catch(Exception $e){
			die("Eroare server: ".$e->getMessage());
		}
		foreach($rez as $r){
					$html.="<p>".$r['USERNAME']."</p>";
		}

		$html.="</body>
		</html>";
		$file = 'RaportHTML.html';
		$dir='rapoarte';
		if(!is_dir($dir))
			mkdir($dir);
		file_put_contents("$dir/$file", $html);
		echo "<div class=\"container\"><div class=\"main-content\">";
		echo "<p>Raportul a fost generat cu succes</p>";
		echo "<a href="."$dir"."/"."$file".">Deschide raportul!</a>";
		echo "</div></div>";
	?>
		
</body>
</html>