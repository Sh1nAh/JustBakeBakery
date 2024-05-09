<?php
include('connect.php');

function Add($ProductID, $Qty)
{
	$select="SELECT * FROM Product WHERE ProductID='$ProductID'";
	$ret=mysql_query($select);
	$getdata=mysql_fetch_array($ret);
	$pname=$getdata['ProductName'];
	$Price=$getdata['Price'];
	$image=$getdata['Image'];

	if(!isset($_SESSION['ShoppingCart']))
	{
		$_SESSION['ShoppingCart']=array();
		$_SESSION['ShoppingCart'][0]['ProductID']=$ProductID;
		$_SESSION['ShoppingCart'][0]['ProductName']=$pname;
		$_SESSION['ShoppingCart'][0]['Price']=$Price;
		$_SESSION['ShoppingCart'][0]['Qty']=$Qty;
		$_SESSION['ShoppingCart'][0]['Amount']=$Price*$Qty;
		$_SESSION['ShoppingCart'][0]['Image']=$image;
	}
	else
	{
		$rowindex=IndexOf($ProductID);
		if($rowindex==-1)
		{
			$size=count($_SESSION['ShoppingCart']);
			$_SESSION['ShoppingCart'][$size]['ProductID']=$ProductID;
			$_SESSION['ShoppingCart'][$size]['ProductName']=$pname;
			$_SESSION['ShoppingCart'][$size]['Price']=$Price;
			$_SESSION['ShoppingCart'][$size]['Qty']=$Qty;
			$_SESSION['ShoppingCart'][$size]['Amount']=$Price*$Qty;
			$_SESSION['ShoppingCart'][$size]['Image']=$image;
		}
		else
		{
			$_SESSION['ShoppingCart'][$rowindex]['Qty']+=$Qty;
			$_SESSION['ShoppingCart'][$rowindex]['Amount']+=$Price*$Qty;
		}
	}
	echo "<script>
			alert ('Product Added');
			location.assign('shoppingcart.php');
			</script>";
}
function Remove($ProductID)
{
	$rowid=IndexOf($ProductID);
	if($rowid==-1)
	{
	}
	else
	{
		unset($_SESSION['ShoppingCart'][$rowid]);
		$_SESSION['ShoppingCart']=array_values($_SESSION['ShoppingCart']);
		echo "<script>
				alert('Removed')
				location.assign('shoppingcart.php');
				</script>";
	}
}
function getTotalAmount()
{
	$total=0;
	$size=count($_SESSION['ShoppingCart']);
		for($i=0;$i<$size;$i++)
		{
			$total+=$_SESSION['ShoppingCart'][$i]['Amount'];
		}
		return $total;
}
function IndexOf($ProductID)
{
	if(!isset($_SESSION['ShoppingCart']))
	{
		return -1;
	}
	$size=count($_SESSION['ShoppingCart']);
	if($size==0)
	{
		return -1;
	}
	for($i=0;$i<$size;$i++)
	{
		if($ProductID==$_SESSION['ShoppingCart'][$i]['ProductID'])
		{
			return $i;
		}
	}
	return -1;
}
?>