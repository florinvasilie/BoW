<?php
	session_start();
	require_once("database.php");
	if (isset($_SESSION['username'])){
		try{
			$db=new Database();
			$sql="select passwd from utilizatori where username='".$_SESSION['username']."'";
			$rez=$db->execFetchAll($sql);
			if($rez==null){
				echo "<li><a class=\"btn-primary\" href=\"\\BoW/login.php\">Login</a></li>";
				die();
			}
			foreach($rez as $r){
				$pass=$r['PASSWD'];
				$pass= preg_replace('/\s+/', '',$pass);
				if ($pass==$_SESSION['password']){
					echo "<li><a class=\"btn-primary\" href=\"\\BoW/gradina.php\">Gradina mea</a></li>";
					echo "<li><a class=\"btn-primary\" href=\"\\BoW/userpage.php\">Contul meu</a></li>";
					echo "<li><a class=\"btn-primary\" href=\"\\BoW/logout.php\">Logout</a></li>";
				}
				else{
					session_destroy();
					echo "<li><a class=\"btn-primary\" href=\"\\BoW/login.php\">Login</a></li>";
				}
			}
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}
	else{
		echo "<li><a class=\"btn-primary\" href=\"\\BoW/login.php\">Login</a></li>";
	}
?>