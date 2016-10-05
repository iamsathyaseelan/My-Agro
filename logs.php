<?php
session_start();
require_once("db/db.php");
$select="SELECT * FROM `publicchat` ORDER BY id DESC LIMIT 10";
$color="";
$do=mysql_query($select);
while($row=mysql_fetch_assoc($do))
{
	$msg=$row["msg"];
	$id=$row["sid"];
	$dandt=strtotime($row["dandt"]);
	$selectImg="SELECT * FROM `register` where id='".$id."'";
	$doid=mysql_query($selectImg);
	while($rowid=mysql_fetch_assoc($doid))
	{
		$uname=$rowid["uname"];
		if($_SESSION["id"]==$id)
		$color="success";
		else
		$color="info";
		echo '<tr class="'.$color.'">
		<td><span style="font-size:12px;">'.$uname.'</span></td>
		<td><span style="font-size:12px;">'.$msg.'</span></td>
		<td><span style="font-size:10px;">'.date("Y-m-d h:a", $dandt).'</span></td>
		</tr>';
	}
}
?>
<script>
			$(document).ready(function(e){
					$.ajaxSetup({cache:false});
					setInterval(function(){$(#messages).load('logs.php');}, 2000);
			});
		</script>