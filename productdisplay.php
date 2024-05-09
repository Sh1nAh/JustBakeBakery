<?php
session_start();
	include('connect.php');
	include('header.php');
	$sel="SELECT * FROM product ";
		$gurn=mysql_query($sel);
		$gtotal=mysql_num_rows($gurn);
?>
<html>
<head>
</head>
<body>
<form action="#" method="post">
	<div id="body">
		<div id="content">
			<ul class="gallery">
		<?php
		for($i=0;$i<$gtotal;$i++)
		{
			
				$getdata=mysql_fetch_array($gurn);
				echo "<li style='border: 1px solid #876a38; background: #543f1b;'>";
				echo "<a href='detail.php?ProductID=".$getdata['ProductID']."' class='figure'>";
				echo "<img src='".$getdata['Image']." ' width='230px' height='170px'><br>";
				echo "<span><b>".$getdata['ProductName']."</b><br>";
				echo "<b>Price: </b><b>".$getdata['Price']."</b><b> Kyats</b></span>";
				echo "</a>";
				echo "</li>";
		}
		?>
			</ul>
		</div>
	</div>
	</form>
<?php 
include('footer.php');
?>