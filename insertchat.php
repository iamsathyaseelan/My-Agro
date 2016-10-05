<?php
session_start();
require_once("db/db.php");
$sid=$_SESSION["id"];
$msg=$_POST["msg"];
$sql = "INSERT INTO `publicchat` (`sid`, `msg`) VALUES ($sid, '$msg')";
$insert=mysql_query($sql);
if($insert)
	echo 's';
else
	echo 'f';
?>