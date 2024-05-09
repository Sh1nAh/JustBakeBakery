<?php
session_start();
include('connect.php');
include('shoppingcartfunction.php');
include('AutoID.php');
include('header.php');

if(isset($_POST['btnCout']))
{
	$oid=AutoID('Orders', 'OrderID', 'O_', 6);

	$odate=date('Y-m-d');
	$did=AutoID('Delivery', 'DeliveryID', 'D_', 6);
	$cusID=AutoID('Customer', 'CustomerID', 'C_', 6);
	$tamt=getTotalAmount();

	$daddress="No. ".$_POST['txtNo'].", ".$_POST['txtStreet']."St, ".$_POST['cboTsp'].", Yangon, Myanmar";

	$name=$_POST['txtCpn'];
	//$phone=$_POST['txtCp'];

	$ptype=$_POST['rdocd'];
	$card=$_POST['txtCardNo'];

	$ins="INSERT INTO Orders (OrderID, DeliveryID, OrderDate, CustomerID, TotalAmount, ContactPerson, DeliveryAddress,PaymentType, CardNo, Status)
	VALUES ('$oid','$did', '$odate', '$cusID', '$tamt', '$name','$daddress','$ptype', '$card', 'Pending')";
	//'$name', 
	//	'$phone',

	$ret=mysql_query($ins);
	if($ret)
	{
		$size=count($_SESSION['ShoppingCart']);
		for($i=0;$i<$size;$i++)
		{
			$pid=$_SESSION['ShoppingCart'][$i]['ProductID'];
			$price=$_SESSION['ShoppingCart'][$i]['Price'];
			$qty=$_SESSION['ShoppingCart'][$i]['Qty'];
			$amt=$_SESSION['ShoppingCart'][$i]['Amount'];
			$query="INSERT INTO OrderDetail (OrderID, ProductID, Quantity, Amount)
			VALUES ('$oid','$pid','$qty','$amt')";
			mysql_query($query);
		}

		echo "<script>
					alert('Successfully Ordered');
					location.assign('productdisplay.php');
			</script>";
	}
}
?>
<html>
<head>
		<style type="text/css">
		.shipping td
		{
			color: #989282;
			display: block;
			line-height: 36px;
			margin: 0;
			padding: 0;
			text-transform: capitalize;
			font-family: Arial, Helvetica, sans-serif;
			font-size: 14px;
		}
		select
		{
			font-size: 14px;
			font-family: Arial, Helvetica, sans-serif;
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
		.shipping input
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
		.pay input
		{
			font-size: 16px;
			font-family: 'DeliusSwashCaps-Regular';
			font-weight: normal;
			padding: 0 5px;
			width: 100px;
			border: 1px solid #bfc2c7;
			color: #999;
			display: block;
			height: 35px;
			line-height: 35px;
			margin: 0;
			padding: 0;
		}
		legend
		{
			color: #fcc5c9;
			display: inline-block;
			font-family: 'DeliusSwashCaps-Regular';
			font-size: 20px;
		}
		th
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
<h1 align="center">Check Out</h1>
<form actiion="checkout.php" method="post">
	<h1>Shipping Info</h1>
		<table class="shipping">
			<tr>
				<td>No:</td>
				<td>
					<input type="text" name="txtNo">
				</td>
			</tr>
			<tr>
				<td>Street:</td>
				<td>
					<input type="text" name="txtStreet">
				</td>
			</tr>
			<tr>
				<td>Township:</td>
				<td>
					<select name="cboTsp">
						<option>SELECT Township</option>
						<option value="Sangyoung">Sangyoung</option>
						<option value="Tarmwe">Tarmwe</option>
						<option value="Tarmwe">Insein</option>
						<option value="Tarmwe">Dagon</option>
						<option value="Tarmwe">North Okkala</option>
						<option value="Tarmwe">South Okkala</option>
						<option value="Tarmwe">North Dagon</option>
						<option value="Tarmwe">South Dagon</option>
						<option value="Tarmwe">Hli</option>
				</td>
			</tr>
			<tr>
				<td>Contact Person Name:</td>
				<td>
					<input type="text" name="txtCpn">
				</td>
			</tr>
		</table>
		<br></br>
	<fieldset>
		<legend>Payment Info</legend>
		<table class="pay" width="500">
			<tr>
				<td>Ordered Amount: <?php echo getTotalAmount();?></td>
			</tr>
			<tr>
				<td>Payment Type</td>
				<td>
					<input type="radio" name="rdocd" value="Card"/>Card
				</td>
				<td>
					<input type="radio" name="rdocd" value="Cash" checked/>Cash on Delivery
				</td>
			</tr>
			</table>
			<table>
				<td>Card No: </td>
				<td><input type="text" name="txtCardNo" placeholder="Type AccountNo. here"/></td>
			</table>
	</fieldset>
	<br></br>
	<fieldset>
		<legend>Order Items</legend>
		<table width="500">
			<tr>
				<th>Item Name</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Amount</th>
			</tr>
			<?php
			$size=count($_SESSION['ShoppingCart']);
			for($i=0;$i<$size;$i++)
			{
				echo "<tr>";
				echo "<td>".$_SESSION['ShoppingCart'][$i]['ProductName']."</td>";
				echo "<td>".$_SESSION['ShoppingCart'][$i]['Price']."</td>";
				echo "<td>".$_SESSION['ShoppingCart'][$i]['Qty']."</td>";
				echo "<td>".$_SESSION['ShoppingCart'][$i]['Amount']."</td>";
				echo "<td><a href='shoppingcart.php?action=remove&ProductID=".$_SESSION['ShoppingCart'][$i]['ProductID']."'>Remove</a></td>";
				echo "</tr>";
			}
			?>
		</table>
	</fieldset>
	<table class="shipping" align="center">
		<tr>
			<td><tr></tr></td>
			<td>
				<input type="submit" name="btnCout" id="rec" value="Check out Now">
			</td>
		</tr>
	</table>
</form>
</div>
</div>
<?php
include('footer.php');
?>