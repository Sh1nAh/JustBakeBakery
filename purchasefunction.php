<?php
include('connect.php');

function Add($RawID, $Price, $Qty)
{
	$select="SELECT * FROM Raw WHERE RawID='$RawID'";
	$ret=mysql_query($select);
	$getdata=mysql_fetch_array($ret);
	$pname=$getdata['RawName'];

	if(!isset($_SESSION['PurchaseCart']))
	{
		$_SESSION['PurchaseCart']=array();
		$_SESSION['PurchaseCart'][0]['RawID']=$RawID;
		$_SESSION['PurchaseCart'][0]['RawName']=$pname;
		$_SESSION['PurchaseCart'][0]['PurchasePrice']=$Price;
		$_SESSION['PurchaseCart'][0]['PurchaseQty']=$Qty;
		$_SESSION['PurchaseCart'][0]['PurchaseAmount']=$Price*$Qty;
	}
	else
	{
		$rowindex=IndexOf($RawID);
		if($rowindex==-1)
		{
			$size=count($_SESSION['PurchaseCart']);
			$_SESSION['PurchaseCart'][$size]['RawID']=$RawID;
			$_SESSION['PurchaseCart'][$size]['RawName']=$pname;
			$_SESSION['PurchaseCart'][$size]['PurchasePrice']=$Price;
			$_SESSION['PurchaseCart'][$size]['PurchaseQty']=$Qty;
			$_SESSION['PurchaseCart'][$size]['PurchaseAmount']=$Price*$Qty;
		}
		else
		{
			$_SESSION['PurchaseCart'][$rowindex]['PurchaseQty']+=$Qty;
			$_SESSION['PurchaseCart'][$rowindex]['PurchaseAmount']+=$Price*$Qty;
		}
	}
	echo "<script>
			alert ('Raw Added');
			location.assign('purchase.php');
			</script>";
}
function Remove($RawID)
{
	$rowid=IndexOf($RawID);
	if($rowid==-1)
	{

	}
	else
	{
		unset($_SESSION['PurchaseCart'][$rowid]);
		$_SESSION['PurchaseCart']=array_values($_SESSION['PurchaseCart']);
		echo "<script>
				alert('Removed)
				location.assign('purchase.php');
				</script>";
	}
}
function getTotalAmount()
{
	$total=0;
	$size=count($_SESSION['PurchaseCart']);
		for($i=0;$i<$size;$i++)
		{
			$total+=$_SESSION['PurchaseCart'][$i]['PurchaseAmount'];
		}
		return $total;
}
function getTotalQty()
{
	$tqty=0;
	$size=count($_SESSION['PurchaseCart']);
		for($i=0;$i<$size;$i++)
		{
			$tqty+=$_SESSION['PurchaseCart'][$i]['PurchaseQty'];
		}
		return $tqty;
}
function IndexOf($RawID)
{
	if(!isset($_SESSION['PurchaseCart']))
	{
		return -1;
	}
	$size=count($_SESSION['PurchaseCart']);
	if($size==0)
	{
		return -1;
	}
	for($i=0;$i<$size;$i++)
	{
		if($RawID==$_SESSION['PurchaseCart'][$i]['RawID'])
		{
			return $i;
		}
	}
	return -1;
}
?>