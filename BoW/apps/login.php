<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
<?php
	require_once("manage.php");
	$username=htmlspecialchars($_REQUEST['nume']);
	$checkUser= new Users();
	$cont=$checkUser->checkAdmin($username);
	if ($cont==0){
		$checkUser->checkUser($username);
	}
	die();
?>	
</body>
</html>
