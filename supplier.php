<?php
session_start();
include('connect.php');
include('AutoID.php');
include('header.php');

if(isset($_POST['btnsave']))
{
	$sname=$_POST['name'];
	$sadd=$_POST['address'];
	$sphone=$_POST['phone'];
	$semail=$_POST['email'];
	$sid=AutoID('Supplier','SupplierID','S-',6);

	$check="SELECT * FROM supplier WHERE SupplierEmail='$semail'";
	$ret=mysql_query($check);
	$no=mysql_num_rows($ret);
	if($no>0)
	{
		echo "<script>
			alert('Supplier Already Exits');
		</script>";
	}
	else
	{
		$ins="INSERT INTO supplier (SupplierID, SupplierName, SupplierAdd, SupplierPhno, SupplierEmail)
				VALUES ('$sid', '$sname', '$sadd', '$sphone', '$semail')";
		$ret=mysql_query($ins) or die(mysql_error());
		if($ret)
		{
			echo "<script>
				alert('Supplier Successfully Recorded');
				location.assign('supplier.php');
				</script>";
		}
	}
}
?>
<div id="body">
	<div id="contact">
		<h1>Supplier Register</h1>
<form action="supplier.php" method="post">
	<div class="information">
		<label for="name">Supplier Name:</label>
		<input type="text" name="name" id="name" placeholder="Supplier Name" required>

		<label for="email">Email:</label>
		<input type="text" name="email" id="email" placeholder="example@email.com" required>

		<label for="phone">Phone Number:</label>
		<input type="text" name="phone" id="phone" placeholder="09+----" required>
	</div>
	<div>
		<label for="address">Address:</label>
		<textarea name="address" id="address" placeholder="No(_), Street, Township, City" required></textarea>		
	<table>
		<tr>
			<td>
				<input type="submit" name="btnsave" id="send" value="Save">
			</td>
			<td>
				<input type="reset" name="cancel" id="send" value="Cancel">
			</td>
		</tr>
	</table>
	</div>
</from>
</div>
</div>
<?php 
include('footer.php');
 ?>