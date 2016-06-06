<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<link rel="stylesheet" type="text/css" href="resources/css/main.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script type="text/javascript">
		function mesajeAdmin(val) { 
		    if (window.XMLHttpRequest) {
		        // code for IE7+, Firefox, Chrome, Opera, Safari
		        ajax1 = new XMLHttpRequest();
		    } else {
		        // code for IE6, IE5
		        ajax1 = new ActiveXObject("Microsoft.XMLHTTP");
		    }
		    ajax1.onreadystatechange = function() {
		        if (ajax1.readyState == 4 && ajax1.status == 200) {
		            document.getElementById("mesaje").innerHTML = ajax1.responseText;
		        }
		    }
		    ajax1.open("GET","\\BoW/apps/afismes.php?Page="+val,true);
		    ajax1.send();
		}
	</script>
</head>
<body onload="mesajeAdmin(1)">
<div class="container">
	<?php
		if(isset($_SESSION['admin']) && $_SESSION['admin']=="ok"){
			?>
			<header>
					<div class="logo">
						<a href="admin.php"><img src="public/imagini/logo.png" alt="BoW"></a>
							<h1><em>BoW</em></h1>
					</div>
					<nav class="primary-navigation">
						<ul>
							<li><a href="generareXML.php">Generare XML</a></li>
							<li><a href="generareCSV.php">Generare CSV</a></li>
							<li><a class="btn-primary" href="logout.php">Logout</a></li>
						</ul>
					</nav>	
			</header>
		<?php

			echo "<div class=\"main-content\">";
			echo "<p>Aceasta este zona admin</p>";
			echo "<div id=\"mesaje\"></div>";
			echo "<br>";
			echo "<a class=\"btn-primary\"href=\"apps/deletemsg.php\">Sterge Mesaje</a>";
			echo "<br><br>";
			echo "<a class=\"btn-primary\"href=\"utilizatori.php?Page=1\">Utilizatori</a>";
			echo "</div>";
		}
		else{
			header("Location:\\BoW/index.php");
		}
	?>
</div>
</body>
</html>