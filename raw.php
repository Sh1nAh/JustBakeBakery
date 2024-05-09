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
		$RawID=$_REQUEST['RawID'];
		$delete="DELETE FROM Raw WHERE RawID='$RawID'";
		$dret=mysql_query($delete);
		if ($dret) 
		{
			echo "<script>
				alert('Raw Successfully Deleted');
				location.assign('raw.php');
				</script>";
		}
	}
}
if(isset($_POST['btnsave']))
{
	$rname=$_POST['txtName'];
	$price=$_POST['txtPrice'];
	$qty=$_POST['txtQty'];
	$rid=AutoID('Raw','RawID','R-',6);

	$check="SELECT * FROM raw WHERE RawName='$rname'";
	$ret=mysql_query($check);
	$no=mysql_num_rows($ret);
	if($no>0)
	{
		echo "<script>
			alert('Raw Already Exits');
		</script>";
	}
	else
	{
		$ins="INSERT INTO raw (RawID, RawName, Price, Quantity)
				VALUES ('$rid', '$rname', '$price', '$qty')";
		$ret=mysql_query($ins) or die(mysql_error());
		if($ret)
		{
			echo "<script>
				alert('Raw Successfully Recorded');
				location.assign('raw.php');
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
<h1>Raw Register</h1>
<form action="raw.php" method="post" enctype="multipart/form-data">
	<div class="information">
		<label for="name">Raw Name:</label>
		<input type="text" name="txtName" id="name" required>

		<label for="quantity">Price:</label>
		<input type="text" name="txtPrice" id="price" required>

		<label for="price">Quantity:</label>
		<input type="text" name="txtQty" id="qty" required>
		<table>
			<tr>
				<td><input type="submit" name="btnsave" id="send" value="Save"/></td>
				<td><input type="reset" name="btncancel" id="send" value="Cancel"/></td>
			</tr>
		</table>
		<br></br>
	<h1>Raw Lists</h1>
	<table>
		<tr>
			<td>
			<?php
			$select="SELECT * FROM raw ORDER BY RawID";
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
				echo "<th align=\"left\">RawID</th>";
				echo "<th align=\"left\">RawName</th>";
				echo "<th align=\"left\">Price</th>";
				echo "<th align=\"left\">Quantity</th>";
				echo "</tr>";
			for($p=0;$p<$count;$p++)
			{
				$row=mysql_fetch_array($ret);
				$RawID=$row["RawID"];
				echo "<tr>";
				echo "<td>".$row['RawID']."</td>";
				echo "<td>".$row['RawName']."</td>";
				echo "<td>".$row['Price']."</td>";
				echo "<td>".$row['Quantity']."</td>";
				echo "<td><a href='raw.php?mode=edit&RawID=".$row['RawID']."'>Edit</arequired/></td>";
				echo "<td><a href='raw.php?mode=delete&RawID=".$row['RawID']."'>Delete</arequired/></td>";
				echo "</tr>";
			}
			echo"</table>";
			}
			?>
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