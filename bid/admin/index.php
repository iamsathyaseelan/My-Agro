<?php
session_start();
if($_SESSION['email']==""|| $_SESSION['pass']=="") {
    header("location: .php"); 
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
		<script src="../../js/prefixfree.min.js"></script>
		<link rel="stylesheet" href="../../css/ProfileStyle.css">
	</head><!--/head-->
	<body>
		<div class="header navbar-fixed-top">
			<table>
				<tr>
					<td style = "color:white;width:100%"><img src="../../img/logo.png"></td>
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
			<a href="#"><i class="glyphicon glyphicon-home"></i>&nbsp;Home</a>
			<a href="../../Profile.php"><i class="glyphicon glyphicon-user"></i>&nbsp;Profile</a>
			<a href="../index.php"  class="active"><i class="glyphicon glyphicon-king"></i>&nbsp;Bid</a>
			<a href="#"><i class="glyphicon glyphicon-search"></i>&nbsp;Search</a>
			<a href="../../PublicChat.php"><i class="glyphicon glyphicon-envelope"></i>&nbsp;Chat</a>
			<a href="#"><i class="glyphicon glyphicon-info-sign"></i>&nbsp;Climate</a>
			<a href="../../Ecommerce/index.php"><i class="glyphicon glyphicon-shopping-cart"></i>&nbsp;E-commerce</a>
			<a href="../../Logout.php"><i class="glyphicon glyphicon-off"></i>&nbsp;Logout</a>
		</div>
		<section>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<br><br><br><br>
					</div>
					<div class="col-md-3 sidenavbar">
						<div style="background:black;padding:8px 8px;color:white;font-weight:bold;text-align:center;">MENU</div>
						<a href="Addproducts.php"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp;Add Products</a>
						<a href="../index.php"><i class="glyphicon glyphicon-arrow-left"></i>&nbsp;Back</a>
						<br><br>
					</div>
					<div class="col-md-9">
						<table class="table" >
							<tr>
								<td><b>Name</b></td>
								<td><b>Price</b></td>
								<td><b>quanity</b></td>
								<td><b>Description</b></td>
								<td><b>Go</b></td>
							</tr>
							<?php
								include('../../db/db.php');
								$sql = mysql_query("SELECT * FROM bidproducts where postedby=$sid");
								$count=mysql_num_rows($sql);
								echo "<h3>You have posted ".$count." Products";
								if($count>0)
								{
									while ($row = mysql_fetch_array($sql))
									{
										$id = $row["id"];
										$name = $row["name"];
										$descr = $row["descr"];
										$quantity = $row["quantity"];
										$price = $row["price"];
										echo '
											<td>'.$name.'</td>
											<td>'.$price.'</td>
											<td>'.$quantity.'</td>
											<td>'.$descr.'</td>
											<td><a href="viewDetails.php?proid='.$id.'" role="button" class="btn btn-success">Go</a></td>
										';
									}
								}
								else
								{
									echo "No products found";
								}
							?>
						</table>
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