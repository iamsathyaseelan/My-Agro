<?php
session_start();
require_once("db/db.php");
if(isset($_POST["profile"])){
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
	$sql = mysql_query("SELECT uid FROM profile WHERE uid='$sid' LIMIT 1");
	$profileMatch = mysql_num_rows($sql); // count the output amount
    if ($profileMatch > 0) {
		echo 'Sorry your data already found! <a href="editProfile.php">click here to edit</a>';
		exit();
	}
	else
	{
	$errors= array();
		$file_name = $_FILES['profilepic']['name'];
		$file_size =$_FILES['profilepic']['size'];
		$file_tmp =$_FILES['profilepic']['tmp_name'];
		$file_type=$_FILES['profilepic']['type'];
		$file_ext=strtolower(end(explode('.',$_FILES['profilepic']['name'])));
		  
		$expensions= array("jpeg","jpg","png");
		  
		if(in_array($file_ext,$expensions)=== false){
			$errors[]="extension not allowed, please choose a JPEG or PNG file.";
		}
		  
		if($file_size > 2097152){
			$errors[]='File size must be excately 2 MB';
		}
		  
		if(empty($errors)==true){
			$movefile=move_uploaded_file($file_tmp,"img/profilepic/$sid.$file_ext");
			$profilepic ="img/profilepic/$sid.$file_ext";
			$insert = mysql_query("INSERT INTO `profile`
			(`fname`, `lname`, `addr1`, `addr2`, `dist`, `state`, `pin`, `profilepic`, `acres`, `cul`, `amt`, `startdate`, `enddate`, `uid`) VALUES 
			('".$fname."', '".$lname."', '".$add1."', '".$add2."', '".$dist."', '".$state."', ".$pin.", '".$profilepic."', ".$acres.", ".$cul.", ".$amt.", '".$startdate."', '".$enddate."', ".$sid.")");
		}else{
			echo "please check image file";
		}
	}

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
					<td style = "color:white;width:1080px"><img src="img/logo.png"></td>
					<td style = "color:black;" class="text-right">
						<button type="button" onclick="openNav()">
							<i style="font-size:20px;" class="glyphicon glyphicon-menu-hamburger"></i>
						</button>
					</td>
				</tr>
			</table>
		</div>		
		<div id="mySidenav" class="sidenav">
			<a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="glyphicon glyphicon-minus"></i></a>
			<a href="#" class="active"><i class="glyphicon glyphicon-home"></i>&nbsp;Home</a>
			<a href="Profile.php"><i class="glyphicon glyphicon-user"></i>&nbsp;Profile</a>
			<a href="#"><i class="glyphicon glyphicon-king"></i>&nbsp;Status</a>
			<a href="#"><i class="glyphicon glyphicon-search"></i>&nbsp;Search</a>
			<a href="#"><i class="glyphicon glyphicon-envelope"></i>&nbsp;Chat</a>
			<a href="#"><i class="glyphicon glyphicon-info-sign"></i>&nbsp;Climate</a>
			<a href="#"><i class="glyphicon glyphicon-shopping-cart"></i>&nbsp;Cart</a>
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
							<input class = "form-input-2" type = "text" name = "fname" placeholder = "Enter First name" >
							<input class = "form-input-2" type = "text" name = "lname" placeholder = "Enter Last name" >
							<input class = "form-input" type = "text" name = "add1" placeholder = "Enter Address line 1">
							<input class = "form-input" type = "text" name = "add2" placeholder = "Enter Address line 2">
							<input class = "form-input" type = "text" name = "dist" placeholder = "Enter district name ">
							<input class = "form-input" type = "text" name = "state" placeholder = "Enter state name ">
							<input class = "form-input" type = "text" name = "pin" placeholder = "Enter PIN code ">
							Profile Picture<input type="file" name="profilepic">
					</div>
				</div>
				<div class = "col-md-6">
					<h3>Agriculture details </h3>
					<div class = "form-content">
							<input class = "form-input-2" type = "text" name = "acres" placeholder = "Number of acres" >
							<input class = "form-input-2" type = "text" name = "cul" placeholder = "Acres to cultivate" >
							<input class = "form-input" type = "text" name = "amt" placeholder = "Target amount to earn-this year ">
							<input class = "form-input" type = "text" name = "startdate" placeholder = "Target starts from">
							<input class = "form-input" type = "text" name = "enddate" placeholder = "Target ended at">
					</div>
				</div>
				<div class ="col-md-12 text-right">
					<div class="btn-group">
						<a href="ModifyProfile.php" role="button" class="btn btn-success">Edit profile</a>
						<button type="submit" name="profile" class="btn btn-primary">Add above details</button>
					</div>
				</div>
				</form>
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
