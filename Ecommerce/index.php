<?php
session_start();
if($_SESSION['email']==""|| $_SESSION['pass']=="") {
    header("location: ../login.html"); 
    exit();
}
$sid=$_SESSION["id"];
if (!isset($_SESSION["NoOfItemsInCart"]))
{
	$_SESSION['NoOfItemsInCart']=0;
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
		<script>
			$(document).ready(function(){
				load('CheckLogin.php');
			});
		</script>
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
			<a href="../FarmersProfile.html"><i class="glyphicon glyphicon-home"></i>&nbsp;Home</a>
			<a href="../Profile.php"><i class="glyphicon glyphicon-user"></i>&nbsp;Profile</a>
			<a href="../bid/index.php"><i class="glyphicon glyphicon-king"></i>&nbsp;Bid</a>
			<a href="#"><i class="glyphicon glyphicon-search"></i>&nbsp;Search</a>
			<a href="../PublicChat.php"><i class="glyphicon glyphicon-envelope"></i>&nbsp;Chat</a>
			<a href="#"><i class="glyphicon glyphicon-info-sign"></i>&nbsp;Climate</a>
			<a href="../Ecommerce/index.php" class="active"><i class="glyphicon glyphicon-shopping-cart"></i>&nbsp;E-commerce</a>
			<a href="../Logout.php"><i class="glyphicon glyphicon-off"></i>&nbsp;Logout</a>
		</div>
		<section>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<br><br><br><br>
					</div>
					<div class="col-md-3 sidenavbar">
						<div style="background:black;padding:8px 8px;color:white;font-weight:bold;text-align:center;">MENU</div>
						<a href="admin/index.php"><i class="glyphicon glyphicon-tags"></i>&nbsp;Sell products</a>
						<a href="Pesticide.php"><i class="glyphicon glyphicon-remove-sign"></i>&nbsp;Pesticide</a>
						<a href="Fertilizer.php"><i class="glyphicon glyphicon-grain"></i>&nbsp;Fertilizer</a>
						<a href="search.php"><i class="glyphicon glyphicon-search"></i>&nbsp;Search</a>
						<a href="cart.php"><i class="glyphicon glyphicon-shopping-cart"></i>&nbsp;Cart<span class="badge  pull-right" id="CartItems"><?php echo $_SESSION['NoOfItemsInCart'];?></span></a>
						<a href="checkout.php"><i class="glyphicon glyphicon-screenshot"></i>&nbsp;Checkout</a>
						<br><br>
					</div>
					<div class="col-md-9">
						<script>
							function AddToCart(pid){
								var dataString = 'pid='+ pid;
								$.ajax({
									type: "POST",
									url: "AddToCart.php",
									data: dataString,
									cache: false,
									success: function(html)
									{
										$("#CartItems").html(html).show();
									}
								});
							}
						</script>
						<?php
							include('../db/db.php');
								
							$sql_res=mysql_query("select * from products where userid!=$sid limit 12 ");
							while($row=mysql_fetch_array($sql_res))
							{
								$unit=$row['unit'];
								$descr=$row['descr'];
								$img=$row['img'];
								$id=$row['id'];
								$userid=$row['userid'];
								$price=$row['price'];
								echo '
									<div class="col-md-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="'. $img .'" alt="'. $descr .'" class="img img-responsive"  title="'. $descr .'" />
													<h4>Rs. '.$price.' &#x20b9; / '.$unit.'</h4>
													<p>'.$descr.'</p>
													<button class="btn btn-default add-to-cart" onClick="AddToCart('.$id.')"><i class="fa fa-shopping-cart"></i> Add to cart</button>
												</div>
											</div><br />
										</div>
									</div>
								';
								}
						?>
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

