<?php
	require_once("db/db.php");
	session_start();
	$result="";
	$email=$_POST["email"];
	$pass=$_POST["pass"];
	$sql="SELECT * FROM `register` where email='".$email."' and pass='".$pass."'";
	$select=mysql_query($sql);
	$count=mysql_num_rows($select);
	if($count>0)
	{
		$_SESSION['email'] = $email;
		$_SESSION['pass'] = $pass;
		$result='<div class="alert alert-success">Success ! Please wait....</div>';
		while ($row=mysql_fetch_array($select))
		{
			$occupation=$row['occupation'];
			$_SESSION['id']=$row['id'];
			if($occupation=="Industrialists")
			{
				header('Location: IndustrialistsProfile.html');
			}
			if($occupation=="Farmer")
			{
				header('Location: FarmersProfile.html');
			}
			if($occupation=="Dealer")
			{
				header('Location: DealersProfile.html');
			}
		}
	}
	else
	{
		$result='<div class="alert alert-danger">Failed ! Wrong email or password.</div>
				<p>Would you like to <a href="login.html">Login?</a></p>';
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
