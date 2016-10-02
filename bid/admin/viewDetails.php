<?php
include('../../db/db.php');
session_start();
if($_SESSION['email']==""|| $_SESSION['pass']=="") {
    header("location: ../../login.html"); 
    exit();
}
if(isset($_POST['winner']))
{
	$winnerid=$_POST['winid'];
	$bidderid=$_POST['bidid'];
	$bidid=$_GET['proid'];
	$setwinner=mysql_query("UPDATE `bid` SET `posistion` = 'Winner' WHERE `id` = $winnerid");
	$setCompleted=mysql_query("UPDATE `bidproducts` SET `completed`= 1,`winnerId`=$bidderid WHERE `id` = $bidid");
	if($setwinner && $setCompleted)
	echo'<script>
		alert("hi");
	</script>';
	else
	echo'<script>
		alert("failed");
	</script>';
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
		<script>
			$(document).ready(function(){
				load('CheckLogin.php');
			});
		</script>
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
						<a href="admin/index.php"><i class="glyphicon glyphicon-tags"></i>&nbsp;Sell products</a>
						<a href="../index.php"><i class="glyphicon glyphicon-arrow-left"></i>&nbsp;Back</a>
						<br><br>
					</div>
					<div class="col-md-9">
						<?php
							$bidid=$_GET['proid'];
							$sql_res=mysql_query("select * from bidproducts where id=$bidid");
							while($row=mysql_fetch_array($sql_res))
							{
								$unit=$row['quantity'];
								$descr=$row['descr'];
								$img=$row['img'];
								$name=$row['name'];
								$userid=$row['postedby'];
								$price=$row['price'];
								$verified=$row['verified'];
								$completed=$row['completed'];
								$winnerId=$row['winnerId'];
								echo '
									<div class="col-md-12">
										<div class="col-md-4">
											<img src="../'. $img .'" alt="'. $descr .'" class="img img-responsive"  title="'. $descr .'" />
										</div>
										<div class="col-md-8">
											<b>Name:</b>'.$name.'<br><b>Description:</b>'.$descr.'<br><b>Is Verified :</b>'.$verified.'<br><b>Price :</b>'.$price.'<br>;
										</div>
									</div>
								';
							}
							$sid=$_SESSION["id"];
							echo"<div class='col-md-12'><br><br></div>";
							if($completed!=1)
							{
								echo '<table class="table">';
								echo"<div class='col-md-12'><br><br></div>";
								$select="SELECT * FROM `bid` WHERE proid='$bidid' ORDER BY id DESC ";
								$do=mysql_query($select);
								$count=mysql_num_rows($do);
								echo '<h3>'.$count.' - People bid for this product.</h3>';
								while($row=mysql_fetch_assoc($do))
								{
									$bidder=$row["bidderid"];
									$price=$row["price"];
									$id=$row["id"];
									$selectImg="SELECT * FROM `register` where id='".$bidder."'";
									$doid=mysql_query($selectImg);
									while($rowid=mysql_fetch_assoc($doid))
									{
										$uname=$rowid["uname"];
										echo '<tr>
												<td><span style="font-size:12px; width:100px;font-weight:bold;color:green;">'.$uname.'</span></td>
												<td><span style="font-size:12px;">'.$price.' Rs</span></td>
												<td>
													<form action="" method="post">
														<input type="hidden" value="'.$id.'" name="winid">
														<input type="hidden" value="'.$bidder.'" name="bidid">
														<input type="submit" name="winner" value="Select as winner" class="btn btn-success">
													</form>		
												</td>
											 </tr>';
									}
								}
							}
							else
							{
									$selectImg="SELECT * FROM `register` where id='".$winnerId."'";
									$doid=mysql_query($selectImg);
									while($rowid=mysql_fetch_assoc($doid))
									{
										$uname=$rowid["uname"];
										echo '<div class="col-md-12 alert alert-success"><span style="font-size:24px;font-weight:bolder;">Winner is : </span>'.$uname.'</div>';
									}
							}
							?>
							</table>
						</div>
						<div class='col-md-12'><br><br></div>
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

