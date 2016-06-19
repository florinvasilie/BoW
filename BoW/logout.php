<?php
	session_start();
	require_once("apps/manage.php");
    $users=new Users();
	$users->logout();
?>
