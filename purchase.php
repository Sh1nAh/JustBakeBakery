<?php
session_start();
include('connect.php');
include('purchasefunction.php');
include('AutoID.php');
include('header.php');

if(isset($_POST['btnRPurchase']))
{
	$purid=AutoID('Purchase','PurchaseID','P-',6);
	$purdate=date('Y-m-d');
	$puramt=getTotalAmount();
	$pqty=getTotalQty();
	$sid=$_POST['cboSupplier'];

	$sql="INSERT INTO Purchase VALUES ('$purid','$sid', '$purdate', '$puramt','$pqty')";
	$run=mysql_query($sql);
	if($run)
	{
		$size=count($_SESSION['PurchaseCart']);
			for($i=0;$i<$size;$i++)
			{
				$pid=$_SESSION['PurchaseCart'][$i]['RawID'];
				$price=$_SESSION['PurchaseCart'][$i]['PurchasePrice'];
				$qty=$_SESSION['PurchaseCart'][$i]['PurchaseQty'];
				$amt=$_SESSION['PurchaseCart'][$i]['PurchaseAmount'];

				mysql_query("INSERT INTO PurchaseDetail VALUES ('$pid', '$purid','$purdate' ,'$amt', '$qty')");

				mysql_query("UPDATE Raw SET Quantity=Quantity+'$qty', Price='$price'*1.25 WHERE RawID='$pid'");
			}
			unset($_SESSION['PurchaseCart']);
			echo "<script>
				alert('Purchase Recorded');
				location.assign('purchase.php');
			</script>";
	}
}

if(isset($_POST['btnadd']))
{
	$pid=$_POST['cboRaw'];
	$price=$_POST['txtPrice'];
	$qty=$_POST['txtQty'];
	Add($pid,$price,$qty);
}

if(isset($_REQUEST['action']))
{
	$action=$_REQUEST['action'];
	$pid=$_REQUEST['RawID'];
	if($action=='remove')
	{
		Remove($pid);
	}
}
?>
<html>
<head>
	<style type="text/css">
		table
		{
			color: #989282;
			line-height: 36px;
			display: inline-block;
			font-family: 'DeliusSwashCaps-Regular';
			font-size: 15px;
		}
		.add td
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
	<script type="text/javascript">
	function calcAmount()
	{
		var price, qty, amt;
		price=document.getElementById("txtPrice").value;
		qty=document.getElementById("txtQty").value;
		amt=price*qty;
		document.getElementById("txtAmount").value=amt;
	}
	</script>
</head>
<body>
<div id="body">
<div id="contact">
	<h1>Purchase</h1>
	<form action="purchase.php" method="post" enctype="multipart/form-data">
		<table class="information">
			<tr>
				<td colspan="3">
					<table class="add">
						<tr>
							<td>Raw:</td>
							<td>
								<select name="cboRaw">
									<option>Select Raws</option>
									<?php
									$sql="SELECT * FROM Raw";
									$ret=mysql_query($sql);
									$rowcount=mysql_num_rows($ret);
									for($r=0;$r<$rowcount;$r++)
									{
										$data=mysql_fetch_array($ret);
										echo "<option value='".$data['RawID']."'>".$data['RawName']."</option>";
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Purchase Price:</td>
							<td><input type="text" name="txtPrice" id="txtPrice"></td>
						</tr>
						<tr>
							<td>Purchase Qty:</td>
							<td><input type="text" name="txtQty" id="txtQty" onKeyUp="calcAmount()"></td>
						</tr>
						<tr>
							<td>Amount:</td>
							<td><input type="text" name="txtAmount" id="txtAmount"></td>
						</tr>
						<tr>
							<td><input type="submit" name="btnadd" id="send" value="Add"/></td>
						</tr>
				</td>
			</tr>
		</table>
		<tr>
			<td>
				<?php 
				if (isset($_SESSION['PurchaseCart'])) 
				{
				 ?>
					<fieldset>
					<legend>Purchase List</legend>
					<table width=\"left\" cellpadding="13">
						<tr>
							<th>Raw</th>
							<th>Price</th>
							<th>Qty</th>
							<th>Amount</th>
						</tr>
						<?php
						if(isset($_SESSION['PurchaseCart']))
						{
							$size=count($_SESSION['PurchaseCart']);
							for($i=0;$i<$size;$i++)
							{
								echo "<tr>";
								echo "<td>".$_SESSION['PurchaseCart'][$i]['RawName']."</td>";
								echo "<td>".$_SESSION['PurchaseCart'][$i]['PurchasePrice']."</td>";
								echo "<td>".$_SESSION['PurchaseCart'][$i]['PurchaseQty']."</td>";
								echo "<td>".$_SESSION['PurchaseCart'][$i]['PurchaseAmount']."</td>";
								echo "<td><a href='purchase.php?action=remove&RawID=".$_SESSION['PurchaseCart'][$i]['RawID']."'>Remove</a></td>";
								echo "</tr>";
							}
						}
						?>
					</table>
					</fieldset>
					<table class="add">
						<tr>
							<td>Total Amount:</td>
							<td><input type="text" name="txtAmount" value="<?php echo getTotalAmount();?>"></td>
							<td></td>
							<td>Supplier:</td>
							<td>
								<select name="cboSupplier">
									<option>SELECT Supplier</option>
									<?php
									$sel="SELECT * FROM Supplier";
									$s_run=mysql_query($sel);
									$s_count=mysql_num_rows($s_run);
									for($i=0;$i<$s_count;$i++)
									{
										$data=mysql_fetch_array($s_run);
										echo "<option value='".$data['SupplierID']."'>".$data['SupplierName']."</option>";
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td colspan="5" align="left">
							<input type="submit" name="btnRPurchase" id="rec" value="Record Purchase"/></td>
						</tr>
					</table>
	
				<?php 
					}
					else
					{
						echo "";
					}
				 ?>
			</td>
		</tr>
	</table>
</div>
</div>
<?php
include('footer.php');
?>