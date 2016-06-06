<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>BoW</title>
	<link rel="stylesheet" type="text/css" href="resources/css/main.css">
	<script src="resources/js/afisarebutoane.js" type="text/javascript"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body onload="showButton()">
<div class="container">
<?php
	require_once("header.php");
?>
	<div class="main-content new-petition">
		<h2>Despre noi</h2>
			<p>Multumim ca ati vizitat situl nostru!</p>
			<p>
				Proiectul BoW are ca scop gestionarea unei gradini botanice. Aici puteti adauga diferite plante, mentionand diferite caracteristici pe care le doriti. Va incurajam sa va incarcati propriile postari si sa navigati in cautarea de plante necunoscute de dumneavoastra, insa pe care le-au postat alti utilizatori. De asemenea, puteti folosi optiunea de apreciere a unei plante, in cazul in care aceasta v-a impresionat.
			</p>
			<h3>Feedback</h3>
			<p>
				Speram ca v-a placut situl! In cazul in care aveti vreo nelamurire sau daca doriti sa ne lasati feedback, aveti la dispozitie formularul de contact.
			</p>
	</div>
	<?php
		require_once("leftside.php");
		require_once("footer.php");
	?>
</div>
</body>
</html>