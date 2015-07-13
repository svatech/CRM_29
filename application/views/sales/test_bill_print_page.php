
<div  style="width:420px;height:200px;font-family:'Times New Roman',Times,serif;" > 
<table  style='text-align:center;width:100%;line-height:14px;margin: 0 auto;'>
<tr><td colspan='2' style='font-size:15;font-weight:bold;'>TESTING LITRES BILL</td></tr>
<tr><td colspan='2' style='font-size:15;font-weight:bold;'>PRICOL FUEL & LUBE SERVICES</td></tr>
</table>
<hr style="width='100%'">
<?php foreach ($bill_info as $bill);?>
<table style="width:80%;margin: 0 auto;margin-top:5px;font-size:14;line-height:13px;">
<tr><td>Bill No: <?php echo $bill_no; ?></td><td align="right">Date: <?php echo date('d/m/y', strtotime($bill['account_date']));?></td></tr>
<tr><td >Pump No: <?php echo $bill['pump_no']; ?></td><td align="right">Counter :  <?php echo $bill['counter']; ?></td></tr>
<tr><td >Test Qty (Ltrs): <?php echo $bill['test_qty']; ?></td><td align="right">Shift :  <?php echo $bill['shift']; ?></td></tr>
<tr><td >Entered By: <?php echo $bill['added_by']; ?></td><td align="right">Purpose: <?php echo $bill['purpose']; ?></td></tr>
</table>
<table border='0' style="width:70%;margin: 0 auto;margin-top:20px;font-size:14;border-collapse:collapse;text-align:center;line-height:13px;">
<tr><td width='50%'>THANK YOU</td><td width='50%'>SIGNATURE</td></tr>
</table>
</div>
