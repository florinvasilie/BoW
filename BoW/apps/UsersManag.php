<?php
	class register{
		function __construct()
		{
			require_once("database.php");
		}
		public function registerUser($username,$passwd,$email,$datan,$nume){
			try{
				$db = new Database();
			}catch(Exception $e){
				header("refresh:5;url=\\BoW/index.php");
				die("Eroare server: ".$e->getMessage());
			}
			//verificare daca exista username in tabela admin
			try{
				$rez=$db->execFetchAll("SELECT COUNT(username) AS TEST FROM admin where username=:req",array(array(":req",($username),-1)));
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
		    //verificare daca emailul este in blacklist
			try{
				$rez=$db->execFetchAll("SELECT manage_utilizatori.isBlacklist(:email) AS TEST FROM DUAL",array(array(":email",($email),-1)));
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
		    //verificare daca exista adresa de email
		    try{
				$rez=$db->execFetchAll("SELECT manage_utilizatori.isUser(:email2) AS TEST FROM DUAL",array(array(":email2",($email),-1)));
			}catch(Exception $e){
				header("refresh:5;url=\\BoW/index.php");
				die("Eroare server: ".$e->getMessage());
			}
			foreach ($rez as $r) {
				$test=$r['TEST'];
			}
			if($test){
		    	header("refresh:3;url=\\BoW/register.php");
		    	die("<p>Adresa de email este deja in uz. Veti fi redirectionat.</p>");
		    }
		    //verificare daca exista username in tabela utilizatori
		    try{
				$rez=$db->execFetchAll("SELECT COUNT(*) AS TEST FROM utilizatori where username=:req2",array(array(":req2",($username),-1)));
			}catch(Exception $e){
				header("refresh:5;url=\\BoW/index.php");
				die("Eroare server: ".$e->getMessage());
			}
			foreach ($rez as $r) {
				$test=$r['TEST'];
			}
			if($test){
				header("refresh:3;url=\\BoW/register.php");
		    	die("<p>Numele de utilizator este deja folosit. Veti fi redirectionat.</p>");
		    }
		    $pass=md5(htmlspecialchars($passwd));
			// inserez in baza de date campurile din formular
		    try{
		    	$db->execute("INSERT INTO utilizatori(username,passwd,nume,email,data_nasterii) VALUES (:usern,:passw,:nume,:email,TO_DATE(:datan,'YYYY-MM-DD'))",
		    		array(array(":usern",($username),-1),array(":passw",$pass,-1),array(":nume",($nume),-1),array(":email",($email),-1),array(":datan",($datan),-1)));
			}catch(Exception $e){
				
				die("Eroare server: ".$e->getMessage());
			}		
		}
		public function registerPlanta($categorii,$beneficii,$username,$denumire,$origine,$dezvoltare,$descriere,$spatiu,$perioada_cult,$maniera_inmul,$image,$ext){
			try{
			$db= new Database();
			}catch(Exception $e){
				die("Eroare server: ".$e->getMessage());
				header("refresh:5;url=\\BoW/index.php");
			}
			$sql="insert into plante(categorie,beneficii,data_postarii,username,vizualizari,denumire,origine,regim_dezv,descriere,spatiu,perioada_cult,maniera_inmul)". 
			"values(:categorii,:beneficii,SYSDATE,:username,0,:denumire,:origine,:dezvoltare,:descriere,:spatiu,:perioada_cult,:maniera_inmul)";
			// inserez in plante campurile din formular
			try{
				$db->execute($sql,array(array(":categorii",$categorii,-1),array(":beneficii",$beneficii,-1),
				array(":username",$username,-1),array(":denumire",$denumire,-1),array(":origine",$origine,-1),array(":dezvoltare",$dezvoltare,-1),array(":descriere",$descriere,-1),array(":spatiu",$spatiu,-1),array(":perioada_cult",$perioada_cult,-1),array(":maniera_inmul",$maniera_inmul,-1)));
			}catch(Exception $e){
				die("Eroare server: ".$e->getMessage()."Incercati mai tarziu!");
				header("refresh:5;url=\\BoW/index.php");
			}
			$connection=oci_connect("c##florin","1234","localhost/orcl");
			//inserez imaginea in baza de date ca fiin tipul BLOB 
			$sql = "INSERT INTO imagini (imagine) VALUES (empty_blob()) RETURNING imagine INTO :image";
			$result = oci_parse($connection, $sql);
			$blob = oci_new_descriptor($connection, OCI_D_LOB);
			oci_bind_by_name($result, ":image", $blob, -1, OCI_B_BLOB);
			oci_execute($result, OCI_DEFAULT) or die ("Nu s-a putut efectua interogarea");
			if(!$blob->save($image)) {
			    oci_rollback($connection);
			}
			else {
			    oci_commit($connection);
			}
			oci_free_statement($result);
			$blob->free();
		}

	}
	class Users{
		function __construct()
		{
			require_once("database.php");
		}
		public function checkAdmin($username){
			try{
			$db= new Database();
			}catch(Exception $e){
				die("Serverul a intalnit o eroare: ".$e->getMessage());
			}

			try{
				$rez=$db->execFetchAll("select count(username) as cont from admin where username=:reqn",array(array(":reqn",$username,-1)));
			}catch(Exception $e){
				die("Serverul a intalnit o eroare: ".$e->getMessage());
			}
			foreach($rez as $r){
				$cont=$r['CONT'];
			}

			if($cont!=0){
				try{
					$rez=$db->execFetchAll("select ltrim(rtrim(passwd)) as passwd from admin where username=:reqn1",array(array(":reqn1",$username,-1)));
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
			return $cont;
		}
		public function checkUser($username){
			try{
			$db= new Database();
			}catch(Exception $e){
				die("Serverul a intalnit o eroare: ".$e->getMessage());
			}
			try{
			$rez=$db->execFetchAll("select count(username) as cont from utilizatori where username=:reqn2",array(array(":reqn2",$username,-1)));
			}catch(Exception $e){
				die("Serverul a intalnit o eroare: ".$e->getMessage());
			}
			foreach($rez as $r){
				$cont=$r['CONT'];
			}
			if ($cont!=0){
				try{
					$rez=$db->execFetchAll("select ltrim(rtrim(passwd)) as passwd from utilizatori where username=:reqn",array(array(":reqn",$username,-1)));
				}catch(Exception $e){
					die("Serverul a intalnit o eroare: ".$e->getMessage());
				}
				foreach($rez as $r){
					$pass=$r['PASSWD'];
				}
				if($pass==md5($_REQUEST['passwd'])){
					$_SESSION['username']=$_REQUEST['nume'];
					$_SESSION['password']=$pass;
					header("Location: \\BoW/index.php");
				}
				else{
					echo "<p>Numele de utlizator sau parola sunt gresite .O sa fiti redirectionat pe pagina de login in 2 secunde.</p>";
					header("refresh:2;url=\\BoW/login.php");
				}
			}
			else{
				echo "<p>Numele de utlizator nu exista. O sa fiti redirectionat pe pagina de login in 2 secunde.</p>";	
				header("refresh:2;url=\\BoW/login.php");
			}
		}
		public function logout(){
			session_destroy();
			header("Location: index.php");
		}
	}
?>