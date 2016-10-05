<?php
session_start();
if($_SESSION['email']==""|| $_SESSION['pass']=="") {
    header("location: .php"); 
    exit();
}
$sid=$_SESSION["id"];
?>
<?php 
include_once("../../db/db.php");
$product_list = "";
$sql = mysql_query("SELECT * FROM bidproducts WHERE postedby='$sid'  ORDER BY id DESC");
$productCount = mysql_num_rows($sql); 
if ($productCount > 0 ) {
	while($row = mysql_fetch_array($sql)){ 
             $id = $row["id"];
			 $product_name = $row["name"];
			 $price = $row["price"];
			 $product_list .= "<b>".$product_name."</b>- Rs ".$price."&nbsp;&nbsp;<a href='Addproducts.php?deleteid=$id'><span class='glyphicon glyphicon-trash'></span></a><br />";
    }
} else {
	$product_list = "You have no products listed in your store yet";
}
if (isset($_GET['deleteid'])) {
	$id_to_delete=$_GET['deleteid'];
	$sql = mysql_query("DELETE FROM bidproducts WHERE id='$id_to_delete' LIMIT 1") or die (mysql_error());
	if($sql)
		echo "<script>aalert('Product was successfully deleted!');</script>";
	header('Location: Addproducts.php');
}
if (isset($_POST['add'])) {
    $product_name = mysql_real_escape_string($_POST['name']);
	$price = mysql_real_escape_string($_POST['price']);
	$quantity = mysql_real_escape_string($_POST['quantity']);
	$details = mysql_real_escape_string($_POST['descr']);
	$sqlcount = mysql_query("SELECT id FROM bidproducts WHERE postedby='$sid'");
	$productMatchcount = mysql_num_rows($sqlcount);
	if ($productMatchcount > 5) {
		echo 'You could post only 5 products to bid';
		exit();
	}
	
    $pid = mt_rand();
	$errors= array();
	$file_name = $_FILES['fileField']['name'];
	$file_size =$_FILES['fileField']['size'];
	$file_tmp =$_FILES['fileField']['tmp_name'];
	$file_type=$_FILES['fileField']['type'];
	$file_ext=strtolower(end(explode('.',$_FILES['fileField']['name'])));
	  
	$expensions= array("jpeg","jpg","png");
	  
	if(in_array($file_ext,$expensions)=== false){
		$errors[]="extension not allowed, please choose a JPEG or PNG file.";
	}
	if($file_size > 2097152){
		$errors[]='File size must be excately 2 MB';
	}
	  
	if(empty($errors)==true){
		$movefile=move_uploaded_file($file_tmp,"../img/$pid.$file_ext");
		$productpic ="img/$pid.$file_ext";
		$sql = mysql_query("INSERT INTO bidproducts(`name`,`descr`, `price`,`quantity`,`img`,`postedby`) VALUES ('$product_name','$details',$price,'$quantity','$productpic',$sid)") or die (mysql_error());
		if($sql)
		{
			echo "<script>aalert('Product was successfully added!');</script>";
			header("location: Addproducts.php"); 
		}else
			echo "failed";
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
			<a href="../../FarmersProfile.php"><i class="glyphicon glyphicon-home"></i>&nbsp;Home</a>
			<a href="../../Profile.php"><i class="glyphicon glyphicon-user"></i>&nbsp;Profile</a>
			<a href="../index.php"  class="active"><i class="glyphicon glyphicon-king"></i>&nbsp;Bid</a><a href="../../Search.php"><i class="glyphicon glyphicon-search"></i>&nbsp;Search</a>
			<a href="../../PublicChat.php"><i class="glyphicon glyphicon-envelope"></i>&nbsp;Chat</a>
			<a href="../../weather/index.html"><i class="glyphicon glyphicon-info-sign"></i>&nbsp;Climate</a>
			<a href="../../tips_add_tricks/index.html"><i class="glyphicon glyphicon-edit"></i>&nbsp;Tips and tricks</a>
			<a href="../../Finance/index.php"><i class="glyphicon glyphicon-usd"></i>&nbsp;Finance</a>
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
						<a href="Addproducts.php"class="active"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp;Add Products</a>
						<a href="../index.php"><i class="glyphicon glyphicon-arrow-left"></i>&nbsp;Back</a>
						<br><br>
					</div>
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3>Add Products</h3>
							</div>
							<div class="panel-body">
								<form action="" enctype="multipart/form-data" name="myForm" method="post">
									<input type="text" class="form-input" required="required" name="name" placeholder="Enter product name" />
									<input type="text" class="form-input"required="required" name="price" placeholder="Enter product Price" />
									<input type="text" class="form-input"required="required" name="quantity" placeholder="Enter product quantity" />
									<input type="file" name="fileField"  required="required"/>
									<textarea  class="form-input" name="descr" required="required"placeholder="Enter product description " ></textarea>
							</div>
							<div class="panel-footer text-center">
									<input type="submit" name="add" id="button" class="btn btn-success" value="Apply for bid" />
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<?php echo $product_list; ?>
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