<!DOCTYPE html>
<html lang="en">
<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <title>My Agro-Registration</title>
		<link href='img/favicon.png' rel='icon'>
	    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script src="js/prefixfree.min.js"></script>
		<link rel="stylesheet" href="css/ProfileStyle.css">
		<script>
			$(document).ready(function(){
				setInterval(function() {
					$("#messages").load("logs.php");
				}, 1000);
			});

		</script>
	</head><!--/head-->
	<body>
		<div class="header navbar-fixed-top">
			<table>
				<tr>
					<td style = "color:white;width:100%"><img src="img/logo.png"></td>
					<td style = "color:black;" class="text-right">
						<button type="button" onClick="openNav()">
							<i style="font-size:20px;" class="glyphicon glyphicon-menu-hamburger"></i>
						</button>
					</td>
				</tr>
			</table>
		</div>		
		<div id="mySidenav" class="sidenav">
			<a href="javascript:void(0)" class="closebtn" onClick="closeNav()"><i class="glyphicon glyphicon-minus"></i></a>
			<a href="FarmersProfile.php" ><i class="glyphicon glyphicon-home"></i>&nbsp;Home</a>
			<a href="Profile.php"><i class="glyphicon glyphicon-user"></i>&nbsp;Profile</a>
			<a href="bid/index.php"><i class="glyphicon glyphicon-king"></i>&nbsp;Bid</a>
			<a href="Search.php"><i class="glyphicon glyphicon-search"></i>&nbsp;Search</a>
			<a href="PublicChat.php" class="active"><i class="glyphicon glyphicon-envelope"></i>&nbsp;Chat</a>
			<a href="weather/index.html"><i class="glyphicon glyphicon-info-sign"></i>&nbsp;Climate</a>
			<a href="tips_add_tricks/index.html"><i class="glyphicon glyphicon-edit"></i>&nbsp;Tips and tricks</a>
			<a href="Finance/index.php"><i class="glyphicon glyphicon-usd"></i>&nbsp;Finance</a>
			<a href="Ecommerce/index.php"><i class="glyphicon glyphicon-shopping-cart"></i>&nbsp;E-commerce</a>
			<a href="Logout.php"><i class="glyphicon glyphicon-off"></i>&nbsp;Logout</a>
		</div>
	<section>
		<div class = "container">
			<div class = "row">
				<div class = "col-md-12">
					<br><br><br><br>
				</div>
				<div class = "col-md-3">
				</div>
				<div class = "col-md-6">
					<div class="panel panel-default">
							<div class="panel-heading">
								<h3>Public Chat</h3>
							</div>
							<div class="panel-body msgs" >
							<table class="table table-striped" id="messages">
								<?php
									require_once("db/db.php");
									session_start();
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
								</table>
							</div>
							<div class="panel-footer text-center">
								<input type="text" id="txtmsg" class="msg-box" placeholder="Enter message to send";>
								<button class="btn btn-success" onclick ="insertchat()"><span class="glyphicon glyphicon-send"></span></button>
							</div>
							<script>
								function insertchat()
								{
									var msgs=document.getElementById('txtmsg').value;
									var dataString = 'msg='+ msgs;
									$.ajax({
										type: "POST",
										url: "insertchat.php",
										data: dataString,
										cache: false
									});
								}
							</script>
						</div>
				</div>
				<div class = "col-md-3">
				</div>
			</div>
		</div>
		<br><br><br>
	</section>
	<footer>
		All rights are reserved by team My-Agro &copy;
	</footer>
	<script>
		function openNav() {
		    document.getElementById("mySidenav").style.width = "250px";
		    document.getElementById("main").style.marginLeft = "250px";
		}

		function closeNav() {
		    document.getElementById("mySidenav").style.width = "0";
		    document.getElementById("main").style.marginLeft= "0";
		}
	</script>
</body>
</html>
