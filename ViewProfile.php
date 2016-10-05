<?php				
include('db/db.php');
session_start();
if($_SESSION['email']==""|| $_SESSION['pass']=="") {
    header("location: login.html"); 
    exit();
}
$sid=$_SESSION["id"];
?>
<!DOCTYPE html>
<html>
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
			<a href="FarmersProfile.php"><i class="glyphicon glyphicon-home"></i>&nbsp;Home</a>
			<a href="Profile.php"><i class="glyphicon glyphicon-user"></i>&nbsp;Profile</a>
			<a href="index.php"  class="active"><i class="glyphicon glyphicon-king"></i>&nbsp;Bid</a>
			<a href="Search.php"><i class="glyphicon glyphicon-search"></i>&nbsp;Search</a>
			<a href="PublicChat.php"><i class="glyphicon glyphicon-envelope"></i>&nbsp;Chat</a>
			<a href="weather/index.html"><i class="glyphicon glyphicon-info-sign"></i>&nbsp;Climate</a>
			<a href="tips_add_tricks/index.html"><i class="glyphicon glyphicon-edit"></i>&nbsp;Tips and tricks</a>
			<a href="Finance/index.php"><i class="glyphicon glyphicon-usd"></i>&nbsp;Finance</a>
			<a href="Ecommerce/index.php"><i class="glyphicon glyphicon-shopping-cart"></i>&nbsp;E-commerce</a>
			<a href="Logout.php"><i class="glyphicon glyphicon-off"></i>&nbsp;Logout</a>
		</div>
		<section>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<br><br><br><br>
					</div>
					<div class="col-md-12">
						<?php
							if(isset($_GET['uid']))
							{
								$uid=$_GET['uid'];
								$sql_res=mysql_query("select * from profile where uid=$uid");
								while($row=mysql_fetch_array($sql_res))
								{
									$fname1=$row["fname"];
									$lname1=$row["lname"];
									$add11=$row["addr1"];
									$add21=$row["addr2"];
									$dist1=$row["dist"];
									$state1=$row["state"];
									$pin1=$row["pin"];
									$acres1=$row["acres"];
									$cul1=$row["cul"];
									$pic1=$row["profilepic"];
									echo '
										<div class="col-md-3">
											<img src="'.$pic1.'" class="img img-responsive">
										</div>
										<div class="col-md-9 table-responsive">
											<table class="table table-striped">
												<tr>
													<td><b>Name</b></td>
													<td>'.$fname1.'&nbsp;'.$lname1.'</td>
												</tr>
												<tr>
													<td><b>Address</b></td>
													<td>'.$add11.'<br>'.$add21.'<br>'.$dist1.'<br>'.$state1.'</td>
												</tr>
												<tr>
													<td><b>Acres had</b></td>
													<td>'.$acres1.'&nbsp; Acres </td>
												</tr>
												<tr>
													<td><b>Cultivatable land</b></td>
													<td>'.$cul1.'&nbsp; Acres </td>
												</tr>
												<tr>
													<td><b>Follow</b></td>
													<td><a href="ViewProfile.php?follow='.$uid.'" role="button" class="btn btn-success">Follow</a></td>
												</tr>
											</table>
										</div>
									';
								}
							}
							if(isset($_GET['follow']))
							{
								$uid=$_GET['follow'];
								$sql_res=mysql_query("select * from follow where followedby=$sid and follower=$uid");
								$count=mysql_num_rows($sql_res);
								if($count>0)
								{
									echo '<script>alert("You already followed");</script>';
									header('Location: ViewProfile.php?uid='.$uid.'');
								}
								else
								{	
									$notification=mysql_query("INSERT INTO `notification` (`id`, `msg`) VALUES ( '$uid', '".$_SESSION['uname']." followed you')");
									$follow=mysql_query("INSERT INTO `follow` (`follower`, `followedby`) VALUES ( '$uid', '$sid')");
									
									if($follow && $notification)
										echo '<script>alert("Now you successfully followed");</script>';
									header('Location: ViewProfile.php?uid='.$uid.'');
								}
								
							}
						?>
						<div class='col-md-12'><br><br></div>
					</div>
				</div>
			</div>
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

