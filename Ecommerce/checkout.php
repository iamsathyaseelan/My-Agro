<?php
session_start();
if($_SESSION['email']==""|| $_SESSION['pass']=="") {
    header("location: .php"); 
    exit();
}
$sid=$_SESSION["id"];
if (!isset($_SESSION["NoOfItemsInCart"]))
{
	$_SESSION['NoOfItemsInCart']=0;
}
if (isset($_GET['cmd']) && $_GET['cmd'] == "emptycart") {
    unset($_SESSION["cart_array"]);
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
					<td style = "color:white;width:1080px"><img src="../img/logo.png"></td>
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
			<a href="../Profile.php"><i class="glyphicon glyphicon-user"></i>&nbsp;Profile</a>
			<a href="#"><i class="glyphicon glyphicon-king"></i>&nbsp;Status</a>
			<a href="#"><i class="glyphicon glyphicon-search"></i>&nbsp;Search</a>
			<a href="../PublicChat.php"><i class="glyphicon glyphicon-envelope"></i>&nbsp;Chat</a>
			<a href="#"><i class="glyphicon glyphicon-info-sign"></i>&nbsp;Climate</a>
			<a href="../Ecommerce.html" class="active"><i class="glyphicon glyphicon-shopping-cart"></i>&nbsp;E-commerce</a>
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
						<a href="Profile.php"><i class="glyphicon glyphicon-remove-sign"></i>&nbsp;Pesticide</a>
						<a href="#"><i class="glyphicon glyphicon-grain"></i>&nbsp;Fertilizer</a>
						<a href="#"><i class="glyphicon glyphicon-search"></i>&nbsp;Search</a>
						<a href="cart.php"><i class="glyphicon glyphicon-shopping-cart"></i>&nbsp;Cart<span class="badge  pull-right" id="CartItems"><?php echo $_SESSION['NoOfItemsInCart'];?></span></a>
						<a href="PublicChat.php"><i class="glyphicon glyphicon-screenshot"></i>&nbsp;Checkout</a>
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
$cartTotal = "";
$product_id_array = '';
if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) {
    echo '<h5 align="center">Your shopping cart is empty</h5>
	<div align="center"><a class="btn btn-default check_out" href="index.html">Continue Shopping</a>
	<br><br><br><div>';
} else {
	$i = 0; 
	echo '
	 <div class="table-responsive cart_info">
            <table class="table table-condensed">
				<thead>
					<tr class="cart_menu">
						<td class="image">Item</td>
						<td class="description">Description</td>
						<td class="quantity">Quantity</td>
						<td class="total">Total</td>
					</tr>
				</thead>
				<tbody id="CartResult">
							
				</tbody>
	';
    foreach ($_SESSION["cart_array"] as $each_item)
	{ 
		$item_id = $each_item['item_id'];
		$sql = mysql_query("SELECT * FROM products WHERE id='$item_id' LIMIT 1");
		while ($row = mysql_fetch_array($sql)) {
			$unit = $row["unit"];
			$price = $row["price"];
			$details = $row["descr"];
			$img = $row["img"];
		}
		$pricetotal = $price * $each_item['quantity'];
		$cartTotal = $pricetotal + $cartTotal;
		$_SESSION["cartTotal"]=$cartTotal;
		$total=$_SESSION["cartTotal"]+20;
		// Create the product array variable
		$product_id_array .= "$item_id-".$each_item['quantity'].","; 
		// Dynamic table row assembly
		echo '
			<tr>
				<td class="cart_product">
					<img src="' . $img .'" class="img img-thumbnail">
				</td>
				<td class="cart_description">
					<h4><a href="">' . $details .'</a></h4>
				</td>
				<td class="cart_quantity">
					<div class="cart_quantity_button">
						<div class="cart_quantity_input">' . $each_item['quantity'] . ' x '.$unit.'</div>
					</div>
				</td>
				<td class="cart_total">
					<p class="cart_total_price">' . $pricetotal . ' &#x20b9;</p>
				</td>
			</tr>
			';
		$i++; 
    }
echo'

			</table>
		</div>
		<div class="row">
					<div class="col-sm-12">
						<ul class="list-group">
							<li class="list-group-item">Cart sub total <span class="badge">'.$_SESSION["cartTotal"].' &#x20b9;</span></li>
							<li class="list-group-item">Eco tax <span class="badge">10 &#x20b9;</span></li>
							<li class="list-group-item">Shipping tax <span class="badge">10 &#x20b9;</span></li>
							<li class="list-group-item">Total <span class="badge">'.$total.' &#x20b9;</span></li>
						</ul>
								<a class="btn btn-default update" href="index.html">Add More Items</a>
								<button role="button" class="btn btn-default check_out" data-toggle="modal" data-target="#MakePayment">Proceed</button>
								<!-- Modal -->
								<div id="MakePayment" class="modal fade" role="dialog">
								  <div class="modal-dialog">
									<!-- Modal content-->
									<div class="modal-content">
									  <div class="modal-header">
										<h4 class="modal-title">Payment and Address</h4>
									  </div>
									  <div class="modal-body">
											<h5><b>Personal Details :</b><h5>
											<form action="FinishMyShopping.php" method="post">
												<input type="text" placeholder="Enter Your name" class="form-input" name="name" required="required" />
												<input type="tel" placeholder="Enter Your Phone Number" class="form-input" required="required" name="tel"/>
												<h5><b>Shipping And Payment Details :</b><h5>
												<input type="radio" placeholder="Enter Your Phone Number" required="required" checked="checked" />Cash On Delivery
												<input type="text" placeholder="Enter Your Area Pincode" class="form-input" required="required" name="pincode"/>										
												<textarea placeholder="Enter Your Address" class="form-input" required="required" name="addr"></textarea>											
												<input type="submit" name="submit" value="Make My Order" class="btn btn-success btn-md" required="required" />
											</form>
									  </div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									  </div>
									</div>
								</div>
								<div><br><br></div>
						</div>
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
<script>
function TodayDate(){
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!

	var yyyy = today.getFullYear();
	if(dd<10){
		dd='0'+dd
	} 
	if(mm<10){
		mm='0'+mm
	} 
	var today = yyyy+'-'+mm+'-'+dd;
	document.getElementById("date").value=today;
}
</script>
