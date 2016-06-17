<?php
	session_start();
	require_once("apps/UsersManag.php");
    $users=new Users();
	$users->logout();
?>
