<?php
session_start();
include('connect.php');
include('AutoID.php');
include('header.php');

if (isset($_REQUEST['mode'])) 
{
	$mode=$_REQUEST['mode'];
	if ($mode=='delete') 
	{
		$ProductID=$_REQUEST['ProductID'];
		$delete="DELETE FROM Product WHERE ProductID='$ProductID'";
		$dret=mysql_query($delete);
		if ($dret) 
		{
			echo "<script>
				alert('Product Successfully Deleted');
				location.assign('product.php');
				</script>";
		}
	}
}
if(isset($_POST['save']))
{
	$pname=$_POST['txtName'];
	$qty=$_POST['txtQty'];
	$price=$_POST['txtPrice'];
	$ing=$_POST['txtIngredient'];
	$fla=$_POST['txtFlavour'];
	$pid=AutoID('Product','ProductID','P-',6);

	$image=$_FILES['Image']['name'];
	$folder="images/";
		if ($image)
		{
			$filename=$folder."_".$image;
			$copied=copy($_FILES['Image']['tmp_name'],$filename);
			if (!$copied)
			{
				exit("Problem Occured.Connect Upload Event Image.");
			}
		}

	$check="SELECT * FROM product WHERE ProductName='$pname'";
	$ret=mysql_query($check);
	$no=mysql_num_rows($ret);
	if($no>0)
	{
		echo "<script>
			alert('Product Already Exits');
		</script>";
	}
	else
	{
		$ins="INSERT INTO product (ProductID, ProductName, Quantity, Price, Ingredients, Flavour, Image)
				VALUES ('$pid', '$pname', '$qty', '$price', '$ing', '$fla', '$filename')";
		$ret=mysql_query($ins) or die(mysql_error());
		if($ret)
		{
			echo "<script>
				alert('Product Successfully Recorded');
				location.assign('product.php');
				</script>";
		}
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
			font-size: 16px;
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
<h1>Product Register</h1>
<form action="product.php" method="post" enctype="multipart/form-data">
	<div class="information">
		<label for="name">Product Name:</label>
		<input type="text" name="txtName" id="name" required>

		<label for="quantity">Quantity:</label>
		<input type="text" name="txtQty" id="qty" required>

		<label for="price">Price:</label>
		<input type="text" name="txtPrice" id="price" required>

		<label for="flavour">Flavour:</label>
		<input type="text" name="txtFlavour" id="flauour" required>

		<label for="image">Image:</label>
		<input type="file" name="Image" required>

		<br></br>

		<h1>Product Lists</h1>
	<table width="920">
		<tr>
			<td>
			<?php
			$select="SELECT * FROM product ORDER BY ProductID";
			$ret=mysql_query($select);
			$count=mysql_num_rows($ret);
			if($count==0)
			{
				echo "<h2>No Record Found</h2>";
			}
			else
			{
				echo "<table width=\"left\" cellpadding='8'>";
				echo "<tr>";
				echo "<th align=\"left\">ProductID</th>";
				echo "<th align=\"left\">ProductName</th>";
				echo "<th align=\"left\">Quantity</th>";
				echo "<th align=\"left\">Ingredients</th>";
				echo "<th align=\"left\">Flavour</th>";
				echo "<th align=\"left\">Price</th>";
				echo "</tr>";
			for($p=0;$p<$count;$p++)
			{
				$row=mysql_fetch_array($ret);
				$ProductID=$row["ProductID"];
				echo "<tr>";
				echo "<td>".$row['ProductID']."</td>";
				echo "<td>".$row['ProductName']."</td>";
				echo "<td>".$row['Quantity']."</td>";
				echo "<td>".$row['Ingredients']."</td>";
				echo "<td>".$row['Flavour']."</td>";
				echo "<td>".$row['Price']."</td>";
				echo "<td><a href='product.php?mode=edit&ProductID=".$row['ProductID']."'>Edit</arequired/></td>";
				echo "<td><a href='product.php?mode=delete&ProductID=".$row['ProductID']."'>Delete</arequired/></td>";
				echo "</tr>";
			}
			echo"</table>";
			}
			?>
			</td>
		</tr>
	</table>
	</div>
	<div>
		<label for="ingredients">Ingredients:</label>
		<textarea name="txtIngredient" id="address" required></textarea>
		<table>
			<tr>
				<td>
					<input type="submit" name="save" id="send" value="Save">
				</td>
				<td>
					<input type="reset" name="cancel" id="send" value="Cancel">
				</td>
			</tr>
		</table>
</form>
</div>
</div>
</div>
<?php 
include('footer.php');
 ?>