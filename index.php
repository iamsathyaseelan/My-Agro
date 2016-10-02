<?php
if(isset($_POST['register']))
{
	require_once("db/db.php");
	$uname=$_POST["uname"];
	$email=$_POST["email"];
	$pno=$_POST["pno"];
	$pass=$_POST["pass"];
	$occupation=$_POST["occupation"];
	$sql="SELECT * FROM `register` where email='".$email."'";
	$select=mysql_query($sql);
	$count=mysql_num_rows($select);
	if($count>0)
	{
		echo '<script>alert("Failed ! Email already found.");</script>';
	}
	else 
	{
		$insert="INSERT INTO register (uname,email,pno,pass,occupation) VALUES ('".$uname."','".$email."',".$pno.",'".$pass."','".$occupation."')";
		$success=mysql_query($insert);
		$uid = mysql_insert_id();
		$success1=mysql_query("INSERT INTO profile(uid) VALUES ('$uid')");
		if($success && $success1)
		{
			echo '<script>alert("Success ! Your account created successfully ");</script>';
		}
		else
			echo'<script>alert("Failed ! Your account not created successfully" );</script>';
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
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
</head><!--/head-->
<body>
	<section class = "header">
		<div class = "container">
			<div class = "row">				..
				<div class = "col-md-12 logo">
					<center><img src="img/logo.png"></center>
				</div>
			</div>
		</div>
	</section>
	<section>
		<div class = "container">
			<div class = "row">
				<div class = "col-md-12">
					<br><br>
				</div>
				<div class = "col-md-3">
				</div>
				<div class = "col-md-6">
					<div class = "form-header"><span>Register</span></div>
					<div class = "form-content">
					<form name="register" action="" method="post">
						<input class = "form-input" type = "text" name = "uname" required="required" placeholder = "Enter username" >
						<input class = "form-input" type = "email" name = "email" required="required" placeholder = "Enter Email" >
						<input class = "form-input" type = "password" name = "pass" placeholder = "Enter password" required="required">
						<input class = "form-input" type = "tel" name = "pno" required="required" placeholder = "Enter Phone number" >
						<select class = "form-input" name = "occupation" >
							<option >Farmer</option>
							<option>Dealer</option>
							<option>Industrialists</option>
						</select>
						<table>
							<tr>
								<td style = "color:white;width:100%;text-align:center;"><a href = "login.html">Already Have an account?</a></td>
							</tr>
						</table>
					</div>
					<div class = "form-footer"><button type="submit" name="register"><span style = "opacity:1;color:black">Create Account</span></button></div>
					</form>
				</div>
				<div class = "col-md-3">
				</div>
			</div>
		</div>
		<br><br><br>
	</section>
	<footer>
		All rights are reserved by team My-Agro &copy;
	</footer>
</body>
</html>
