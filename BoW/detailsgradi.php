<?php

	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>BoW</title>
	<script src="resources/js/afisarebutoane.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="resources/css/main.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script type="text/javascript">
		function paginarePlante(val) { 
		    if (window.XMLHttpRequest) {
		        // code for IE7+, Firefox, Chrome, Opera, Safari
		        ajax1 = new XMLHttpRequest();
		    } else {
		        // code for IE6, IE5
		        ajax1 = new ActiveXObject("Microsoft.XMLHTTP");
		    }
		    ajax1.onreadystatechange = function() {
		        if (ajax1.readyState == 4 && ajax1.status == 200) {
		            document.getElementById("listaplanta").innerHTML = ajax1.responseText;
		        }
		    }
		    ajax1.open("GET","\\BoW/apps/paginareplante.php?Page="+val,true);
		    ajax1.send();
		}
		
		function init(){
			showButton();
			paginarePlante(1);
		}
	</script>
</head>
<body onload="init()">
<div class="container">
	<?php
		require_once("header.php");
		require_once("apps/database.php");
		if (!ctype_digit($_GET['id'])){
			header("refresh:2;url=\\BoW/gradina.php");
			die("<p>Serverul a intampinat o eroare!</p>");
		}
		$id=$_GET['id'];
		$_SESSION['id_gradina']=htmlspecialchars($id);
		try{
			$db=new Database();
		}
		catch(Exception $e){
			die("Serverul a intalnit o eroare: ".$e->getMessage());
		}
		try{
			$rez1=$db->execFetchAll("SELECT COUNT(*) AS NR FROM GRADINI WHERE ID_GRADINA=:id_gradina",array(array(":id_gradina",$id,-1)));
		}catch(Exception $e){
			die("Serverul a intalnit o eroare: ".$e->getMessage());
		}
		foreach($rez1 as $r){
			$nr=$r['NR'];
		}
		if ($nr==0){
			die("Ai modificat id-ul fara permisiune!");
		}
		try{
			$rez=$db->execFetchAll("SELECT spatiu_gradi, nume_gradi FROM GRADINI WHERE ID_GRADINA=:id_gradina",array(array(":id_gradina",$id,-1)));
		}catch(Exception $e){
			die("Serverul a intalnit o eroare: ".$e->getMessage());
		}
		foreach($rez as $r){
			$spatiu_gradi=$r['SPATIU_GRADI'];
			$nume_gradi=$r['NUME_GRADI'];
		}
		// informatii despre spatiul total al gradinilor, ceva legat de spatiu?
	?>
		<aside>
			<h2>Administrare gradina: <?=$nume_gradi?></h2>
			<h3>Spatiu disponibil in gradina: <?=$spatiu_gradi?></h3>
			<ul class="categories">
				<li><a class="btn-primary" href="planta_noua.php">Adauga planta noua</a></li>
				<li><a class="btn-primary" href="apps/delgradina.php?id=<?=$id?>">Stergere gradina</a></li>
				<li><a class="btn-primary" href="modificare_gradina.php?id=<?=$id?>">Editeaza gradina</a></li>
			</ul>
		</aside>
			

		<div class="main-content" id="listaplanta">
			
		</div>

		<?php

			require_once("footer.php");
		?>
</div>

</body>
</html>