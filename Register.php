<?php
	require_once("db/db.php");
	$result="";
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
		$result='<div class="alert alert-danger">Failed ! Email already found .</div>
				<p>Would you like to <a href="index.html">try again?</a></p>';
	}
	else
	{
		$insert="INSERT INTO register (uname,email,pno,pass,occupation) VALUES ('".$uname."','".$email."',".$pno.",'".$pass."','".$occupation."')";
		$success=mysql_query($insert);
		if($success)
		{
			$result='<div class="alert alert-success">Success ! Your account created successfully .</div>
					<p>Would you like to <a href="login.html">Login?</a></p>';
		}
		else
			$result='<div class="alert alert-danger">Failed ! Your account not created successfully .</div>
					<p>Would you like to <a href="index.html">try again?</a></p>';
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>My agro - Login</title>
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
			<div class = "row">
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
					<?php echo $result; ?>
				</div>
				<div class = "col-md-3">
				</div>
			</div>
		</div>
	</section>
</body>
</html>
