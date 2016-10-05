<?php
session_start();
if($_SESSION['email']==""|| $_SESSION['pass']=="") {
    header("location: ../login.html"); 
    exit();
}
$result="";
$sid=$_SESSION["id"];
require_once("db/db.php");
if(isset($_POST['search']))
{
	$keyword=$_POST['key'];
	$from=$_POST['from'];
	if($from=="profile")
	{
		$sql_res=mysql_query("select * from profile where  fname like '%$keyword%' or lname like '%$keyword%' and uid!='$sid'");
		$count=mysql_num_rows($sql_res);
		if($count>0)
		{
			$result= '<h3>'.$count.'-results found for "'.$keyword.'"</h3>';
			while($row=mysql_fetch_array($sql_res))
			{
				$uid=$row['uid'];
				$fname=$row['fname'];
				$lname=$row['lname'];
				$img=$row['profilepic'];
				$b_name='<strong>'.$keyword.'</strong>';
				$b_dept='<strong>'.$keyword.'</strong>';
				$final_fname = str_ireplace($keyword, $b_name, $fname);
				$final_lname = str_ireplace($keyword, $b_dept, $lname);
				$result .='
					<div class="col-md-3 text-center">
						<img class="img img-responsive" src="'.$img.'">
						<a href="ViewProfile.php?uid='.$uid.'">'.$final_fname.'&nbsp;'.$final_lname.'</a>
					</div>
				';
			}
		}
		else 
		{
			$result= "No result found!";
		}
	}
	else if($from=="products")
	{
		$sql_res=mysql_query("select * from products where  name like '%$keyword%' or descr like '%$keyword%'");
		$count=mysql_num_rows($sql_res);
		if($count>0)
		{
			$result= '<h3>'.$count.'-results found for '.$keyword.'</h3>';
			while($row=mysql_fetch_array($sql_res))
			{
				$pid=$row['id'];
				$name=$row['name'];
				$descr=$row['descr'];
				$img=$row['img'];
				$b_name='<strong>'.$keyword.'</strong>';
				$b_descr='<strong>'.$keyword.'</strong>';
				$final_name = str_ireplace($keyword, $b_name, $name);
				$final_descr = str_ireplace($keyword, $b_descr, $descr);
				$result.='
					<div class="col-md-3 text-center">
						<img class="img img-responsive" src="Ecommerce/'.$img.'">
						<a href="Ecommerce/ViewProduct.php?pid='.$pid.'">'.$final_name.'</a>
						<p>'.$final_descr.'</p>
					</div>
				';
			}
		}
		else 
		{
			$result= "No result found!";
		}
	}
	else
	{
		$sql_res=mysql_query("select * from bidproducts where name like '%$keyword%' or descr like '%$keyword%'");
		$count=mysql_num_rows($sql_res);
		if($count>0)
		{
			$result= '<h3>'.$count.'-results found for '.$keyword.'</h3>';
			while($row=mysql_fetch_array($sql_res))
			{
				$pid=$row['id'];
				$name=$row['name'];
				$descr=$row['descr'];
				$img=$row['img'];
				$b_name='<strong>'.$keyword.'</strong>';
				$b_descr='<strong>'.$keyword.'</strong>';
				$final_name = str_ireplace($keyword, $b_name, $name);
				$final_descr = str_ireplace($keyword, $b_descr, $descr);
				$result.='
					<div class="col-md-3 text-center">
						<img class="img img-responsive" src="bid/'.$img.'">
						<a href="bid/viewandbid.php?proid='.$pid.'">'.$final_name.'</a>
						<p>'.$final_descr.'</p>
					</div>
				';
			}
		}
		else 
		{
			$result= "No result found!";
		}
	}

}
?>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Farmers Profile</title>
    <script src="http://s.codepen.io/assets/libs/modernizr.js" type="text/javascript"></script>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="js/prefixfree.min.js"></script>
	<link rel="stylesheet" href="css/ProfileStyle.css">
  </head>

  <body>
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
			<a href="FarmersProfile.php"><i class="glyphicon glyphicon-home"></i>&nbsp;Home</a>
			<a href="Profile.php"><i class="glyphicon glyphicon-user"></i>&nbsp;Profile</a>
			<a href="bid/index.php"><i class="glyphicon glyphicon-king"></i>&nbsp;Bid</a>
			<a href="Search.php" class="active"><i class="glyphicon glyphicon-search"></i>&nbsp;Search</a>
			<a href="PublicChat.php"><i class="glyphicon glyphicon-envelope"></i>&nbsp;Chat</a>
			<a href="weather/index.html"><i class="glyphicon glyphicon-info-sign"></i>&nbsp;Climate</a>
			<a href="tips_add_tricks/index.html"><i class="glyphicon glyphicon-edit"></i>&nbsp;Tips and tricks</a>
			<a href="Finance/index.php"><i class="glyphicon glyphicon-usd"></i>&nbsp;Finance</a>
			<a href="Ecommerce/index.php"><i class="glyphicon glyphicon-shopping-cart"></i>&nbsp;E-commerce</a>
			<a href="Logout.php"><i class="glyphicon glyphicon-off"></i>&nbsp;Logout</a>
		</div>
		<section>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<br><br><br><br>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6 text-center">
						<form action="" method="post">
							<input type="text" class="form-input-2" name="key" required="required" placeholder="Enter search term" >
							<select class="form-input-2" name="from">
								<option value="profile">People</option>
								<option value="products">Products</option>
								<option value="bidproducts">bid Products</option>
							</select>
							<input type="submit" value="Search" name="search" class="btn btn-md btn-success">
						</form>
					</div>
					<div class="col-md-3"></div>
					<div class="col-md-12">
						<?php echo $result; ?>
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
