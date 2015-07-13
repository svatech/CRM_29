<div  style="width:420px;height:230px;font-family:'Times New Roman',Times,serif;" > 
<table  style='text-align:center;width:100%;line-height:14px;margin: 0 auto;'>
<tr><td colspan='2' style='font-size:15;'>RETAIL BILL</td></tr>
<tr><td colspan='2' style='font-size:15;'>PRICOL FUEL & LUBE SERVICES</td></tr>
<tr><td colspan='2' style='font-size:15;'>INDIAN OIL DEALER</td></tr>
<tr><td colspan='2' style='font-size:14;'>SURVEY NO:318&319, PERIANAICKENPALAYAM</td></tr>
<tr><td colspan='2' style='font-size:14;'>MTP ROAD, COIMBATORE-20</td></tr>
<tr style='font-size:14;'><td >TIN NO:33541780278</td><td>Phone:0422-2692627</td></tr>
</table>
<hr style="width=100%;border:dotted 1px black;">
<?php foreach ($bill_info as $bill); ?>
<table style="width:80%;margin: 0 auto;font-size:14;line-height:13px;">
<tr><td>Bill No: <?php echo $bill_no; ?> <?php if($copy!='original') echo "-Duplicate Copy";?></td><td align="right">Date: <?php echo date('d/m/y', strtotime($bill['bill_date']));?></td></tr>
<tr><td >Vehicle No: <?php echo $bill['vehicle_number']; ?></td><td align="right">Counter :  <?php echo wordsToNumber($bill['counter']); ?></td></tr>
<?php if(($bill['indent_no'] != "NULL") || ($bill['km_reading'] != "")){
print("<tr>");
 if($bill['indent_no'] != "NULL"){
	print("<td>Indent No: ".$bill['indent_no']." </td>"); }
else{
	print("<td></td>");
}
if($bill['km_reading'] != ""){
	print("<td align='right'>KM Reading: ".$bill['km_reading']." </td>"); }
else{
	print("<td align='right'></td>");
}
	print("</tr>");
}

?>
</table>
<table style="width:80%;margin: 0 auto;font-size:14;line-height:13px;">
<tr><td colspan='2' align="left"><?php echo "Mr./Mrs./M/s. ". $bill['customer_name'];?></td></tr>
</table>
<table  style="width:90%;margin: 0 auto;margin-top:5px;font-size:14;line-height:24px;border-collapse:collapse;text-align:center;">

<tr><td width='40%' style='border:dashed 1px black;border-left:0px;'>PRODUCT</td><td width='20%' style='border:dashed 1px black;'>QTY(Ltrs)</td><td width='20%' style='border:dashed 1px black;'>RATE(Rs)</td><td width='20%' style='border:dashed 1px black;border-right:0px;'>AMOUNT(Rs)</td></tr>
<?php foreach ($bill_details as $detail){
print("<tr><td width='40%' style='border:dashed 1px black;border-left:0px;font-size:12;'>".$detail["product"]."</td><td width='20%' style='border:dashed 1px black;font-size:12;'>".$detail["quantity"]."</td><td width='20%' style='border:dashed 1px black;font-size:12;'>".$detail["rate"]."</td><td width='20%' style='border:dashed 1px black;border-right:0px;font-size:12;'>".$detail["value"]."</td></tr>");
 }?>
</table>

<table border='0' style="width:90%;margin: 0 auto;margin-top:5px;font-size:14;line-height:14px;border-collapse:collapse;text-align:center">
<tr><td width='40%'></td><td width='20%'></td><td width='20%'>Total (Rs)</td><td width='20%'><?php echo $bill['total_amount']; ?></td></tr>
</table>
<table border='0' style="width:70%;margin: 0 auto;margin-top:20px;font-size:14;border-collapse:collapse;text-align:center;line-height:14px;">
<tr><td width='60%' align='center'>Thank You, Visit Again  </td><td width='30%' align="center">Signature</td></tr>
</table>

</div>
