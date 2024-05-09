<?php 
session_start();
include('connect.php');
include('AutoID.php');
include('header.php');

if(isset($_REQUEST['btnSchedule']))
{
	$ddate=date('Y-m-d');
	$team=$_POST['cbodteam'];

	$did=AutoID('Delivery','DeliveryID','D_',6);

	$dtotal=0;
	foreach ($_POST['chkOrders'] as $oid) 
	{
		$selret=mysql_query("SELECT TotalAmount FROM orders WHERE OrderID='$oid'");
		$data=mysql_fetch_array($selret);
		$gtamt=$data['TotalAmount'];
		$dtotal+=$gtamt;

		mysql_query("UPDATE orders SET Status='DeliAdded', DeliveryID='$did' WHERE OrderID='$oid'");
	}
	$dcharges=$dtotal*0.05;
	$recdeli=mysql_query("INSERT INTO delivery (DeliveryID, DeliveryDate, DeliveryStatus, DeliveryTeam, TotalAmount, Charges)
		VALUES ('$did','$ddate','Pending','$team','$dtotal','$dcharges')");
	if($recdeli)
	{
		echo "<script>
			alert('The selected orders have been submitted to delivery');
			location.assign('scheduledelivery.php');
			</script>";
	}
}

$sql="SELECT * FROM orders
		WHERE Status='Confirmed'";
$ret=mysql_query($sql);
$rcount=mysql_num_rows($ret);
?>

<html>
<head>
	<style>
		table
		{
			color: #989282;
			display: inline-block;
			font-family: Arial, Helvetica, sans-serif;
			font-size: 18px;
		}
		th
		{
		    color: #fcc5c9;
		    font-size: 20px;
		    font-family: 'DeliusSwashCaps-Regular';
		    font-weight: normal;
		    line-height: 30px;
		    margin: 0;
		    padding: 0;
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
		.btn input
		{
			font-size: 16px;
			font-family: 'DeliusSwashCaps-Regular';
		}
	</style>
</head>
<body>
<div id="body">
<div id="contact">
	<h1>Delivery Schedule</h1>
	<form action="scheduledelivery.php" method="post">
		<table cellpadding="18"  width="800">
			<tr>
				<th></th>
				<th>Ordered Items</th>
				<th>Total Amount</th>
				<th></th>
				<th>Delivery Address</th>
			</tr>
			<?php
			for($i=0;$i<$rcount;$i++)
			{
				$data=mysql_fetch_array($ret);
				echo "<tr>";

				$stmt="SELECT * FROM orderdetail od, product p
						WHERE od.ProductID=p.ProductID
						AND OrderID='".$data['OrderID']."'";
				$run=mysql_query($stmt);
				$count=mysql_num_rows($run);
				echo "<td>";
				echo "<input type='checkbox' name='chkOrders[]' value='".$data['OrderID']."'/>";
				echo "</td>";
				echo "<td>";
				for($r=0;$r<$count;$r++)
				{
					$gethata=mysql_fetch_array($run);
					echo $gethata['ProductName']."-".$gethata['Quantity']."pcs";

					echo "<br/>";
				}

				echo "</td>";
				echo "<td>".$data['TotalAmount']."</td>";
				echo "<td>"."</td>";
				echo "<td>".$data['DeliveryAddress']."</td>";
				echo "</tr>";
			}
			?>
		</table>
		<br></br><br></br>
		<table cellpadding="10">
			<tr>
				<td>Select Delivery Team :</td>
				<td>
					<select name='cbodteam'>
						<option>Select Delivery Team</option>
						<option value="ABC Delivery">ABC Delivery</option>
						<option value="DEF Team">DEF Team</option>
						<option value="GHI Deli">GHI Deli</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Additional Remark :</td>
				<td>
					<textarea name="txaRemark" id="address"></textarea>
				</td>
			</tr>
			<tr class="btn">
				<td></td>
				<td>
					<input type="submit" name="btnSchedule" id="rec" value="Add to Delivery"/>
				</td>
			</tr>
		</table>
</div>
</div>
<?php
include('footer.php');
?>