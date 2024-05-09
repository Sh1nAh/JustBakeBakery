<?php
session_start();
include('connect.php');
include('header.php');

if (isset($_POST['save']))

{
	$UN=$_POST['txtname'];
	$PW=$_POST['txtpassword'];

	$select="SELECT * FROM Admin
			Where AdminName='$UN'
			AND Password='$PW'";
		$aret=mysql_query($select);
		$admin_coUNt=mysql_num_rows($aret);

		if($admin_coUNt>0)
		{
			$row=mysql_fetch_array($aret);
			$_SESSION['AdminID']=$row['AdminID'];
			$_SESSION['AdminName']=$row['AdminName'];
			echo"<script>alert('Admin Logged in Successfully')</script>";
			echo"<script>location='home.php'</script>";
		}
		else
		{
			$select="SELECT * FROM Customer
			Where CustomerName='$UN'
			AND Password='$PW'";
		$cret=mysql_query($select);
		$cus_coUNt=mysql_num_rows($cret);

		if($cus_coUNt>0)
		{
			$row=mysql_fetch_array($cret);
			$_SESSION['CustomerID']=$row['CustomerID'];
			$_SESSION['CustomerName']=$row['CustomerName'];
			echo"<script>alert('Customer Logged in Successfully')</script>";
			echo"<script>location='productdisplay.php'</script>";
		}
		else
		{
			echo "<script>alert('UserName or Password invalid')</script>";
			echo "<script>location='login.php</script>";
		}	
	}	
}
?>

<div id="body">
	<div id="contact">
		<h1>Login</h1>
<form action="login.php" method="post">
	<div class="information">
		<label for="name">User Name:</label>
		<input type="text" name="txtname" id="name" required>

		<label for="password">Password:</label>
		<input type="password" name="txtpassword" id="password" required>
	<table>
		<tr>
			<td>
				<input type="submit" name="save" id="send" value="Login">
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