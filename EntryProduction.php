<?php 
session_start();
include('connect.php');
include('AutoID.php');
include('header.php');

if (isset($_POST['submit'])) 
{
	$ProductionID=AutoID('Production','ProductionID','PD_',6);
	echo $productid=$_POST['pname'];
	$ProducedQuantity=$_POST['producedqty'];
	$date=$_POST['date'];
	



		$ins="INSERT INTO production (ProductionID, ProductID, Quantity,  Date)
				VALUES ('$ProductionID', '$productid', '$ProducedQuantity', '$date')";
		$ret=mysql_query($ins) or die(mysql_error());

		foreach($_POST['Raw'] as $selected)
		{
			$n=$selected-1;
			$Qty=$_POST['txtquantity'.$n];
			$insert="INSERT INTO rawdetail
				(RawID,ProductionID,Quantity)
				VALUES
				('$selected','$ProductionID','$Qty')";

			$detailret=mysql_query($insert) or die(mysql_error());

			$rawquantity="UPDATE Raw SET Quantity=Quantity-$Qty Where RawID='$selected'";
			$rawqtyret=mysql_query($rawquantity) or die(mysql_error());

		}




		$update="UPDATE Product 
				SET Quantity=Quantity+$ProducedQuantity
				where ProductID='$productid'";
		$rawret=mysql_query($update);

		if ($rawret) 
		{
			echo "<script>window.alert('Successfully Produced!')</script>";
			echo "<script>window.location='EntryProduction.php'</script>";
		}
		else
		{
			mysql_error();
		}
}
?>

<head>
	<style type="text/css">
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
		#checkbox
		{
			width: 10px;
			float: left;
		}
	</style>
</head>
<body>
	<div id="body">
	<div id="contact">
		<h1 align="center">Production</h1>
	<form action="#" method="post">
		<table>
			<h1>Raw Detail Form</h1>
			<br></br>
			<tr>
				<td></td>
				<td><input type="hidden" name="productid"></td>
			</tr>
			<tr>
				<td>Product Name :</td>
				<td>
					<select name="pname">
						<option>Select Product Name</option>
						<?php 
							$proselect="SELECT * FROM Product";

							$ret=mysql_query($proselect);
							$count=mysql_num_rows($ret);

							for($i=0 ; $i<$count ; $i++)
							{
								$row = mysql_fetch_array($ret);
								echo "<option value='".$row['ProductID']."'>".$row['ProductName']."</option>";
							}
						 ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Raw Name :</td>
					<td align="left">
							<?php 
								$rawselect="SELECT * FROM Raw";

								$ret=mysql_query($rawselect);
								$count=mysql_num_rows($ret);

								for($i=0 ; $i<$count ; $i++)
								{
									$row = mysql_fetch_array($ret);
									echo "<input type='checkbox' name='Raw[]' value='".$row['RawID']."' id='checkbox'>".$row['RawName'];
									echo "<input type='text' name='txtquantity' min='1' max='30'".$i."' placeholder='Enter Raw Quantity'>";
								}
							 ?>
					</td>
			</tr>
			<tr>
				<td>Production Date :</td>
				<td><input type="date" name="date" required/></td>
			</tr>
			<tr>
				<td>Produced Product Quantity :</td>
				<td><input type="number" name="producedqty" required/></td>
			</tr>
			<tr><td></td></tr>
			<tr>
				<td></td>
				<td><input type="submit" name="submit" id="add" value="Add"></td>
			</tr>
		</table>
			<br></br><br></br>
		<h1>Production Lists</h1>
		<table align="left" border=1 cellpadding="10">
			<tr>
				<th>Product Name</th>
				<th>Quantity</th>
				<th>Production Date</th>
			</tr>
			<?php
				$query = "SELECT * FROM Production pd, Product p, Raw r, RawDetail rd
						where rd.RawID=r.RawID
						AND p.ProductID=pd.ProductID
						AND rd.ProductionID=pd.ProductionID";
				$result = mysql_query($query);
				$count = mysql_num_rows($result);

				for($i=0;$i<$count;$i++)
				{
					$row = mysql_fetch_array($result);
					echo "<tr>";
					echo "<td>" . $row['ProductName'] . "</td>";
					echo "<td>" . $row['Quantity'] . "</td>";
					echo "<td>" . $row['Date'] . "</td>";
				}
			?>
		</table>
		</form>
		</div>
</div>
</div>
<?php 
include('footer.php');
?>