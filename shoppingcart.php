<?php
session_start();
include('connect.php');
include('shoppingcartfunction.php');
include('header.php');

if (isset($_REQUEST ['action']))
{
	$action=$_REQUEST['action'];
	$ProductID=$_REQUEST['ProductID'];
	if($action='remove')
	{
		remove($ProductID);
	}
	else if($action==="clear")
	{
		Clear();
	}
}
?>
<html>
<head>
	<style type="text/css">
		table
		{
			color: #989282;
			display: inline-block;
			font-family: Arial, Helvetica, sans-serif;
			font-size: 17px;
		}
		th
		{
			color: #fcc5c9;
			font-family: 'DeliusSwashCaps-Regular';
			font-size: 15px;
		}
		h3
		{
			color: #fcc5c9;
			font-family: 'DeliusSwashCaps-Regular';
			font-size: 15px;
		}
	</style>
</head>
<body>
<div id="body">
<div id="contact">
<h1>Shopping Cart</h1>
<br></br>
	<table class="information" cellpadding="13">
		<tr>
			<th>Image</th>
			<th>Ordered product</th>
			<th>Price</th>
			<th>Quantity</th>
			<th>Amount</th>
		</tr>
	<?php
		$size=count($_SESSION['ShoppingCart']);  
		for($i=0;$i<$size;$i++)
		{
			echo "<tr>";
			echo "<td><img src='".$_SESSION['ShoppingCart'][$i]['Image']."'width='150px' height='110px'</td>";
			echo "<td>".$_SESSION['ShoppingCart'][$i]['ProductName']."</td>";
			echo "<td>".$_SESSION['ShoppingCart'][$i]['Price']."</td>";
			echo "<td>".$_SESSION['ShoppingCart'][$i]['Qty']."</td>";
			echo "<td>".$_SESSION['ShoppingCart'][$i]['Amount']."</td>";
			echo "<td><a href='shoppingcart.php?action=remove&ProductID=".$_SESSION['ShoppingCart'][$i]['ProductID']."'>Remove</a></td>";
			echo "</tr>";
		} 
	?>
	</table>
<h3><p>Total Amount: <?php echo getTotalAmount();?></p></h3>
<a href="checkout.php">Check Out Now</a>
</div>
</div>
<?php
include('footer.php');
?>