<?php 
session_start();
if($_SESSION['email']==""|| $_SESSION['pass']=="") {
    header("location: admin_login.php"); 
    exit();
}
include "../db/db.php";
?>
<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php 
if (isset($_POST['product_name'])) {
	
	$pid = mysql_real_escape_string($_POST['thisID']);
    $product_name = mysql_real_escape_string($_POST['product_name']);
	$price = mysql_real_escape_string($_POST['price']);
	$category = mysql_real_escape_string($_POST['category']);
	$subcategory = mysql_real_escape_string($_POST['subcategory']);
	$details = mysql_real_escape_string($_POST['details']);
	$sql = mysql_query("UPDATE products SET name='$product_name', price='$price', desc='$details', type='$category', subtype='$subcategory' WHERE id='$pid'");
	if ($_FILES['fileField']['tmp_name'] != "") {
	    // Place image in the folder 
	    $newname = "$pid.jpg";
	    move_uploaded_file($_FILES['fileField']['tmp_name'], "../inventory_images/$newname");
	}
	header("location: Addproducts.php"); 
    exit();
}
?>
<?php 
// Gather this product's full information for inserting automatically into the edit form below on page
if (isset($_GET['pid'])) {
	$targetID = $_GET['pid'];
    $sql = mysql_query("SELECT * FROM products WHERE id='$targetID' LIMIT 1");
    $productCount = mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
	    while($row = mysql_fetch_array($sql))
		{ 
			 $product_name = $row["name"];
			 $price = $row["price"];
			 $category = $row["type"];
			 $subcategory = $row["subtype"];
			 $details = $row["desc"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["dateadded"]));
        }
    } else {
	    echo "Sorry dude that crap dont exist.";
		exit();
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Karrikkadai website</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style/style.css" />
    <link href="../style/font-awesome.min.css" rel="stylesheet">
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
    </div>
    <h3 class="text-center">
    &darr; Add New Inventory Item Form &darr;
    </h3>
    <form action="inventory_edit.php" enctype="multipart/form-data" name="myForm" id="myform" method="post">
    <table width="100%" border="0" cellspacing="0" cellpadding="6">
      <tr>
        <td width="20%" align="left">Product Name</td>
        <td width="80%"><label>
          <input name="product_name" type="text" id="product_name" size="64" value="<?php echo $product_name; ?>" />
        </label></td>
      </tr>
      <tr>
        <td align="left">Product Price</td>
        <td><label>
          $
          <input name="price" type="text" id="price" size="12" value="<?php echo $price; ?>" />
        </label></td>
      </tr>
      <tr>
        <td align="left">Category</td>
        <td><label>
          <select name="category" id="category">
          <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
			<option value="chicken">Chicken</option>
			<option value="mutton">Mutton</option>
			<option value="fish">Fish</option>
          </select>
        </label></td>
      </tr>
      <tr>
        <td align="left">Subcategory</td>
        <td><select name="subcategory" id="subcategory">
          <option value="<?php echo $subcategory; ?>"><?php echo $subcategory; ?></option>
			<option value="country chicken">Natu Kozhi</option>
			<option value="brawler">brawler</option>
			<option value="head meat">headmeat</option>
          </select></td>
      </tr>
      <tr>
        <td align="left">Product Details</td>
        <td><label>
          <textarea name="details" id="details" cols="64" rows="5"><?php echo $details; ?></textarea>
        </label></td>
      </tr>
      <tr>
        <td align="left">Product Image</td>
        <td><label>
          <input type="file" name="fileField" id="fileField" />
        </label></td>
      </tr>      
      <tr>
        <td>&nbsp;</td>
        <td><label>
          <input name="thisID" type="hidden" value="<?php echo $targetID; ?>" />
          <input type="submit" name="button" id="button" value="Make Changes" />
        </label></td>
      </tr>
    </table>
    </form>
    <br />
  <br />
  </div>
</div>
</body>
</html>