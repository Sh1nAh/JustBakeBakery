<?php
session_start();
include('connect.php');
include('AutoID.php');
include('header.php');

if(isset($_POST['save']))
{
	$aname=$_POST['aname'];
	$aadd=$_POST['aaddress'];
	$aphone=$_POST['aphone'];
	$aemail=$_POST['aemail'];
	$apw=$_POST['apassword'];
	$aid=AutoID('Admin','AdminID','A-',6);

	$check="SELECT * FROM admin WHERE AdminEmail='$aemail'";
	$ret=mysql_query($check);
	$no=mysql_num_rows($ret);
	if($no>0)
	{
		echo "<script>
			alert('Admin Already Exits');
		</script>";
	}
	else
	{
		$ins="INSERT INTO admin (AdminID, AdminName, Password, Adminadd, AdminPhno, AdminEmail)
				VALUES ('$aid', '$aname','$apw', '$aadd', '$aphone', '$aemail')";
		$ret=mysql_query($ins) or die(mysql_error());
		if($ret)
		{
			echo "<script>
				alert('Admin Successfully Recorded');
				location.assign('login.php');
				</script>";
		}
	}
}
?>
<div id="body">
	<div id="contact">
		<h1>Admin Register</h1>
<form action="admin.php" method="post">
	<div class="information">
		<label for="name">Admin Name:</label>
		<input type="text" name="aname" id="name" placeholder="Enter your name" required>

		<label for="email">Email:</label>
		<input type="text" name="aemail" id="email" placeholder="example@email.com" required>

		<label for="password">Password:</label>
		<input type="password" name="apassword" id="name" placeholder="XXXX" required>

		<label for="phone">Phone Number:</label>
		<input type="text" name="aphone" id="phone" placeholder="09+----" required>
	</div>
	<div>
		<label for="address">Address:</label>
		<textarea name="aaddress" id="address" placeholder="No(_), Street, Township, City"></textarea>
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