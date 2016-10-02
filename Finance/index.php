<?php
session_start();
if($_SESSION['email']==""|| $_SESSION['pass']=="") {
    header("location: ../login.html"); 
    exit();
}
$sid=$_SESSION["id"];
require_once("../db/db.php");
if(isset($_POST["add"]))
{
	$name=$_POST["name"];
	$price=$_POST["price"];
	$type=$_POST["type"];
	$date=$_POST["datedo"];
	$sql = "INSERT INTO `myagro`.`finance` (`name`, `price`, `type`, `datedo`, `postedby`) VALUES ('".$name."', '$price', '".$type."', '".$date."', '$sid')";
	$run=mysql_query("$sql");
	if($run)
		echo "<script>alert('Your data was successfully added');</script>";
}
$intial=0;
$spent=0;
$gain=0;
$getdata=mysql_query("SELECT * FROM  `finance` WHERE postedby ='$sid'");
while($row=mysql_fetch_array($getdata))
{
	$price=$row['price'];
	$type=$row['type'];
	if($type=="buy")
	{
		$intial=$intial-$price;
		$spent=$spent+$price;
	}
	else if($type=="sell")
	{
		$intial=$intial+$price;
		$gain=$gain+$price;
	}
}
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
		<script src="../js/prefixfree.min.js"></script>
		<link rel="stylesheet" href="../css/ProfileStyle.css">
	</head><!--/head-->
	<body>
		<div class="header navbar-fixed-top">
			<table>
				<tr>
					<td style = "color:white;width:100%"><img src="../img/logo.png"></td>
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
			<a href="../FarmersProfile.php"><i class="glyphicon glyphicon-home"></i>&nbsp;Home</a>
			<a href="../Profile.php"><i class="glyphicon glyphicon-user"></i>&nbsp;Profile</a>
			<a href="../bid/index.php"><i class="glyphicon glyphicon-king"></i>&nbsp;Bid</a><a href="../Search.php"><i class="glyphicon glyphicon-search"></i>&nbsp;Search</a>
			<a href="../PublicChat.php"><i class="glyphicon glyphicon-envelope"></i>&nbsp;Chat</a>
			<a href="../weather/index.html"><i class="glyphicon glyphicon-info-sign"></i>&nbsp;Climate</a>
			<a href="../tips_add_tricks/index.html"><i class="glyphicon glyphicon-edit"></i>&nbsp;Tips and tricks</a>
			<a href="index.php"  class="active"><i class="glyphicon glyphicon-usd"></i>&nbsp;Finance</a>
			<a href="../Ecommerce/index.php"><i class="glyphicon glyphicon-shopping-cart"></i>&nbsp;E-commerce</a>
			<a href="../Logout.php"><i class="glyphicon glyphicon-off"></i>&nbsp;Logout</a>
		</div>
		<section>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<br><br><br><br>
					</div>
					<div class="col-md-3 sidenavbar">
						<div style="background:black;padding:8px 8px;color:white;font-weight:bold;text-align:center;">STATICS</div>
						<table class="table table-striped">
							<tr>
								<td>
									<b>Spent :</b>
								</td>
								<td><?php echo '&nbsp;'.$spent ?> Rs
								</td>
							</tr>
								<td>
									<b>Gain :</b>
								</td>
								<td><?php echo '&nbsp;'.$gain ?> Rs
								</td>
							<tr>
							</tr>
							<tr>
								<td>
									<b>Total :</b>
								</td>
								<td><?php echo '&nbsp;'.$intial ?> Rs
								</td>
							</tr>
						</table>
					</div>
					<div class="col-md-9">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3>Add data</h3>
							</div>
							<div class="panel-body">
								<form action="" enctype="multipart/form-data" name="myForm" method="post">
									<input type="text" name="name" placeholder="Enter name" class = "form-input" required="required">
									<input type="number" name="price" class = "form-input" required="required" placeholder="Enter price " >
									<input type="radio" name="type" value="sell" >Sell
									<input type="radio" name="type" value="buy" checked="checked">Buy
									<input type="date" name="datedo" class = "form-input" required="required"  placeholder="Enter date you do" value="date()">
							</div>
							<div class="panel-footer text-center">
									<input type="submit" name="add" id="button" class="btn btn-success" value="Add data" />
								</form>
							</div>
						</div>
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

