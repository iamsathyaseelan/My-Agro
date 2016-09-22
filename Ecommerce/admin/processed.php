<?php
session_start();
if($_SESSION['email']==""|| $_SESSION['pass']=="") {
    header("location: admin_login.php"); 
    exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Karrikkadai website</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body>
    	<header>
            <div class="header-bottom">
            	<div class="navbar navbar-inverse">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="#"><img src="../img/logo.png" alt="Karikkadai" class="logo" /></a>
                        </div>
                        <ul class="nav navbar-nav navbar-right">
                        	<li><a href="owner.php"><i class="fa fa-shopping-cart"></i> New Orders</a></li>
                        	<li  class="active"><a href="processed.php"><i class="fa fa-minus"></i> Processed Orders</a></li>
                        	<li><a href="Addproducts.php"><i class="fa fa-plus"></i> Add Products</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <section>
        	<div class="container">
            	<div class="row">
					<table style="width:100%; text-align:center;" border="2" >
						<tr>
							<td><b>ID</b></td>
							<td><b>Name</b></td>
							<td><b>Address</b></td>
							<td><b>Email</b></td>
							<td><b>Phone Number</b></td>
						</tr>
<?php
	include('../../db/db.php');
	$sql = mysql_query("SELECT * FROM orders where process='delivered'");
	while ($row = mysql_fetch_array($sql))
	{
		$name = $row["name"];
		$addr = $row["addr"];
		$email = $row["email"];
		$tel = $row["tel"];
		$id = $row["id"];
	echo "
		<tr>
			<td>".$id."</td>
			<td>".$name."</td>
			<td>".$addr."</td>
			<td>".$email."</td>
			<td>".$tel."</td>
		</tr>";
	}
?>
					</table>
                </div>
            </div>
        </section>
    </body>
</html>