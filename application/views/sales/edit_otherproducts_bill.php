
<?php 
$count0=0;
foreach($billdetails as $row) { 
$count0++;
if($count0 ==1){ ?>
<div>
<table style="width:80%;margin-left:10px;padding:0px;margin-right:10px;" cellpadding="3" cellspacing="3">

<tr>
	<td>Bill No</td>
	<td ><input name="bill_no" id="bill_no" readonly="readonly" type="text" style="width:100px;height:20px;" value='<?php echo $row->bill_no?>'></td>

	<td>Vehicle No</td>
	<td ><input name="veh_no" id="veh_no" type="text" style="width:100px;height:20px;" value='<?php echo $row->vehicle_no?>'></td>
</tr>
<tr>
	<td>Customer Name</td>
	<td ><input name="cust_name" id="cust_name" type="text" style="width:250px;height:20px;" value='<?php echo $row->customer_name?>' onblur='opener.getVehList(this.value)'></td>
	<td>Mobile No</td>
	<td ><input name="mob_no" id="mob_no" type="text" onkeypress="return opener.isNumberKey(event)" maxlength="10" style="width:100px;height:20px;" value='<?php echo $row->mobile_no?>' onkeyup=""></td>
</tr>


<tr>
	<!-- <td>Category</td>
	<td><input name="category" id="category" type="text" style="width:100px;height:20px;" value='<?php echo $row->category?>'></td>
	 -->
	<td>Counter No</td>
		<td><select name="counter" id="counter" style="width:70px;height:20px;">
		<?php foreach($counter as $count) {
		$mas_counter=$count->counter;
		$act_counter=$row->counter;
		if($mas_counter==$act_counter){?>
		<option selected='selected' value="<?php echo $act_counter;?>" ><?php echo ucfirst($act_counter);?></option>
		<?php } 
		else 
		{?>
		<option  value="<?php echo $mas_counter?>" ><?php echo ucfirst($mas_counter)?></option>
			<?php } } ?> </select>
	</td>
</tr>
<tr>
	<td>Shift</td>
		<td><select name="shift" id="shift" style="width:70px;height:20px;">
		<?php $shift=$row->shift;
		if($shift == 'I') { ?>
		<option selected='selected' value="<?php echo $shift ?>" ><?php echo $shift;?></option>
		<option  value="II" >II</option>
		<option  value="III" >III</option>
		<?php   } else if ($shift == 'II') { ?>
		<option selected='selected' value="<?php echo $shift ?>" ><?php echo $shift;?></option>
		<option  value="I" >I</option>
		<option  value="III" >III</option>
		 <?php }  else if ($shift == 'III'){  ?>
		<option  value="<?php echo $shift?>" ><?php echo $shift?></option>
		<option  value="II" >II</option>
		<option  value="I" >I</option>
			<?php }?> </select>
	</td>
</tr>
<tr>
	<td>Sales Mode</td>
		<td><select name="sales_mode" id="sales_mode" style="width:150px;height:20px;" onchange="opener.salesmode(this.value)">
		<?php $mode=$row->sale_mode;
		if($mode == 'Cash_sales') { ?>
		<option selected='selected' value="<?php echo $mode ?>" >Cash Sales</option>
		<option  value="Indent_sales" >Indent Sales</option>
		<option  value="Credit_card_sales" >Credit Card Sales</option>
		<option  value="Xtra_reward_sales" >XtraReward Card Sales</option>
		<option  value="Fleet_card_sales" >XtraPower Card Sales</option>
		<option  value="Easy_fuel_sales" >Easy Fuel Sales</option>
		<option  value="Cheque_sales" >Cheque Sales</option>
		<?php   } else if($mode == 'Indent_sales') { ?>
		<option selected='selected' value="<?php echo $mode ?>" >Indent Sales</option>
		<option  value="Cash_sales" >Cash Sales</option>
		<option  value="Credit_card_sales" >Credit Card Sales</option>
		<option  value="Xtra_reward_sales" >XtraReward Card Sales</option>
		<option  value="Fleet_card_sales" >XtraPower Card Sales</option>
		<option  value="Easy_fuel_sales" >Easy Fuel Sales</option>
		<option  value="Cheque_sales" >Cheque Sales</option>
		 <?php }  else if($mode == 'Credit_card_sales') { ?>
		<option selected='selected' value="<?php echo $mode ?>" >Credit Card Sales</option>
		<option  value="Cash_sales" >Cash Sales</option>
		<option  value="Indent_sales" >Indent Sales</option>
		<option  value="Xtra_reward_sales" >XtraReward Card Sales</option>
		<option  value="Fleet_card_sales" >XtraPower Card Sales</option>
		<option  value="Easy_fuel_sales" >Easy Fuel Sales</option>
		<option  value="Cheque_sales" >Cheque Sales</option>
		<?php }  else if($mode == 'Xtra_reward_sales') { ?>
		<option selected='selected' value="<?php echo $mode ?>" >XtraReward Card Sales</option>
		<option  value="Cash_sales" >Cash Sales</option>
		<option  value="Indent_sales" >Indent Sales</option>
		<option  value="Credit_card_sales" >Credit Card Sales</option>
		<option  value="Fleet_card_sales" >XtraPower Card Sales</option>
		<option  value="Easy_fuel_sales" >Easy Fuel Sales</option>
		<option  value="Cheque_sales" >Cheque Sales</option>
		<?php }  else if($mode == 'Fleet_card_sales') { ?>
		<option selected='selected' value="<?php echo $mode ?>" >XtraPower Card Sales</option>
		<option  value="Cash_sales" >Cash Sales</option>
		<option  value="Indent_sales" >Indent Sales</option>
		<option  value="Credit_card_sales" >Credit Card Sales</option>
		<option  value="Xtra_reward_sales" >XtraReward Card Sales</option>
		<option  value="Easy_fuel_sales" >Easy Fuel Sales</option>
		<option  value="Cheque_sales" >Cheque Sales</option>
		<?php }  else if($mode == 'Easy_fuel_sales') { ?>
		<option selected='selected' value="<?php echo $mode ?>" >Easy Fuel Sales</option>
		<option  value="Cash_sales" >Cash Sales</option>
		<option  value="Indent_sales" >Indent Sales</option>
		<option  value="Credit_card_sales" >Credit Card Sales</option>
		<option  value="Xtra_reward_sales" >XtraReward Card Sales</option>
		<option  value="Fleet_card_sales" >XtraPower Card Sales</option>
		<option  value="Cheque_sales" >Cheque Sales</option>
		<?php }  else if($mode == 'Cheque_sales') { ?>
		<option selected='selected' value="<?php echo $mode ?>" >Cheque Sales</option>
		<option  value="Cash_sales" >Cash Sales</option>
		<option  value="Indent_sales" >Indent Sales</option>
		<option  value="Credit_card_sales" >Credit Card Sales</option>
		<option  value="Xtra_reward_sales" >XtraReward Card Sales</option>
		<option  value="Fleet_card_sales" >XtraPower Card Sales</option>
		<option  value="Easy_fuel_sales" >Easy Fuel Sales</option>
		 	<?php }?> </select>
	</td>

<?php if($row->sale_mode == 'Indent_sales'){

	print("<td id='indent_no1' style='display:block'>Indent Number</td>");
	print("<td id='indent_no2' style='display:block'><input name='indent_no' id='indent_no' type='text' style='width:100px;height:20px;' value=' $row->indent_no' onblur='opener.check_indent_no(this.value)'></td>");
	print("</tr><tr id='custid_row'>");
	print("<td  id='cust_id1'>Customer Id</td>");
	print("<td  id='cust_id2'><input name='cust_id' id='cust_id' type='text' style='width:100px;height:20px;' value='$row->cust_id'></td>");
	print("<td style='width:0px'></td>");
	print("<td style='width:100px' align='right'><p id='indent' style='color:#ff0000;'></p></td>");
	print("</tr>");
	print("<tr style=''>");
	print("<td style='' >Reference No</td>");
	print("<td style='' ><input name='ref_no' id='ref_no' type='text' style='width:100px;height:20px;' value='$row->reference_no'></td>");
	print("</tr>");
 }else {

	print("<td style='display:none' id='indent_no1'>Indent Number</td>");
	print("<td style='display:none' id='indent_no2'><input name='indent_no' id='indent_no' type='text' style='width:100px;height:20px;' value='$row->indent_no' onblur='opener.check_indent_no(this.value)'></td>");
	print("</tr><tr id='custid_row' style='display:none;'>");
	print("<td  id='cust_id1'>Customer Id</td>");
	print("<td  id='cust_id2'><input name='cust_id' id='cust_id' type='text' style='width:100px;height:20px;' value=''></td>");
	print("<td style='width:0px'></td>");
	print("<td style='width:100px' align='right'><p id='indent' style='color:#ff0000;'></p></td>");
	print("</tr>"); 
	print("<tr style='display:none;'>");
	print("<td style='' >Reference No</td>");
	print("<td style='' ><input name='ref_no' id='ref_no' type='text' style='width:100px;height:20px;' value='$row->reference_no'></td>");
	print("</tr>");
 }
 
if($row->sale_mode == 'Cheque_sales'){
	print("<tr id='chequeno_row' style=''>");
	print("<td id='cheque_no1' style=''>Cheque Number</td>");
	print("<td id='cheque_no2' style=''><input name='cheque_no' id='cheque_no' type='text' style='width:100px;height:20px;' value='$row->cheque_no' onblur='opener.check_indent_no(this.value)'></td>");
	print("<td style='' id='bank_name1'>Bank Name</td>");
	print("<td style='' id='bank_name2'><input name='bank_name' id='bank_name' type='text' style='width:100px;height:20px;' value='$row->bank_name'></td>");
	print("</tr><tr id='chequedate_row' style=''>");
	print("<td style=''>Cheque Date</td>");
	print("<td style=''><input name='cheque_date' id='cheque_date' type='text' style='width:100px;height:20px;' value='$row->cheque_date'></td>");
	print("<td>Cheque Status</td><td >"); ?>
	<select name='<?php echo "chequestatus"?>' id='<?php echo "chequestatus"?>' onchange='opener.update_chequestatus(this.value)' <?php if($row->payment_mode=='CASH') echo "disabled" ?> >
				<option value='NOT_CLEARED' <?php if($row->cheque_status=='NOT_CLEARED') echo "selected"?> >NOT CLEARED</option>
				<option value='CLEARED' <?php if($row->cheque_status=='CLEARED') echo "selected"?> >CLEARED</option>
				<option value='BOUNCED' <?php if($row->cheque_status=='BOUNCED') echo "selected"?> >BOUNCED</option>
		</select>	
	<?php
	print("</td>");
	print("</tr>");
	print("<tr id='clearancedate_row' style=''><td></td><td></td>");
	print("<td style=''>Clearance Date</td>");
	if($row->cheque_status=='CLEARED'){
		print("<td style='' ><input name='clearance_date' id='clearance_date' type='text'  style='width:100px;height:20px;' value='$row->clearance_date' onchange='javascript:opener.update_clearancedate(this.value)'></td>");
	}
	else{
		print("<td style='' ><input name='clearance_date' id='clearance_date' type='text' disabled style='width:100px;height:20px;' value='$row->clearance_date' onchange='javascript:opener.update_clearancedate(this.value)'></td>");
	}
	print("</tr>");
	
 }else {
	print("<tr id='chequeno_row' style='display:none;'>");
	print("<td style='' id='cheque_no1'>Cheque Number</td>");
	print("<td style='' id='cheque_no2'><input name='cheque_no' id='cheque_no' type='text' style='width:100px;height:20px;' value='$row->cheque_no' onblur='opener.check_indent_no(this.value)'></td>");
	print("<td style='' id='bank_name1'>Bank Name</td>");
	print("<td style='' id='bank_name2'><input name='bank_name' id='bank_name' type='text' style='width:100px;height:20px;' value=''></td>");
	print("</tr><tr id='chequedate_row' style='display:none;'>");
	print("<td >Cheque Date</td>");
	print("<td ><input name='cheque_date' id='cheque_date' type='text' style='width:100px;height:20px;' value='$row->cheque_date'></td>");
	print("<td>Cheque Status</td><td >"); ?>
	<select name='<?php echo "chequestatus"?>' id='<?php echo "chequestatus"?>' onchange='opener.update_chequestatus(this.value)' <?php if($row->payment_mode=='CASH') echo "disabled" ?> >
				<option value='NOT_CLEARED' <?php if($row->cheque_status=='NOT_CLEARED') echo "selected"?> >NOT CLEARED</option>
				<option value='CLEARED' <?php if($row->cheque_status=='CLEARED') echo "selected"?> >CLEARED</option>
				<option value='BOUNCED' <?php if($row->cheque_status=='BOUNCED') echo "selected"?> >BOUNCED</option>
		</select>	
	<?php
	
	print("</td>");
	print("</tr>");
	print("<tr id='clearancedate_row' style='display:none;'><td></td><td></td>");
	print("<td style=''>Clearance Date</td>");
	print("<td style=''><input name='clearance_date' id='clearance_date' type='text' disabled style='width:100px;height:20px;' value='$row->clearance_date' onchange='javascript:opener.update_clearancedate(this.value)'></td>");
	
	print("</tr>"); 
 }
	?>



</table>

<div style="min-height:140px;height:auto;width:80%;margin:10px 10px 0px 20px;border:0px solid green;border-radius:0px;">
<table border="0" id="billtable" class='billtable' style="width:90%;border-radius:15px;border-collapse:collapse;" class='bill_table' align="center">
	<tr bgcolor='#559999' style='color:white;' align="center">
		<td>Item Name</td>
		<td>Quantity&nbsp;&nbsp;(Ltrs)</td>
		<td>Value&nbsp;&nbsp;(Rs)</td>
		<td>Rate&nbsp;&nbsp;(Rs)</td>
	</tr>
	<?php } } ?>
	
	<?php 
	$count1=0;
	foreach($productdetails as $details) {  
	$count1++;
		if ($count1 == 1){
	print("<tr align='center'>"); 
	    $item="item".$count1; 
	    $qty="qty".$count1; 
	    $rate="rate".$count1; 
	    $value="value".$count1; 
	    $loadid="load".$count1;
		print("<td><select  name='$item' id='$item' style='width:100%;' onblur='opener.get_ratepop(this.value, $count1)'>");
		print("<option value='default'>Select</option>");
	    foreach($productlist as $productlist) { 
		$mas_product=$productlist->product_name;
		$act_product=$details->product;
		if($mas_product==$act_product){
		print("<option selected='selected' value='".$act_product."' > $act_product</option>");
		 } 
		else 
		{
		print("<option  value='".$mas_product."' > $mas_product</option>");
			} 
		
	     }	
	     print("</select></td>");  
	   
		print("<td><input type='text' name='$qty' id='$qty' value='".$details->quantity."' style='text-align:right;width:70px;' onchange='opener.cal_amtpop(this.value,\"".$count1."\")'/></td>");
		print("<td><input type='text' name='$value' id='$value' value='".$details->value."' style='text-align:right;width:70px;' onchange='opener.crt_amtpop(this.value,\"".$count1."\",event)'/></td>
			   <td><input type='text' name='$rate' id='$rate' style='text-align:right;width:70px;background:#f0f0f0;border:1px solid #d0d0d0;' value='".$details->rate."'/><img id='$loadid' src='".base_url()."images/dnameloader.gif'  style='display: none'/></td>");
		?><td><input type="hidden" name="bill_version" id="bill_version" value="<?php echo $details->bill_updated;?>"></td><?php 
		print("</tr>");}
		
		if($count1 >= 2) {
		print("<tr align='center'>"); 
	    $item="item".$count1; 
	    $qty="qty".$count1; 
	    $rate="rate".$count1; 
	    $value="value".$count1; 
	    $loadid="load".$count1;
		print("<td><select  name='$item' id='$item'  style='width:100%;' onblur='opener.get_ratepop(this.value, $count1)'>");
		print("<option value='default'>Select</option>");
	    foreach($products as $product) { 
		$master_product=$product->product_name;
		$actual_product=$details->product;
		if($master_product == $actual_product){
			print("<option selected='selected' value='".$actual_product."' > $actual_product</option>");
		} 
		else 
			{
			print("<option  value='".$master_product."' > $master_product</option>");
			} 
		 } 
		print("</select></td>");  
	   	print("<td><input type='text' name='$qty' id='$qty' value='".$details->quantity."' style='text-align:right;width:70px;' onchange='opener.cal_amtpop(this.value,\"".$count1."\")'/></td>");
		print("<td><input type='text' name='$value' id='$value' value='".$details->value."' style='text-align:right;width:70px;' onchange='opener.crt_amtpop(this.value,\"".$count1."\",event)'/></td>
			   <td><input type='text' name='$rate' id='$rate' style='text-align:right;width:70px;background:#f0f0f0;border:1px solid #d0d0d0;' value='".$details->rate."'/><img id='$loadid' src='".base_url()."images/dnameloader.gif'  style='display: none'/></td>");
		print("</tr>");
		}
		}
		
	 ?>

</table>
<p align="right">
<input type="hidden" name="count" value="<?php echo $count1;?>" id="count" >
<input type="button" value="Add another Row" name="addItem" id="addItem" style="width:120px;margin-right:10px;" onclick="opener.addanotherrow()"/></p></div>
</div>
<p align="left" style="margin-left:445px;">Grand Total&nbsp;&nbsp;(Rs)<input type="text" name="total" id="total" value="<?php  echo $row->total_amt; ?>"  readonly="readonly"  style="width:100px;text-align:right;"/></p>
<input type="hidden" name="old_total" value="<?php echo $row->total_amt;?>" id="old_total" >
