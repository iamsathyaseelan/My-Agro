<?php
session_start();
include('../db/db.php');
$randomString= mt_rand();
$cartTotal = "";
$cartOutput= "";
$makeResult="";
$product_id_array = '';
if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) {
    $cartOutput = "<h2 align='center'>Your shopping cart is empty</h2>";
} else {
	$i = 0; 
    foreach ($_SESSION["cart_array"] as $each_item)
	{ 
		$item_id = $each_item['item_id'];
		$sql = mysql_query("SELECT * FROM products WHERE id='$item_id' LIMIT 1");
		while ($row = mysql_fetch_array($sql)) {
			$price = $row["price"];
			$details = $row["descr"];
			$img = $row["img"];
			$userid=$row['userid'];
		}
		$pricetotal = $price * $each_item['quantity'];
		$cartTotal = $pricetotal + $cartTotal;
		$x = $i + 1;
		$product_id_array .= "$item_id-".$each_item['quantity'].","; 
		// Dynamic table row assembly
		$cartOutput .= "<tr>";
		$cartOutput .= '<td><img src="' . $img . '" alt="Image not found" height="52" /></td>';
		$cartOutput .= '<td>' . $details . '</td>';
		$cartOutput .= '<td>$' . $price . ' Rs</td>';
		$cartOutput .= '<td>$'. $each_item['quantity']. '</td>';
		$cartOutput .= '<td>' . $pricetotal . ' Rs</td>';
		$cartOutput .= '</tr>';
		$i++; 
    } 
}
if($_POST)
{
	$name = $_POST['name'];
	$email = $_SESSION['email'];
	$tel = $_POST['tel'];
	$addr = $_POST['addr'];
	$pincode = $_POST['pincode'];
	$sqltoemail="select * from products";
	if($pincode!="")
	{
		$Total=$cartTotal+20;
		$to = "iamsathyaseelan@gmail.com";
		$subject = $randomString;
		$message = '
		<html>
			<head>
			</head>
			<body>
				<table align="center" style="width:100%;text-align:center; background-color:black;color:white;">
					<tr>
						<td style="width:50%;text-align:left;"><img src="img/logo.png" alt="Karikkadai" class="logo" /></td>
						<td style="width:25%"><b>+91 99 76 016 102</b></td>
						<td style="width:25%"><b>My agro</b></td>
					</tr>
				</table>
				<div><br><br>Your Order Id :'.$randomString.'<br></div>
				<table border="2" align="center" style="width:100%;text-align:center">
					<tr>
						<td><b>Product</b></td>
						<td><b>Name</b></td>
						<td><b>Price</b></td>
						<td><b>Quantity</b></td>
						<td><b>Total</b></td>
					</tr>'. $cartOutput.'
				</table>
				<table border="2" style="width:30%;text-align:center" align="right">
					<tr>
						<td style="padding:10px;"><b>Cart Sub Total</b></td>
						<td>'.$cartTotal.' Rs</td>
					</tr>
					<tr>
						<td style="padding:10px;"><b>Tax</b></td>
						<td>10 Rs</td>
					</tr>
					<tr>
						<td style="padding:10px;"><b>Shipping Cost</b></td>
						<td>10 Rs</td>
					</tr>
					<tr>
						<td style="padding:10px;"><b>Cart Sub Total</b></td>
						<td>'.$Total.' Rs</td>
					</tr>
				</table>
			</body>
		</html>
		';
		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <webmaster@example.com>' . "\r\n";
		$headers .= 'Cc: myboss@example.com' . "\r\n";

		$send = mail($to,$subject,$message,$headers);
		//!
		if(!$send)
		{
		 	foreach ($_SESSION["cart_array"] as $each_item)
			{ 
				$item_id = $each_item['item_id'];
				$sql = mysql_query("SELECT * FROM products WHERE id='$item_id' LIMIT 1");
				while ($row = mysql_fetch_array($sql)) {
					$price = $row["price"];
					$details = $row["descr"];
					$img = $row["img"];
					$userid=$row['userid'];
					$sql = "INSERT INTO `orders` (`name`, `email`, `tel`, `addr`, `process`, `code`, price,dateordered) 
			VALUES ('".$name."','".$email."',".$tel.",'".$addr."','new','".$randomString."','".$Total."',now());";
					$sql_res=mysql_query($sql);
				}
			}
		}
		else
		{
		}
	}
	else
	{
		$makeResult="Our service is not available for your area";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Karrikkadai website</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css" />
    <link href="style/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body>
    	<header>
        	<div class="header-top">
            	<div class="container">
                	<div class="row">
                    	<div class="col-md-9">
                        	<ul>
                        		<li><a href="#"><i class="fa fa-phone"></i> +91 99 76 01 102</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> My agro</a></li>
                            </ul>
                        </div>
                        <div class="col-md-3 text-center social-icons">
                        	<ul>
                        		<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        		<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom">
            	<div class="navbar navbar-inverse">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="#"><img src="img/logo.png" alt="Karikkadai" class="logo" /></a>
                        </div>
                        <ul class="nav navbar-nav navbar-right">
							<li><a href="index.html"><i class="fa fa-home"></i> Home</a></li>
							<li><a href="cart.html"><i class="fa fa-shopping-cart"></i> Cart <span class="badge" id="CartItems">0</span></a></li>
							<li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
		<section>
			<div class="container">
				<div class="row">
					<div class="col-md-12 text-center">
						<?php
							if($makeResult!="")
								echo $makeResult;
							else
							{
								echo '
									<h2>Thankyou For Shopping</h2>
									<h5>We always welcome you</h5>
									<br><br>
									<a role="button" class="btn btn-success btn-lg" href="index.html">Buy More</a>';
							}
						?>
					</div>
				</div>
			</div>
		</section>
    </body>
</html>