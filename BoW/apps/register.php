<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
</head>
<body>
<?php
	require_once("database.php");

	if (!htmlspecialchars($_REQUEST["username"])){
		echo "<p>Nu ati introdus numele de utilizator!</p>";
		die();
	}
	if(!htmlspecialchars($_REQUEST["parola"])){
		echo "<p>Nu ati specificat parola!</p>";
		die();
	}
	if(!htmlspecialchars($_REQUEST["nume"])){
		echo "<p>Nu ati introdus numele dvs!</p>";
		die();
	}
	if(!htmlspecialchars($_REQUEST["datan"])){
		echo "<p>Nu ati specificat data nasterii!</p>";
		die();
	}
	if(!htmlspecialchars($_REQUEST["email"])){
		echo "<p>Nu ati introdus adresa de email!</p>";
		die();
	}
	try{
		$db = new Database();
	}catch(Exception $e){
		header("refresh:5;url=\\BoW/index.php");
		die("Eroare server: ".$e->getMessage());
	}
	try{
		$rez=$db->execFetchAll("SELECT COUNT(username) AS TEST FROM admin where username=:req",array(array(":req",htmlspecialchars($_REQUEST['username']),-1)));
	}catch(Exception $e){
		header("refresh:5;url=\\BoW/index.php");
		die("Eroare server: ".$e->getMessage());
	}
	foreach ($rez as $r) {
		$test=$r['TEST'];
	}
	if($test){
    	header("refresh:3;url=\\BoW/index.php");
    	die("<p>Ne pare rau acest nume de utilizator exista. Veti fi redirectat.</p>");
    }
	try{
		$rez=$db->execFetchAll("SELECT manage_utilizatori.isBlacklist(:email) AS TEST FROM DUAL",array(array(":email",htmlspecialchars($_REQUEST['email']),-1)));
	}catch(Exception $e){
		header("refresh:5;url=\\BoW/index.php");
		die("Eroare server: ".$e->getMessage());
	}
	foreach ($rez as $r) {
		$test=$r['TEST'];
	}
	if($test){
    	header("refresh:3;url=\\BoW/index.php");
    	die("<p>Ne pare rau dar nu va puteti crea cont deoarece emailul este in blacklist. Veti fi redirectat.</p>");
    }
    try{
		$rez=$db->execFetchAll("SELECT manage_utilizatori.isUser(:email2) AS TEST FROM DUAL",array(array(":email2",htmlspecialchars($_REQUEST['email']),-1)));
	}catch(Exception $e){
		header("refresh:5;url=\\BoW/index.php");
		die("Eroare server: ".$e->getMessage());
	}
	foreach ($rez as $r) {
		$test=$r['TEST'];
	}
	if($test){
    	header("refresh:3;url=\\BoW/register.php");
    	die("<p>Adresa de email este deja in uz. Veti fi redirectat.</p>");
    }
    try{
		$rez=$db->execFetchAll("SELECT COUNT(*) AS TEST FROM utilizatori where username=:req2",array(array(":req2",htmlspecialchars($_REQUEST['username']),-1)));
	}catch(Exception $e){
		header("refresh:5;url=\\BoW/index.php");
		die("Eroare server: ".$e->getMessage());
	}
	foreach ($rez as $r) {
		$test=$r['TEST'];
	}
	if($test){
		header("refresh:3;url=\\BoW/register.php");
    	die("<p>Numele de utilizator este deja folosit. Veti fi redirectat.</p>");
    }
    $pass=htmlspecialchars($_REQUEST['parola']);
    $pass= preg_replace('/\s+/', '',$pass);
    try{
		// $db->execute("INSERT INTO utilizatori(username,passwd,nume,email,data_nasterii) VALUES ('".$_REQUEST["username"]."','".$pass."
  //   	','".$_REQUEST["nume"]."','".$_REQUEST["email"]."',TO_DATE('".$_REQUEST["datan"]."','YYYY-MM-DD'))");
    	$db->execute("INSERT INTO utilizatori(username,passwd,nume,email,data_nasterii) VALUES (:usern,:passw,:nume,:email,TO_DATE(:datan,'YYYY-MM-DD'))",
    		array(array(":usern",htmlspecialchars($_REQUEST['username']),-1),array(":passw",$pass,-1),array(":nume",htmlspecialchars($_REQUEST['nume']),-1),array(":email",htmlspecialchars($_REQUEST['email']),-1),array(":datan",htmlspecialchars($_REQUEST['datan']),-1)));
	}catch(Exception $e){
		
		die("Eroare server: ".$e->getMessage());
	}
	
	$_SESSION['username']=htmlspecialchars($_REQUEST['username']);
	$_SESSION['password']=htmlspecialchars($_REQUEST['parola']);
	echo "<p>Utilizatorul a fost creat! Veti fi redirectat in 5 secunde.</p>";
	header("Location: \\BoW/index.php");
?>
</body>
</html>