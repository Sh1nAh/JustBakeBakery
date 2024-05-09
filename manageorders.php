<?php
session_start();
include('connect.php');
include('header.php');

if(isset($_REQUEST['action']))
{
	$action=$_REQUEST['action'];
	$oid=$_REQUEST['oid'];

	if($action=='confirm')
	{
		$sql="UPDATE Orders
			SET Status='Confirmed'
			WHERE OrderID='$oid'";
		$ret=mysql_query($sql);
	}
	elseif($action=='cancel')
	{
		$sql="UPDATE Orders
			SET Status='Cancelled'
			WHERE OrderID='$oid'";
		$ret=mysql_query($sql);
	}
}

$sql="SELECT * FROM Orders
		WHERE Status='Pending'";
$ret=mysql_query($sql);
$rcount=mysql_num_rows($ret);

?>
<div id="body">
<div id="contact">
<h1 align="center">Order Management</h1>
	<form action="manageorders.php" method="post">
		<table cellpadding=10>
			<tr>
				<th>OrderID</th>
				<th>Order Date</th>
				<th>Ordered Items</th>
				<th>Total Amount</th>
				<th>Delivery Address</th>
				<th>Contact Person</th>
				<th>Actions</th>
			</tr>
			<?php
			for($i=0;$i<$rcount;$i++)
			{
				$data=mysql_fetch_array($ret);
				echo "<tr>";
				echo "<td>".$data['OrderID']."</td>";
				echo "<td>".$data['OrderDate']."</td>";
				
				$stmt="SELECT * FROM orderdetail od, product p
						WHERE od.ProductID=p.ProductID
						AND od.OrderID='".$data['OrderID']."'";
				$run=mysql_query($stmt);
				$pcount=mysql_num_rows($run);
				echo "<td>";
				for($r=0;$r<$pcount;$r++)
				{
					$getdata=mysql_fetch_array($run);
					echo $getdata['ProductName']."-".$getdata['Quantity']."pcs";

					echo "<br/>";
				}
				echo "</td>";

				echo "<td>".$data['TotalAmount']."</td>";
				echo "<td>".$data['DeliveryAddress']."</td>";
				echo "<td>".$data['ContactPerson']."</td>";
				echo "<td><a href='manageorders.php?action=confirm&oid=".$data['OrderID']."'>Confirm</a></td>";
				echo "<td><a href='manageorders.php?action=cancel&oid=".$data['OrderID']."'>Cancel</a></td>";
				echo "</tr>";
			}
			?>
		</table>
	</form>
</div>
</div>
<?php 
include('footer.php');
?>