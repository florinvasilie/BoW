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
	require_once("database.php");
	try{
		$db= new Database();
	}catch(Exception $e){
		die("Serverul a intalnit o eroare: ".$e->getMessage());
	}

	try{
		//$rez=$db->execFetchAll("select count(username) as cont from admin where username='".$_REQUEST['nume']."'");
		$rez=$db->execFetchAll("select count(username) as cont from admin where username=:reqn",array(array(":reqn",htmlspecialchars($_REQUEST['nume']),-1)));
	}catch(Exception $e){
		die("Serverul a intalnit o eroare: ".$e->getMessage());
	}
	foreach($rez as $r){
		$cont=$r['CONT'];
	}

	if($cont!=0){
		try{
			$rez=$db->execFetchAll("select ltrim(rtrim(passwd)) as passwd from admin where username=:reqn1",array(array(":reqn1",htmlspecialchars($_REQUEST['nume']),-1)));
		}catch(Exception $e){
			die("Serverul a intalnit o eroare: ".$e->getMessage());
		}
		foreach($rez as $r){
			$pass=$r['PASSWD'];
		}
		$pass= preg_replace('/\s+/', '',$pass);
		if($pass==$_REQUEST['passwd']){
			$_SESSION['admin']="ok";
			header("Location:\\BoW/admin.php");
		}
		else{
			echo "<p>Parola este gresita!</p>";
			header("refresh:2;url=\\BoW/index.php");
		}
	}
	else{

		try{
			$rez=$db->execFetchAll("select count(username) as cont from utilizatori where username=:reqn2",array(array(":reqn2",htmlspecialchars($_REQUEST['nume']),-1)));
		}catch(Exception $e){
			die("Serverul a intalnit o eroare: ".$e->getMessage());
		}
		foreach($rez as $r){
			$cont=$r['CONT'];
		}
		if ($cont!=0){
			try{
				$rez=$db->execFetchAll("select ltrim(rtrim(passwd)) as passwd from utilizatori where username=:reqn",array(array(":reqn",htmlspecialchars($_REQUEST['nume']),-1)));
			}catch(Exception $e){
				die("Serverul a intalnit o eroare: ".$e->getMessage());
			}
			foreach($rez as $r){
				$pass=$r['PASSWD'];
			}
			$pass= preg_replace('/\s+/', '',$pass);
			if($pass==$_REQUEST['passwd']){
				$_SESSION['username']=$_REQUEST['nume'];
				$_SESSION['password']=$pass;
				?>
				<p>Ati fost logat cu succes.O sa fiti redirectat pe pagina principala in 5 secunde.</p>
				<?php
				header("Location: \\BoW/index.php");
			}
			else{
				?>
				<p>Numele de utlizator sau parola sunt gresite .O sa fiti redirectat pe pagina de login in 5 secunde.</p>
				<?php
				header("refresh:2;url=\\BoW/login.php");
			}
		}
		else{
			?>
				<p>Numele de utlizator nu exista. O sa fiti redirectat pe pagina de login in 5 secunde.</p>
				<?php
				header("refresh:2;url=\\BoW/login.php");
		}
	}
?>	
</body>
</html>
