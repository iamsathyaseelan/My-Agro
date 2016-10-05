<?php
require_once("db/db.php");
session_start();
if($_SESSION['email']==""|| $_SESSION['pass']=="") 
{
    header("location: ../login.html"); 
    exit();
}
$sid=$_SESSION["id"];
?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Farmers Profile</title>
    <script src="http://s.codepen.io/assets/libs/modernizr.js" type="text/javascript"></script>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="js/prefixfree.min.js"></script>
	<link rel="stylesheet" href="css/ProfileStyle.css">
  </head>

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
			<a href="FarmersProfile.php" class="active"><i class="glyphicon glyphicon-home"></i>&nbsp;Home</a>
			<a href="Profile.php"><i class="glyphicon glyphicon-user"></i>&nbsp;Profile</a>
			<a href="bid/index.php"><i class="glyphicon glyphicon-king"></i>&nbsp;Bid</a>
			<a href="Search.php"><i class="glyphicon glyphicon-search"></i>&nbsp;Search</a>
			<a href="PublicChat.php"><i class="glyphicon glyphicon-envelope"></i>&nbsp;Chat</a>
			<a href="weather/index.html"><i class="glyphicon glyphicon-info-sign"></i>&nbsp;Climate</a>
			<a href="tips_add_tricks/index.html"><i class="glyphicon glyphicon-edit"></i>&nbsp;Tips and tricks</a>
			<a href="Finance/index.php"><i class="glyphicon glyphicon-usd"></i>&nbsp;Finance</a>
			<a href="Ecommerce/index.php"><i class="glyphicon glyphicon-shopping-cart"></i>&nbsp;E-commerce</a>
			<a href="Logout.php"><i class="glyphicon glyphicon-off"></i>&nbsp;Logout</a>
		</div>
		<section class="farmer-progress">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<br><br><br><br>
					</div>
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3>Notifications</h3>
							</div>
							<div class="panel-body" style="max-height:300px;scroll:auto;">
								<table class="table table-striped">
									<?php
										$notification=mysql_query("SELECT * FROM notification WHERE id='$sid' ORDER BY `nid` DESC");
										while($row=mysql_fetch_array($notification))
										{
											$msg=$row['msg'];
											echo '<tr><td>'.$msg.'</td></tr>';
										}
									?>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<div class="col-md-12">
			<br><br><br><br>
		</div>
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
