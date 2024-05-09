<?php 
session_start();
include('connect.php');
include('AutoID.php');
include('header.php');

if(isset($_REQUEST['Did']))
{
	$did=$_REQUEST['Did'];
	mysql_query("UPDATE Delivery SET DeliveryStatus='Complete' WHERE DeliveryID='$did'");
	echo "<script>
			alert('Payment Status and Customer Receival Completed');
			location.assign('MyDeliveries.php');
		</script>";
}

$sql="SELECT * FROM Delivery
		WHERE DeliveryStatus='Pending'";
$ret=mysql_query($sql);
$rcount=mysql_num_rows($ret);
 ?>

<html>
<head>
	<style>
		td
		{
			color: #989282;
			line-height: 36px;
			margin: 0;
			padding: 0;
			text-transform: capitalize;
			font-family: Arial, Helvetica, sans-serif;
			font-size: 14px;
		}
	</style>
</head>
<body>
<div id="body">
<div id="contact">
	<h1>Deliveries</h1>
 	<form action ="mydeliveries.php" method="post">
 		<table cellpadding="15">
			<tr>
				<th>Delivery Date</th>
				<th>Ordered Amount</th>
				<th>Delivery Charges</th>
				<th>Delivery Team</th>
			</tr>
			<?php
			for($i=0;$i<$rcount;$i++)
			{
				$data=mysql_fetch_array($ret);
				echo "<tr>";
				echo "<td>".$data['DeliveryDate']."</td>";
				echo "<td>".$data['TotalAmount']."</td>";
				echo "<td>".$data['Charges']."</td>";
				echo "<td>".$data['DeliveryTeam']."</td>";
				echo "<td><a href='MyDeliveries.php?Did=".$data['DeliveryID']."'>Paid</a></td>";
				echo "</tr>";
			}
			?>
</table>
</div>
</div>
<?php
include('footer.php');
?>