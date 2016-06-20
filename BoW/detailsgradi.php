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
		// informatii despre spatiul total al gradinilor, ceva legat de spatiu?
	?>
		<aside>
			<h2>Administrare gradina</h2>
			<ul class="categories">
				<li><a class="btn-primary" href="planta_noua.php">Adauga planta noua</a></li>
				<li><a class="btn-primary" href="gradina_noua.php">Sterge gradina</a></li>
				<li><a class="btn-primary" href="gradina_noua.php">Editeaza gradina</a></li>
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