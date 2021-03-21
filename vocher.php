<?php 
include("database/db_conection.php");//make connection here
?>
<?php 
$id = $_GET['id'];
$qr  = "SELECT * FROM expenses_master WHERE id=$id";
$exc = mysqli_query($dbcon,$qr)or die();
$invo = 0;
$notes = 0;
$createddate = 0;
while($r = mysqli_fetch_array($exc)){
		$invo 		 = $r['inv_no'];
		$notes 		 = $r['notes'];
		$createddate = $r['createddate'];
}
?>
<html>
<body onload="printdata()">
<style>
.tablex tr td{
	padding: 7px;
    padding-left: 7px;
	padding-left: 37px;
	color: white;
}
</style>
<div style="padding: 61px;">
<table style="font-weight: bold;width: 100%;">
<tr><td><font style="font-size: x-large;font-weight: bold;">Dhoraj Agro Private Limited</font></td></tr>
<!--<tr><td></td><td></td><td></td></tr>
<tr><td>Bargur,Tamilnadu 635104 IN</td><td></td><td></td></tr>
<tr><td>9677573737</td><td></td><td></td></tr>
<tr><td>Janashri.meghana@gmail.com</td><td></td><td></td></tr>-->
<tr><td style="padding: 31px;padding-left: 1px;color: steelblue;"><font style="font-size: xx-large;font-weight: normal;">Expense Voucher</font></td><td></td><td></td></tr>

<tr><td>Payment To</td><td></td><td>Date:&nbsp;&nbsp;&nbsp;<font><?php echo $createddate; ?></font></td></tr>
<tr><td>Saravankumar</td><td></td><td>Referance No:</td></tr>
<tr><td></td><td></td><td>Invoice No:&nbsp;&nbsp;&nbsp;<font><?php echo $invo; ?></font></td></tr>
</table>
<br/>
<br/>
<table class="tablex" style="width: 100%;padding: 0px;" border="1">
<tr style="background-color: #7ea9ce;">
<td>Account/item</td>
<td>Description</td>
<td>Tax</td>
<td>Amount</td>
</tr>
<?php 
$qr  = "SELECT * FROM expenses_lines WHERE header_id=$id";
$exc = mysqli_query($dbcon,$qr)or die();
$subtotal = 0;
$taxtotal = 0;
$total = 0;
while($r = mysqli_fetch_array($exc)){
	$subtotal =   + $r['amount']*$r['qty'];
	$taxtotal =   + $r['gst'];
?>
<tr>
<td style="color: black;">1</td>
<td style="color: black;"><?php echo $r['category']; ?></td>
<td style="color: black;"><?php echo $r['description']; ?></td>
<td style="color: black;"><?php echo $r['gst']; ?></td>
<td style="color: black;"><?php echo $r['amount']; ?></td>
</tr>
<?php 
}
$total = $subtotal+$taxtotal;
?>
</table>
<hr>
<br/>
<table style="width: 100%;">
<tr><td>memo:&nbsp;&nbsp;&nbsp;<?php echo $notes; ?></td><td style="width: 57%;"></td><td style="width: 13%;">SUBTOTAL : </td><td><font style="margin-left: 35px;font-weight: bold;"><?php echo $subtotal; ?></font></td></tr>
<tr><td></td><td></td><td>Tax: </td><td><font style="margin-left: 35px;font-weight: bold;"><?php echo $taxtotal; ?></font></td></tr>
<tr><td></td><td></td><td>TOTAL:</td><td><font style="margin-left: 35px;font-weight: bold;"><?php echo $total; ?></font></td>
	
	
	</tr>
</table>
</div>
</body>
<script>
function printdata(){
	window.print();
}

window.onafterprint = function(){
   window.location.href = 'listofrecordExpenses.php';
}
</script>
</html>