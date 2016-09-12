<?php
	session_start();
	if($_SESSION['email']==""|| $_SESSION['pass']=="")
	{
		header('Location: login.html');
	}
?>