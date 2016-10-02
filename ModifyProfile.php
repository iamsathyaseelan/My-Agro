<?php
session_start();
require_once("db/db.php");
if(isset($_POST["update"])){
 	$sid=$_SESSION["id"];
	$fname=$_POST["fname"];
	$lname=$_POST["lname"];
	$add1=$_POST["add1"];
	$add2=$_POST["add2"];
	$dist=$_POST["dist"];
	$state=$_POST["state"];
	$pin=$_POST["pin"];
	$acres=$_POST["acres"];
	$cul=$_POST["cul"];
	$amt=$_POST["amt"];
	$startdate=$_POST["startdate"];
	$enddate=$_POST["enddate"];
	$errors= array();
	$file_name = $_FILES['profilepic']['name'];
	$file_size =$_FILES['profilepic']['size'];
	$file_tmp =$_FILES['profilepic']['tmp_name'];
	$file_type=$_FILES['profilepic']['type'];
	$file_ext=strtolower(end(explode('.',$_FILES['profilepic']['name'])));
	$expensions= array("jpeg","jpg","png");
	if(in_array($file_ext,$expensions)=== false){
		$errors[]="<script>alert('extension not allowed, please choose a JPEG or PNG file.');</script>";
	}
	  
	if($file_size > 2097152){
		$errors[]="<script>alert('File size must be excately 2 MB');</script>";
	}
	  
	if(empty($errors)==true){
		$movefile=move_uploaded_file($file_tmp,"img/profilepic/$sid.$file_ext");
		$profilepic ="img/profilepic/$sid.$file_ext";
		
		$update = mysql_query("UPDATE profile SET 
			fname='".$fname."',lname='".$lname."',addr1='".$add1."',addr2='".$add2."',dist='".$dist."',state='".$state."',pin=$pin,acres=$acres,
			cul=$cul,amt=$amt,startdate='".$startdate."',enddate='".$enddate."',profilepic='".$profilepic."' WHERE uid=$sid");
		if($update)
		{
			echo '<script>alert("Success ! Your data updated successfully ");</script>';
		}
	}
		
}
$sid=$_SESSION["id"];
$sql = mysql_query("SELECT * FROM profile WHERE uid='$sid' LIMIT 1");
$profileMatch = mysql_num_rows($sql); // count the output amount
if ($profileMatch > 0){
	while($row=mysql_fetch_array($sql))
	{
		$sid1=$_SESSION["id"];
		$fname1=$row["fname"];
		$lname1=$row["lname"];
		$add11=$row["addr1"];
		$add21=$row["addr2"];
		$dist1=$row["dist"];
		$state1=$row["state"];
		$pin1=$row["pin"];
		$acres1=$row["acres"];
		$cul1=$row["cul"];
		$amt1=$row["amt"];
		$startdate1=$row["startdate"];
		$enddate1=$row["enddate"];
		$pic1=$row["profilepic"];
	}
}
else
{
	$sid1=$fname1=$add11=$acres1=$cul1=$amt1=$startdate1=$enddate1=$add21=$lname1=$dist1=$state1=$pin1="";
}
?>
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
			<a href="Profile.php" class="active"><i class="glyphicon glyphicon-user"></i>&nbsp;Profile</a>
			<a href="bid/index.php"><i class="glyphicon glyphicon-king"></i>&nbsp;Bid</a>
			<a href="Search.php"><i class="glyphicon glyphicon-search"></i>&nbsp;Search</a>
			<a href="PublicChat.php"><i class="glyphicon glyphicon-envelope"></i>&nbsp;Chat</a>
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
				<form name="" action="" enctype="multipart/form-data" method="post">
				<div class = "col-md-6">
					<h3>Personal details </h3>
					<div class = "form-content">
							<input class = "form-input-2" type = "text" name = "fname" value="<?php echo $fname1; ?>" placeholder = "Enter First name" >
							<input class = "form-input-2" type = "text" name = "lname" value="<?php echo $lname1; ?>" placeholder = "Enter Last name" >
							<input class = "form-input" type = "text" name = "add1" value="<?php echo $add11; ?>" placeholder = "Enter Address line 1">
							<input class = "form-input" type = "text" name = "add2" value="<?php echo $add21; ?>" placeholder = "Enter Address line 2">
							<input class = "form-input" type = "text" name = "dist" value="<?php echo $dist1; ?>" placeholder = "Enter district name ">
							<input class = "form-input" type = "text" name = "state" value="<?php echo $state1; ?>" placeholder = "Enter state name ">
							<input class = "form-input" type = "number" name = "pin" value="<?php echo $pin1; ?>" placeholder = "Enter PIN code ">
							Profile Picture<input type="file" name="profilepic">
					</div>
				</div>
				<div class = "col-md-6">
					<h3>Agriculture details </h3>
					<div class = "form-content">
							<input class = "form-input-2" type = "number" name = "acres" value="<?php echo $acres1; ?>" placeholder = "Number of acres" >
							<input class = "form-input-2" type = "number" name = "cul" value="<?php echo $cul1; ?>" placeholder = "Acres to cultivate" >
							<input class = "form-input" type = "number" name = "amt" value="<?php echo $amt1; ?>" placeholder = "Target amount to earn-this year ">
							<input class = "form-input" type = "date" name = "startdate" value="<?php echo $startdate1; ?>" placeholder = "Target starts from">
							<input class = "form-input" type = "date" name = "enddate" value="<?php echo $enddate1; ?>" placeholder = "Target ended at">
					</div>
				</div>
				<div class ="col-md-12 text-right">
					<div class="btn-group">
						<a href="Profile.php" role="button" class="btn btn-success">Back to profile</a>
						<button type="submit" name="update" class="btn btn-primary">Update details</button>
					</div>
				</div>
				</form>
			</div>
		</div>
		<br>
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
