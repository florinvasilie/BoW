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
		function paginareUser(val) { 
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
		    ajax1.open("GET","\\BoW/apps/paguser.php?Page="+val,true);
		    ajax1.send();
		}
		
		function init(){
			showButton();
			paginareUser(1);
		}
	</script>
</head>
<body onload="init()">
<div class="container">
	<?php
		require_once("header.php");
		require_once("apps/database.php");
	?>
	
			<?php
				try{
					$db=new Database();
				}
				catch(Exception $e){
					die("Serverul a intalnit o eroare: ".$e->getMessage());
				}
				$sql="select nume,email,data_nasterii from utilizatori where username='".$_SESSION['username']."'";
				try{
					$rez=$db->execFetchAll($sql);
				}
				catch(Exception $e){
					die("Serverul a intalnit o eroare: ".$e->getMessage());
				}

				$afis="<aside>";
				$afis.="<h2>Informatii</h2>";
				$afis.="<ul class=\"categories\">";
				foreach($rez as $r){
					$afis.="<li>Nume: ".$r['NUME']."</li>";
					$afis.="<li>Email: ".$r['EMAIL']."</li>";
					$afis.="<li>Data nasterii: ".$r['DATA_NASTERII']."</li>";
				}
				$sql="select count(id_planta) as test from plante where username='".$_SESSION['username']."'";
				try{
					$rez=$db->execFetchAll($sql);
				}
				catch(Exception $e){
					die("Serverul a intalnit o eroare: ".$e->getMessage());
				}
				foreach($rez as $r){
					$afis.="<li>Numarul de plante propuse: ".$r['TEST']."</li>";
				}

	
				$afis.="<li><a class=\"btn-primary\"href=\"modificare.php\">Editeaza cont</a></li>
				</ul>
			</aside>";
			?>

		<div class="main-content" id="listaplanta"></div>
		<?php
			echo $afis;

			require_once("footer.php");
		?>
</div>

</body>
</html>