<?php 
	session_start();
if($_POST)
{
    $pid = $_POST['pid'];
	$wasFound = false;
	$i = 0;
	if (!isset($_SESSION["NoOfItemsInCart"]))
	{
		$_SESSION['NoOfItemsInCart']=0;
	}
	// If the cart session variable is not set or cart array is empty
	if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) { 
	    // RUN IF THE CART IS EMPTY OR NOT SET
		$_SESSION["cart_array"] = array(0 => array("item_id" => $pid, "quantity" => 1));
	} 
	else 
	{
		// RUN IF THE CART HAS AT LEAST ONE ITEM IN IT
		foreach ($_SESSION["cart_array"] as $each_item)
		{ 
		      $i++;
		      while (list($key, $value) = each($each_item))
			  {
				  if ($key == "item_id" && $value == $pid)
				  {
					  array_splice($_SESSION["cart_array"], $i-1, 1, array(array("item_id" => $pid, "quantity" => $each_item['quantity'] + 1)));
					  $wasFound = true;
				  }
		      }
	       }
		   if ($wasFound == false) {
			   array_push($_SESSION["cart_array"], array("item_id" => $pid, "quantity" => 1));
		   }
	}
	echo "".count($_SESSION['cart_array'])."";
	$_SESSION['NoOfItemsInCart']=count($_SESSION['cart_array']);
}
?>