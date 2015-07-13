
<?php 
$count0=0;
foreach($cancelled_bill_details as $row) { 
$count0++;
if($count0 ==1){ ?>
<div>
<table style="width:80%;margin-left:10px;padding:0px;margin-right:10px;" cellpadding="3" cellspacing="3">

<tr>
	<td>Bill No</td>
	<td ><input readonly="readonly" name="bill_no" id="bill_no" readonly="readonly" type="text" style="width:100px;height:20px;" value='<?php echo $row->bill_number?>'></td>

	<td>Vehicle No</td>
	<td ><input readonly="readonly" name="veh_no" id="veh_no" type="text" style="width:100px;height:20px;" value='<?php echo $row->vehicle_number?>'></td>
</tr>
<tr>
	<td>Customer Name</td>
	<td ><input readonly="readonly" name="cust_name" id="cust_name" type="text" style="width:250px;height:20px;" value='<?php echo $row->customer_name?>' ></td>
	<td>Mobile No</td>
	<td ><input readonly="readonly" name="mob_no" id="mob_no" type="text" style="width:100px;height:20px;" value='<?php echo $row->mobile_number?>' onkeyup=""></td>
</tr>


<tr>
	<td>Pump No</td>
	<td ><input readonly="readonly" name="pump_no" id="pump_no" type="text" style="width:100px;height:20px;" value='<?php echo $row->pump_number?>' onkeyup=""></td>

	<td>Counter No</td>
		<td ><input readonly="readonly" name="counter" id="counter" type="text" style="width:100px;height:20px;" value='<?php echo ucfirst($row->counter)?>' onkeyup="">
	</td>
</tr>
<tr>
	<td>Shift</td>
		<td ><input readonly="readonly" name="shift" id="shift" type="text" style="width:100px;height:20px;" value='<?php echo $row->shift?>' onkeyup="">
	</td>
<td>KM Reading</td>
	<td ><input readonly="readonly" name="meter_reading" id="meter_reading" type="text" style="width:50px;height:20px;" value='<?php echo $row->km_reading?>'></td>
</tr>
<tr>
	<td>Sales Mode</td>
	<td ><input readonly="readonly" name="sale_mode" id="sale_mode" type="text" style="width:100px;height:20px;" value='<?php echo $row->sale_mode?>' onkeyup="">
	</td>

<?php if($row->sale_mode == 'Indent_sales'){

	print("<td id='indent_no1' style='display:block'>Indent Number</td>");
	print("<td id='indent_no2' style='display:block'><input readonly='readonly' name='indent_no' id='indent_no' type='text' style='width:100px;height:20px;' value=' $row->indent_no' ></td>");
	print("</tr><tr>");
	print("<td style='display:block' id='cust_id1'>Customer Id</td>");
	print("<td style='display:block' id='cust_id2'><input readonly='readonly' name='cust_id' id='cust_id' type='text' style='width:100px;height:20px;' value='$row->cust_id'></td>");
	print("<td style='width:0px'></td>");
	print("<td style='width:100px' align='right'><p id='indent' style='color:#ff0000;'></p></td>");
	print("</tr>");
	print("<tr style=''>");
	print("<td style='' >Reference No</td>");
	print("<td style='' ><input name='ref_no' id='ref_no' readonly='readonly' type='text' style='width:100px;height:20px;' value='$row->reference_no'></td>");
	print("</tr>");
 }else {

	print("<td style='display:none' id='indent_no1'>Indent Number</td>");
	print("<td style='display:none' id='indent_no2'><input readonly='readonly' name='indent_no' id='indent_no' type='text' style='width:100px;height:20px;' value='$row->indent_no' ></td>");
	
	print("</tr><tr>");
	print("<td style='display:none' id='cust_id1'>Customer Id</td>");
	print("<td style='display:none' id='cust_id2'><input readonly='readonly' name='cust_id' id='cust_id' type='text' style='width:100px;height:20px;' value=''></td>");
	print("<td style='width:0px'></td>");
	print("<td style='width:100px' align='right'><p id='indent' style='color:#ff0000;'></p></td>");
	print("</tr>"); 
	print("<tr style='display:none;'>");
	print("<td style='' >Reference No</td>");
	print("<td style='' ><input name='ref_no' id='ref_no' readonly='readonly' type='text' style='width:100px;height:20px;' value='$row->reference_no'></td>");
	print("</tr>");
 }
	?>

</table>

<div style="min-height:140px;height:auto;width:80%;margin:10px 10px 0px 20px;border:0px solid green;border-radius:0px;">
<table border="0" id="billtable" style="width:80%;border-radius:15px;border-collapse:collapse;" class='bill_table'>
	<tr bgcolor='#559999' style='color:white;'>
		<td >Item Name</td>
		<td>Quantity&nbsp;&nbsp;(Ltrs)</td>
		<td>Value&nbsp;&nbsp;(Rs)</td>
		<td>Rate&nbsp;&nbsp;(Rs)</td>
	</tr>
	<?php } } ?>
	
	<?php 
	$count1=0;
	foreach($cancelled_bill_pdt_details as $details) {  
	$count1++;
		if ($count1 == 1 ){?>
	<tr> 
	   <?php $item="item".$count1; ?>
	   <?php $qty="qty".$count1; ?>
	   <?php $rate="rate".$count1; ?>
	   <?php $value="value".$count1; ?>
	   <td ><input readonly="readonly" name="<?php echo $item;?>" id="<?php echo $item;?>" type="text" style="width:100px;height:20px;" value='<?php echo $details->product?>' onkeyup="">
	   
		
			
			</td>
		<td><input readonly='readonly' type="text" name="<?php echo $qty;?>" id="<?php echo $qty;?>" value="<?php echo $details->quantity;?>" /></td>
		<td><input readonly='readonly' type="text" name="<?php echo $value;?>" id="<?php echo $value;?>" value="<?php echo $details->value;?>" /></td>
		<td><input readonly='readonly' type="text" name="<?php echo $rate;?>" id="<?php echo $rate;?>" value="<?php echo $details->rate;?>"/></td>
		<td><input readonly='readonly' type="hidden" name="bill_version" id="bill_version" value="<?php echo $details->bill_updated;?>"></td>
	</tr>
	<?php  } ?>
	<?php if ($count1 >= 2 ){?>
	<tr> 
		<?php $item="item".$count1; ?>
	   <?php $qty="qty".$count1; ?>
	   <?php $rate="rate".$count1; ?>
	   <?php $value="value".$count1; ?>
	
		<td ><input readonly="readonly" name="<?php echo $item;?>" id="<?php echo $item;?>" type="text" style="width:100px;height:20px;" value='<?php echo $details->product?>' onkeyup="">
		 </td>
		<td><input readonly='readonly' type="text"  name="<?php echo $qty;?>" id="<?php echo $qty;?>" value="<?php echo $details->quantity;?>" onchange="opener.cal_amtpop(this.value,<?php echo $count1 ;?>)"/></td>
		<td><input readonly='readonly' type="text" name="<?php echo $value;?>" id="<?php echo $value;?>" value="<?php echo $details->value;?>" onchange="opener.crt_amtpop(this.value,<?php echo $count1 ;?>,event)"/></td>
		<td><input readonly='readonly' type="text" name="<?php echo $rate;?>" id="<?php echo $rate;?>" value="<?php echo $details->rate;?>"/></td>
	</tr> 
	 <?php  }  ?>

<?php } ?>

</table>
<p align="right">
<input type="hidden" name="count" value="<?php echo $count1;?>" id="count" >
</div>
</div>

<p align="left" style="margin-left:445px;">Grand Total&nbsp;&nbsp;(Rs)<input readonly='readonly' type="text" name="total" id="total" value="<?php  echo $row->total_amount; ?>"  readonly="readonly"  style="width:100px;"/></p>

