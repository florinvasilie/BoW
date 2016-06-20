<?php
?>
<html>
<head>
	<title>Raport XML</title>
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
		$dom = new DOMDocument('1.0', 'UTF-8');
		$root = $dom->createElement('PLANTE', '');
		$dom->appendChild($root);
		foreach($rez as $r){
					$planta = $dom->createElement('PLANTA', '');
					$planta=$root->appendChild($planta);
					$id_planta=$dom->createElement('Id_planta',$r['ID_PLANTA']);
					$id_planta=$planta->appendChild($id_planta);
					$categorie=$dom->createElement('Categorie',$r['CATEGORIE']);
					$categorie=$planta->appendChild($categorie);
					$beneficii=$dom->createElement('Beneficii',$r['BENEFICII']);
					$beneficii=$planta->appendChild($beneficii);
					$data_postarii=$dom->createElement('Data_postarii',$r['DATA_POSTARII']);
					$data_postarii=$planta->appendChild($data_postarii);
					$username=$dom->createElement('Username',$r['USERNAME']);
					$username=$planta->appendChild($username);

					$vizualizari=$dom->createElement('Vizualizari',$r['VIZUALIZARI']);
					$vizualizari=$planta->appendChild($vizualizari);

					$denumire=$dom->createElement('Denumire',$r['DENUMIRE']);
					$denumire=$planta->appendChild($denumire);

					$origine=$dom->createElement('Origine',$r['ORIGINE']);
					$origine=$planta->appendChild($origine);

					$regim_dezv=$dom->createElement('Regim_dezv',$r['REGIM_DEZV']);
					$regim_dezv=$planta->appendChild($regim_dezv);

					$descriere=$dom->createElement('Descriere',$r['DESCRIERE']);
					$descriere=$planta->appendChild($descriere);

					$imagine=$dom->createElement('Imagine',$r['IMAGINE']);
					$imagine=$planta->appendChild($imagine);



		}
		$dir='Rapoarte';
		if(!is_dir($dir))
			mkdir($dir);
	    $dom->saveXML();
		$dom->save("Rapoarte/plante.xml");
		echo "<div class=\"container\"><div class=\"main-content\">";
		echo "<p>Exportul plante.xml a fost generat cu succes</p>";
		echo "<a href="."$dir"."/"."plante.xml".">Deschide fisierul!</a>";
		echo "</div></div>";
	?>
		
</body>
</html>