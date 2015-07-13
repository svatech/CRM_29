
<?php 
$count0=0;
foreach($billdetails as $row) { 
$count0++;
if($count0 ==1){ ?>
<div>
<table style="width:80%;margin-left:10px;padding:0px;margin-right:10px;" cellpadding="3" cellspacing="3">

<tr>
	<td>Bill No</td>
	<td ><input name="bill_no" id="bill_no" readonly="readonly" type="text" style="width:100px;height:20px;" value='<?php echo $row->bill_number?>'></td>

	<td>Vehicle No</td>
	<td ><input name="veh_no" id="veh_no" type="text" style="width:100px;height:20px;" value='<?php echo $row->vehicle_number?>'></td>
</tr>
<tr>
	<td>Customer Name</td>
	<td ><input name="cust_name" id="cust_name" type="text" style="width:250px;height:20px;" value='<?php echo $row->customer_name?>' onblur='opener.getVehList(this.value)'></td>
	<td>Mobile No</td>
	<td ><input name="mob_no" id="mob_no" onkeypress="return opener.isNumberKey(event)" type="text" maxlength="10" style="width:100px;height:20px;" value='<?php echo $row->mobile_number?>' onkeyup=""></td>
</tr>


<tr>
	<td>Pump No</td>
	<td><select name="pump_no" id="pump_no" style="width:100px;height:20px;">
		<?php foreach($pumplist as $pumplist) {
		$mas_pump_no=$pumplist['pump_no'];
		$act_pump_no=$row->pump_number;
		if($mas_pump_no==$act_pump_no){?>
		<option selected='selected' value="<?php echo $act_pump_no;?>" ><?php echo $act_pump_no;?></option>
		<?php } 
		else 
		{?>
		<option  value="<?php echo $mas_pump_no;?>" ><?php echo $mas_pump_no;?></option>
			<?php } } ?> </select>
	</td>

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
<td>KM Reading</td>
	<td ><input name="meter_reading" id="meter_reading" type="text" style="width:50px;height:20px;" value='<?php echo $row->km_reading?>'></td>
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
		<option selected='selected' value="<?php echo $mode ?>" >Cheque_sales</option>
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
	print("</tr><tr id='custid_row' style=''>");
	print("<td style='' id='cust_id1'>Customer Id</td>");
	print("<td style='' id='cust_id2'><input name='cust_id' id='cust_id' type='text' style='width:100px;height:20px;' value='$row->cust_id'></td>");
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
	print("<td style='' id='cust_id1'>Customer Id</td>");
	print("<td style='' id='cust_id2'><input name='cust_id' id='cust_id' type='text' style='width:100px;height:20px;' value=''></td>");
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
	print("<td><input name='cheque_date' id='cheque_date' type='text' style='width:100px;height:20px;' value='$row->cheque_date'></td>");
	print("<td>Cheque Status</td><td>"); ?>
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

<div style="min-height:140px;height:auto;width:80%;margin:10px 10px 0px 20px;">
<table border="0" id="billtable" class='billtable' style="width:80%;border-radius:15px;border-collapse:collapse;" class='bill_table' align="center">
	<tr bgcolor='#559999' style='color:white;' align="center">
		<td >Item Name</td>
		<td>Quantity&nbsp;&nbsp;(Ltrs)</td>
		<td>Value&nbsp;&nbsp;(Rs)</td>
		<td>Rate&nbsp;&nbsp;(Rs)</td>
	</tr>
	<?php } } ?>
	
	<?php 
	$count1=0;
	foreach($productdetails as $details) {  
		if($details->product !='2TOIL_LOOSE'){
	$count1++;
		if ($count1 == 1 ){?>
	<tr align="center"> 
	   <?php $item="item".$count1; ?>
	   <?php $qty="qty".$count1; ?>
	   <?php $rate="rate".$count1; ?>
	   <?php $value="value".$count1; ?>
	   <?php $load="load".$count1; ?>
		<td><select  name="<?php echo $item;?>" id="<?php echo $item; ?>" style="width:100%;" onblur="opener.get_ratepop(this.value,<?php echo $count1 ;?>)">
	<option value="default">Select</option>
	   <?php foreach($productlist as $productlist) { ?>	
	<?php 
	
		$mas_product=$productlist->product_name;
		$act_product=$details->product;
		if($mas_product==$act_product){?>
		<option selected='selected' value="<?php echo $act_product;?>" ><?php echo $act_product?></option>
		<?php } 
		else 
		{?>
		<option  value="<?php echo $mas_product;?>" ><?php echo $mas_product?></option>
			<?php } } ?>
			
			</select>
		</td><td><input type="text" name="<?php echo $qty;?>" id="<?php echo $qty;?>" value="<?php echo $details->quantity;?>" onchange="opener.cal_amtpop(this.value,<?php echo $count1 ;?>)" style="text-align:right;width:70px;"/></td>
		<td><input type="text" name="<?php echo $value;?>" id="<?php echo $value;?>" value="<?php echo $details->value;?>" onchange="opener.crt_amtpop(this.value,<?php echo $count1;?>,event)" style="text-align:right;width:70px;"/></td>
		<td><input type="text" name="<?php echo $rate;?>" id="<?php echo $rate;?>" value="<?php echo $details->rate;?>" readonly='readonly' style="background:#f0f0f0;border:1px solid #d0d0d0;text-align:right;width:70px;" /><img id='<?php echo $load;?>' src='../../images/dnameloader.gif'  style='display: none'/></td>
		<td><input type="hidden" name="bill_version" id="bill_version" value="<?php echo $details->bill_updated;?>"></td>
	</tr><?php  }?>
	<?php if ($count1 >= 2 ){?>
	<tr align="center"> 
		<?php $item="item".$count1; ?>
	   <?php $qty="qty".$count1; ?>
	   <?php $rate="rate".$count1; ?>
	   <?php $value="value".$count1; ?>
	   <?php $load="load".$count1; ?>
	
		<td><select name="<?php echo $item?>" id="<?php echo $item;?>" style="width:100%;" onchange="opener.get_ratepop(this.value,<?php echo $count1 ;?>)">
		<option value="default">Select</option>
	<?php 
	
		$act_product=$details->product;
		if($act_product== 'PETROL'){?>
		<option selected='selected' value="<?php echo $act_product;?>" ><?php echo $act_product?></option>
		<option  value="DIESEL" >DIESEL</option>
		<option  value="XTRA_MILE" >XTRA MILE</option>	
		<option  value="XTRA_PERMIUM" >XTRA PREMIUM</option>
		<?php } 
		else if($act_product== 'DIESEL')
		{?>
		<option selected='selected' value="<?php echo $act_product;?>" ><?php echo $act_product?></option>
		<option  value="PETROL" >PETROL</option>
		<option  value="XTRA_MILE" >XTRA MILE</option>	
		<option  value="XTRA_PERMIUM" >XTRA PREMIUM</option>
		<?php }   else if($act_product== 'XTRA_MILE')
		{?>
		<option selected='selected' value="<?php echo $act_product;?>" ><?php echo $act_product?></option>
		<option  value="PETROL" >PETROL</option>
		<option  value="DIESEL" >DIESEL</option>	
		<option  value="XTRA_PERMIUM" >XTRA PREMIUM</option>
		<?php }  
		else if($act_product== 'XTRA_PERMIUM')
		{?>
		<option selected='selected' value="<?php echo $act_product;?>" ><?php echo $act_product?></option>
		<option  value="PETROL" >PETROL</option>
		<option  value="XTRA_MILE" >XTRA MILE</option>	
		<option  value="DIESEL" >DIESEL</option>
		<?php }  ?>
			</select>
		</td> <td><input type="text"  name="<?php echo $qty;?>" id="<?php echo $qty;?>" value="<?php echo $details->quantity;?>" onchange="opener.cal_amtpop(this.value,<?php echo $count1 ;?>)" style="text-align:right;width:70px;"/></td>
		<td><input type="text" name="<?php echo $value;?>" id="<?php echo $value;?>" value="<?php echo $details->value;?>" onchange="opener.crt_amtpop(this.value,<?php echo $count1 ;?>,event)" style="text-align:right;width:70px;"/></td>
		<td><input type="text" name="<?php echo $rate;?>" id="<?php echo $rate;?>" value="<?php echo $details->rate;?>" readonly='readonly' style="background:#f0f0f0;border:1px solid #d0d0d0;text-align:right;width:70px;" /><img id='<?php echo $load;?>' src='../../images/dnameloader.gif'  style='display: none'/></td>
	</tr> 
	<?php  }}  ?>

<?php } ?>

</table>
<table border="0"  style="width:80%;border-radius:15px;border-collapse:collapse;"  align="center">
<tr bgcolor='#559999' style='color:white;' align="center">
		<td >2T Oil Pump No</td>
		<td>Quantity&nbsp;&nbsp;(Ltrs)</td>
		<td>Value&nbsp;&nbsp;(Rs)</td>
		<td>Rate&nbsp;&nbsp;(Rs)</td>
	</tr>
	<?php $twotcount=0; 
	foreach($productdetails as $details) {  
		if($details->product =='2TOIL_LOOSE'){
			$twotcount++; ?>
	<tr align="center">
		<td><select name='2toilpump' id='2toilpump' style="width:100%;" onchange="opener.get_2toilratepop('2TOIL_LOOSE')">
		<option value='default'>Select</option>
		<?php foreach ($twotpumplist as $pump){?>
		<option value='<?php echo $pump['pump_no']?>' <?php if($row->twotoil_pump == $pump['pump_no']) echo "selected";?> ><?php echo $pump['pump_no']?></option>
		<?php } ?>
		</select>
		</td>
		<td><input type="text" name="twotoilqty" id="twotoilqty" value="<?php echo $details->quantity;?>" onchange="opener.cal_twotoilamtpop(this.value)" style="text-align:right;width:70px;"/></td>
		<td><input type="text" name="twotoilval" id="twotoilval" value="<?php echo $details->value;?>" onchange="opener.crt_twotoilamtpop(this.value)" style="text-align:right;width:70px;"/></td>
		<td><input type="text" name="twotoilrate" id="twotoilrate" value="<?php echo $details->rate;?>" readonly='readonly' style="background:#f0f0f0;border:1px solid #d0d0d0;text-align:right;width:70px;" /></td>
	</tr>
	<?php }
	} if($twotcount==0){?>
	<tr align="center">
		<td><select name='2toilpump' id='2toilpump' style="width:100%;" onchange="opener.get_2toilratepop('2TOIL_LOOSE')">
		<option value='default'>Select</option>
		<?php foreach ($twotpumplist as $pump){?>
		<option value='<?php echo $pump['pump_no']?>' ><?php echo $pump['pump_no']?></option>
		<?php } ?>
		</select>
		</td>
		<td><input type="text" name="twotoilqty" id="twotoilqty" value="0" onchange="opener.cal_twotoilamtpop(this.value)" style="text-align:right;width:70px;"/></td>
		<td><input type="text" name="twotoilval" id="twotoilval" value="0" onchange="opener.crt_twotoilamtpop(this.value)" style="text-align:right;width:70px;"/></td>
		<td><input type="text" name="twotoilrate" id="twotoilrate" value="0" readonly='readonly' style="background:#f0f0f0;border:1px solid #d0d0d0;text-align:right;width:70px;" /></td>
	</tr>
	<?php } ?>
</table>
<p align="right">
<input type="hidden" name="count" value="<?php echo $count1;?>" id="count" >
<input type="button" value="Add another Row" name="addItem" id="addItem" style="width:120px;margin-right:10px;" class="button" onclick="opener.addanotherrow()"/></p></div>
</div>
<p align="left" style="margin-left:445px;">Grand Total&nbsp;&nbsp;(Rs)<input type="text" name="total" id="total" value="<?php  echo $row->total_amount; ?>"  readonly="readonly"  style="width:100px;text-align:right;"/></p>
<input type="hidden" name="old_total" value="<?php echo $row->total_amount;?>" id="old_total" >
