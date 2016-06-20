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
		try{
			$db= new Database();
		}catch(Exception $e){
			die("Eroare server: ".$e->getMessage());
		}
		try{
			$rez=$db->execFetchAll("select * from plante");
		}catch(Exception $e){
			die("Eroare server: ".$e->getMessage());
		}
		$csv="id_planta,id_gradina,categorie,beneficii,data_postarii,username,vizualizari,denumire,origine,regim_dezv,descriere,spatiu,perioada_cult,maniera_inmul\n";
		foreach($rez as $r){
					$csv.=$r['ID_PLANTA'] .$r['ID_GRADINA'] . $r['CATEGORIE']."," .$r['BENEFICII']."," .$r['DATA_POSTARII']."," .$r['USERNAME']."," .$r['VIZUALIZARI']."," .$r['DENUMIRE']."," .$r['ORIGINE']."," .$r['REGIM_DEZV']."," .$r['DESCRIERE']."," .$r['SPATIU']."," .$r['PERIOADA_CULT']."," .$r['MANIERA_INMUL']."\n";
		}
		
		
		$file = 'RaportCSV.csv';
		$dir='Rapoarte';
		if(!is_dir($dir))
			mkdir($dir);
		file_put_contents("$dir/$file", $csv);
		echo "<div class=\"container\"><div class=\"main-content\">";
		echo "<p>Exportul $file a fost generat cu succes</p>";
		echo "<a href="."$dir"."/"."$file".">Deschide fisierul!</a>";
		echo "</div></div>";
	?>
		
</body>
</html>