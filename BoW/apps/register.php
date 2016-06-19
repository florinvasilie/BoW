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
	require_once("manage.php");
	$username=htmlspecialchars($_REQUEST["username"]);
	$passwd=htmlspecialchars($_REQUEST["parola"]);
	$nume=htmlspecialchars($_REQUEST["nume"]);
	$datan=htmlspecialchars($_REQUEST["datan"]);
	$email=htmlspecialchars($_REQUEST["email"]);
	


	//setarea sesiunilor pt utilizator
	$register = new register();
	$register->registerUser($username,$passwd,$email,$datan,$nume);


	$_SESSION['username']=htmlspecialchars($username);
	$_SESSION['password']=md5(htmlspecialchars($passwd));

	header("Location: \\BoW/index.php");
?>
</body>
</html>