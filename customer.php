<?php
session_start();
include('connect.php');
include('AutoID.php');
include('header.php');

if(isset($_POST['save']))
{
	$cname=$_POST['cname'];
	$cemail=$_POST['cemail'];
	$cpw=$_POST['cpassword'];
	$cadd=$_POST['caddress'];
	$cphone=$_POST['cphone'];
	$cid=AutoID('Customer','CustomerID','C-',6);

	$check="SELECT * FROM customer WHERE Email='$cemail'";
	$ret=mysql_query($check);
	$no=mysql_num_rows($ret);
	if($no>0)
	{
		echo "<script>alert('User Already Exits')</script>";
	}
	else
	{
		$ins="INSERT INTO customer (CustomerID, CustomerName, Email, Password, Address, PhoneNumber)
				VALUES ('$cid', '$cname', '$cemail', '$cpw', '$cadd', '$cphone')";
		$ret=mysql_query($ins) or die(mysql_error());
		if($ret)
		{
			echo "<script>alert('User Successfully Recorded');
				location.assign('login.php');
				</script>";
		}
	}
}
?>
<div id="body">
	<div id="contact">
		<h1>Customer Register</h1>
<form action="customer.php" method="post">
	<div class="information">
		<label for="name">Customer Name:</label>
		<input type="text" name="cname" id="name" placeholder="Enter your name" required>

		<label for="email">Email:</label>
		<input type="text" name="cemail" id="email" placeholder="example@email.com" required>

		<label for="password">Password:</label>
		<input type="password" name="cpassword" id="name" placeholder="XXXX" required>

		<label for="phone">Phone Number:</label>
		<input type="text" name="cphone" id="phone" placeholder="09+----" required>
	</div>
	<div>
		<label for="address">Address:</label>
		<textarea name="caddress" id="address" placeholder="No(_), Street, Township, City" required ></textarea>
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
	</div>
</from>
</div>
</div>
<?php 
include('footer.php');
?>