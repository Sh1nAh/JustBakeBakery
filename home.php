<?php
session_start();
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
						<a href="home.php">Home</a>
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
						<a href="raw.php">Raw</a>
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
						<a href="supplier.php">Supplier</a>
						<a href="purchase.php">Purchase</a>
						<a href="manageorders.php">Manage Order</a>
						<a href="scheduledelivery.php">Delivery Schedule</a>
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
	<div id="body">
		<div class="header">
			<div>
				<h1>Freshly Baked Everyday</h1>
				<p>
					You can register your account at register (customer) in our website, you're free to use this website and order proucts.
				</p>
			</div>
			<img src="images/home (1).jpg" alt="">
			<div>
				<h3>100% Homemade</h3>
				<ul>
					<li>
						<img src="images/home (2).jpg" alt=""> <span></apan>
					</li>
					<li>
						<img src="images/home (3).jpg" alt=""> <span>Teasty and healthy foods for your family</span>
					</li>
				</ul>
			</div>
		</div>
		<div class="body">
			<div>
				<p>
					2010. Just Bake bakery firstly opens in San-Yeik-Nyein, Kamayut Township and Yangon.</a>
				</p>
			</div>
			<img src="images/home (4).png" alt="">
			<div>
				<p>
					2017. Just Bake bakery opens a branch near Junction City, Bogyoke-Aung-San Road, Pabedon Township and Yangon.</a>
				</p>
			</div>
		</div>
		<div class="footer">
			<div class="figure">
				<div>
					<h1><a>Weekend Specials</a></h1>
					<a><img src="images/home (5).jpg" alt=""></a>
				</div>
			</div>
			<div class="article">
				<h3>blog</h3>
				<ul>
					<li>
						<span><a>Oct 14, 2017</a> | by: <a>blogger</a></span>
						<p>
							Great atmosphere.Tastes good!</a>
						</p>
					</li>
					<li>
						<span><a>Dec 16, 2017</a> | by: <a>blogger</a></span>
						<p>
							Had a real fun there.Yummy Breads!</a>
						</p>
					</li>
					<li>
						<span><a>Dec 23, 2017</a> | by: <a>blogger</a></span>
						<p>
							The best Bakery!</a>
						</p>
					</li>
				</ul>
			</div>
			<div class="section">
				<h3>store hours</h3>
				<a href="#"><img src="images/home (6).jpg" alt=""></a>
				<p>
					Monday to Friday 7:00 AM-7:30 PM. Saturday & Sunday 7:00 AM-6:00 PM.
				</p>
			</div>
		</div>
	</div>
		<div id="footer">
			<div>
			<div>
				<a href="http://freewebsitetemplates.com/go/facebook/" target="_blank" id="facebook">Facebook</a>
				<a href="http://freewebsitetemplates.com/go/twitter/" target="_blank" id="twitter">Twitter</a>
				<a href="http://freewebsitetemplates.com/go/googleplus/" target="_blank" id="googleplus">googleplus</a>
			</div>
		</div>
	</div>
</body>
</html>