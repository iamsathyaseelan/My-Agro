<?php
session_start();
require_once("db/db.php");
$sid=$_SESSION["id"];
$sql = mysql_query("SELECT * FROM register WHERE id='$sid' LIMIT 1");
$profileMatch = mysql_num_rows($sql); // count the output amount
if ($profileMatch > 0){
	while($row1=mysql_fetch_array($sql))
	{
		$email=$row1["email"];
		$pno=$row1["pno"];
		
	}
}
$sql1 = mysql_query("SELECT * FROM profile WHERE uid='$sid' LIMIT 1");
$profileMatch = mysql_num_rows($sql1); // count the output amount
if ($profileMatch > 0){
	while($row=mysql_fetch_array($sql1))
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
	$sid1=$fname1=$add11=$acres1=$cul1=$amt1=$startdate1=$enddate1="Data not found";
	$add21=$lname1=$dist1=$state1=$pin1="";
	$pic1="img/img.png";
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
			<table width="100%">
				<tr>
					<td width="100%"><img src="img/logo.png"></td>
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
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<br><br><br><br>
					</div>
						<div class="col-md-3 text-center">
							<img class="img img-thumbnail img-responsive " height="200px"src="<?php echo $pic1;?>"><br>
						</div>
						<div class="col-md-6">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3>Personal details</h3>
								</div>
								<div class="panel-body">
									<div class="table-responsive">
										<table class ="table table-stripped">
											<tr>
												<td><h4>Name</h4></td>
												<td><p><?php echo $fname1." ".$lname1;?></P></td>
											</tr>
											<tr>
												<td><h4>Address</h4></td>
												<td><p><?php echo $add11." <br>".$add21." <br>".$dist1." <br>".$state1." <br>".$pin1;?></P></td>
											</tr>
											<tr>
												<td><h4>Email</h4></td>
												<td><p><?php echo $email;?></P></td>
											</tr>
											<tr>
												<td><h4>Phone number</h4></td>
												<td><p><?php echo $pno;?></P></td>
											</tr>
										</table>
									</div>
								</div>
								<div class="panel-heading">
									<h3>Agricultural details</h3>
								</div>
								<div class="panel-body">
									<div class="table-responsive">
										<table class ="table table-stripped">
											<tr>
												<td><h4>Land I have</h4></td>
												<td><p><?php echo $acres1;?> &nbsp; acres</P></td>
											</tr>
											<tr>
												<td><h4>Total cultivate land</h4></td>
												<td><p><?php echo $cul1;?>&nbsp; acres</P></td>
											</tr>
											<tr>
												<td><h4>Target of year</h4></td>
												<td><p><?php echo 	$amt1;?>&nbsp; Rs</P></td>
											</tr>
											<tr>
												<td><h4>Target started on</h4></td>
												<td><p><?php echo $startdate1;?></P></td>
											</tr>
											<tr>
												<td><h4>Target ended in</h4></td>
												<td><p><?php echo $enddate1;?></P></td>
											</tr>
										</table>
									</div>
								</div>
								<div class="panel-footer text-right">
									<a role="button" href="ModifyProfile.php" class="btn btn-primary">Edit</a>
								</div>
							</div>
						</div>
						<div class="col-md-3 text-center">
							<div class="Suggestions">Suggestions</div>
							<?php									
								$sql_res=mysql_query("select * from bidproducts where postedby!=$sid and completed='0'");
								$count=mysql_num_rows($sql_res);
								if($count>0)
								{
									$sql_res=mysql_query("select * from bidproducts where postedby!=$sid LIMIT 3");
									while($row=mysql_fetch_array($sql_res))
									{
										$unit=$row['quantity'];
										$descr=$row['descr'];
										$img=$row['img'];
										$id=$row['id'];
										$userid=$row['postedby'];
										$price=$row['price'];
										$verified=$row['verified'];
										if($verified=='no')
										{
											$disable="disabled";
										}
										else
											$disable="";
										echo '
											<div class="col-md-12" style="margin-top:10px;border-bottom:2px solid black;">
												<div class="text-center">
													<img src="bid/'. $img .'" alt="'. $descr .'" class="img img-responsive"  title="'. $descr .'" />
													<h4>Rs. '.$price.' &#x20b9; / '.$unit.'</h4>
													<p>'.$descr.'</p>
													<a class="btn btn-success '.$disable.'" role="button" href="bid/viewandbid.php?proid='.$id.'"><i class="fa fa-shopping-cart"></i> Bid</a>
												</div><br>
											</div>
										';
									}
								}
								else
									echo"No products found!";
							?>
						</div>
					<div class="col-md-12">
						<br><br><br><br>
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

