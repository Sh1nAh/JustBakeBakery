<?php
session_start();
	include('connect.php');
	include('shoppingcartfunction.php');
	include('header.php');

if(isset($_REQUEST['ProductID']))
{
	$pid=$_REQUEST['ProductID'];
	$sql="SELECT * FROM product WHERE ProductID='$pid'";
	$ret=mysql_query($sql);
	$row=mysql_fetch_array($ret);
}
if (isset($_POST['btnAdd']))
{
	$qty=$_POST['txtqty'];
	$pid=$_POST['txtproductid'];
	Add($pid,$qty);
}
?>
 <html>
 <head>
 	<style type="text/css">
		table
		{
			color: #989282;
			line-height: 36px;
			font-family: Arial, Helvetica, sans-serif;
			font-size: 15px;
		}
		td
		{
			color: #fcc5c9;
			line-height: 36px;
			text-transform: capitalize;
			font-family: 'DeliusSwashCaps-Regular';
			font-size: 18px;
		}
		input
		{
			font-size: 16px;
			font-family: 'DeliusSwashCaps-Regular';
			font-weight: normal;
			padding: 0 5px;
			width: 329px;
			border: 1px solid #bfc2c7;
			color: #999;
			display: block;
			height: 35px;
			line-height: 35px;
			margin: 0;
			padding: 0;
		}
	</style>
 </head>
 <body>
<div id="body">
<div id="contact">
<h1 align="center">Detail for Product</h1>
<form action="detail.php" method="post"/>
	<input type="hidden" name="txtproductid" value="<?php echo $pid?>"/><div class="information">
 	<table align="center">
 		<tr>
 			<td> <img src="<?php echo $row['Image']?>" width="300px" height="300px"></td>
 			<td>
 				<p style='color: #989282;'> Product Name: <?php echo $row['ProductName'] ?> </p>	
 				<p style='color: #989282;'> Ingredient: <?php echo $row['Ingredients'] ?> </p>
 				<p style='color: #989282;'> Flavour: <?php echo $row['Flavour'] ?> </p>
        		<p style='color: #989282;'> Price: <?php echo $row['Price'] ?> Kyats</p> 
 				<p style='color: #989282;'> Quantity: <?php echo $row['Quantity'] ?> </p>
 			</td>
 		</tr>
 		<tr>
 			<td align="center" style='color: #fcc5c9;'>Quantity to Buy: </td>
 			<td><input type="number" name="txtqty" min="1" max="30"></td>
 			<td></td>
 			<td><input type="submit" name="btnAdd" id="add" value="Add to Cart"/></td>
 		</tr>
 	</table>
 </div>
</div>
</div>
<?php 
include('footer.php');
 ?>