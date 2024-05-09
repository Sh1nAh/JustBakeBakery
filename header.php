<?php
include('connect.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Just Bake Bakery</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div id="header">
		<div>
			<div>
			<?php 
			if (isset($_SESSION['CustomerID'])) 
			{
			?>
				<ul>
					<li>
						<a href="home.php">Home</a>
					</li>
					<li>
						<a href="productdisplay.php">Product Display</a>
					</li>
				</ul>
				<a id="logo"><img src="images/logo.png" alt="Image"></a>
				<ul>
					<li>
						<a href="logout.php">Logout</a>
					</li>
				</ul>
			<?php
			}
			else if (isset($_SESSION['AdminID'])) 
			{
			?>
				<ul>
					<li>
						<a href="purchase.php">Purchase</a>
					</li>
					<li>
						<a href="EntryProduction.php">Production</a>
					</li>
				</ul>
				<a id="logo"><img src="images/logo.png" alt="Image"></a>
				<ul>
					<li>
						<a href="product.php">Product</a>
					</li>
					<li>
						<a href="manageorders.php">Manage Order</a>
					</li>
				</ul>
			<?php
			}
			else
			{
			?>
				<ul>
					<li>
						<a href="home.php">Home</a>
					</li>
					<li>
						<a href="login.php">Login</a>
					</li>
				</ul>
				<a id="logo"><img src="images/logo.png" alt="Image"></a>
				<ul>
					<li>
						<a href="customer.php">Register (Customer)</a>
					</li>
					<li>
						<a href="admin.php">Register (Admin)</a>
					</li>
				</ul>
				
			<?php
			}
			 ?>
			</div>
		</div>


		<div>
			<?php 
			if (isset($_SESSION['CustomerID'])) 
			{
			?>
				<ul>
					<li>
					</li>
				</ul>
			<?php
			}
			else if (isset($_SESSION['AdminID'])) 
			{
			?>
				<ul>
					<li>
						<a href="raw.php">Raw</a>
						<a href="supplier.php">Supplier</a>
						<a href="scheduledelivery.php">Delivery Schedule</a>
						<a href="logout.php">Logout</a>
					</li>
				</ul>
			<?php
			}
			else
			{
			?>
				<ul>
					<li>
					</li>
				</ul>
				
			<?php
			}
			 ?>
		</div>
	</div>