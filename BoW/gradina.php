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
		function paginareGradina(val) { 
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
		    ajax1.open("GET","\\BoW/apps/paginaregradini.php?Page="+val,true);
		    ajax1.send();
		}
		
		function init(){
			showButton();
			paginareGradina(1);
		}
	</script>
</head>
<body onload="init()">
<div class="container">
	<?php
		require_once("header.php");
		require_once("apps/database.php");
		try{
			$db=new Database();
		}
		catch(Exception $e){
			die("Serverul a intalnit o eroare: ".$e->getMessage());
		}
		try{
			$rez=$db->execFetchAll("SELECT COUNT(*) AS TOTAL FROM GRADINI WHERE username=:username",array(array(":username",$_SESSION['username'],-1)));
		}catch(Exception $e){
			die("Serverul a intalnit o eroare: ".$e->getMessage());
		}
		foreach($rez as $r){
			$nr_gradini=$r['TOTAL'];
		}
		// informatii despre spatiul total al gradinilor, ceva legat de spatiu?
	?>
		<aside>
			<h2>Informatii</h2>
			<h3>Numarul de gradini create: <?=$nr_gradini?></h3>	
				<a class="btn-primary" href="gradina_noua.php">Gradina noua</a>
		</aside>
			

		<div class="main-content" id="listaplanta">
			
		</div>

		<?php

			require_once("footer.php");
		?>
</div>

</body>
</html>