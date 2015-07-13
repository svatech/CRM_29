<script type="text/javascript">
var cust_array=<?php echo json_encode($indent_cust)?>;
var truck_array=<?php echo json_encode($retail_trucks)?>;
var retail_cust_array = ""
	$(document).ready(function(){
		document.getElementById("veh_no").focus();
	});
</script>
<!-- <div  style="height:auto;overflow:hidden;background:#006666;margin:30px;width:95%;min-width:800px;min-height:80px;border:0px solid black ;border-radius:10px;">
<p style="margin-left:80%;padding-top:5px;line-height:1.5em;color:white;">User: <b><?php echo $this->session->userdata('fullname');?></b>&nbsp;&nbsp;<img src="../../images/rightarrow1.png" width="10px" height="10px;"/>&nbsp;&nbsp;&nbsp;<strong>
 <a href="<?php echo site_url("logincheck/logout"); ?>" style="color:white;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='white'">Logout</a></strong></p>
<center style="margin-bottom:20px;font-size:20pt;color:white;position:inline;">Petrol/Diesel Bill Entry</center>
 </div> -->
<div class='lengthy_form' style='height:auto;'>
<form name="cashform" id="cashform" method="post" action="<?php echo site_url("sales/cash_form"); ?>" > 
<!-- <p style="padding-top:20px;margin-left:180px"><span style="font-weight:bolder;padding-left:20px;font-size:20pt;">Bill Information</span><span style="position:inline;padding-left:600px;">Account Date <input type="text" name="timedisp" id="timedisp" value=""  /></span> </p>
<hr width="100%">  -->

<div style='width:100%;min-height:350px;height:50%;'>
<div style="float:left;width:40%;">
<?php if(isset($this->session->userdata['counter']))
	{
		$ctr_no=$this->session->userdata['counter'];
	}else 
	{
		$ctr_no='one';	
	}
?>
<p style="height:20px;margin-left:20px;padding:0px 10px 0px 0px;" align="right"><span style="font-size:11pt;color:red;">* Required Fields </span></p>
<table border="0" style="margin-left:60px;padding:0px;float:left;margin:20px;height:100%;" cellpadding="0" cellspacing="0">
<tr id="indent_cust_row" style="display:none;">
	<td>Indent Customers <font color='red' size='5px'> *</font></td>
	<td><input name="ind_cust_name" id="ind_cust_name" type="text" style="width:200px;height:25px;" >
	</td>
	
</tr>
<tr>
	<td>Vehicle No <font color='red' size='5px'> *</font></td>
	<td ><input name="veh_no" id="veh_no" type="text" style="width:200px;height:25px;" class="" onfocus='checkIndentCust()' onblur='get_retail_customer_details(this.value)'></td>
	
</tr>
<tr id="cust_row" style="">
	<td width="">Customer Name <font color='red' size='5px'> *</font></td>
	<td ><input name="cust_name" id="cust_name" type="text" style="width:200px;height:25px;"></td>
	
</tr>
<tr id="indent_box" style="display:none;">
	<td>Indent No <font color='red' size='5px'> *</font></td>
	<td> <input name="indent_no" id="indent_no" type="text" style="width:200px;height:25px;" onblur="chk_ind_no(this.value)">
	<img id='incorrect' height=16px width=15px style='display: none' src='<?php echo  base_url();?>images/delete.png' /> 
	<img id='correct' height=16px width=15px style='display: none' src='<?php echo  base_url();?>images/accept.png' /></td>
	
</tr>
<tr id='refno_row' style='display:none;'>
	<td>Reference No</td>
	<td ><input name="ref_no" id="ref_no" type="text" style="width:200px;height:25px;" onblur=""></td>
</tr>
<tr>
	<td>Mobile No</td>
	<td ><input name="mob_no" id="mob_no" type="text" maxlength="10" onkeypress="return isNumberKey(event)" style="width:200px;height:25px;" onblur="changefocus_topump()"></td>
	
</tr>

<tr id='chequeno_row' style='display:none;'>
	<td>Cheque No <font color='red' size='5px'> *</font></td>
	<td><input name="cheque_no" id="cheque_no" type="text" style='width:75px;'> &nbsp;&nbsp;Date&nbsp;&nbsp;&nbsp;<input name="cheque_date" id="cheque_date" type="text" style='width:75px;'></td>
</tr>
<tr id='bankname_row' style='display:none;'>
	<td>Bank Name <font color='red' size='5px'> *</font></td>
	<td><input name="bank_name" id="bank_name" type="text" style="width:200px;height:25px;"></td>
</tr>
<tr>
<td>Counter No <font color='red' size='5px'> *</font></td>
		<td><select name="counterno" id="counterno"  onchange="javascript:addcounterinsession(this.value)">
		<option value="">Select</option>
	<?php foreach($counters as $counter){ ?>
			<option value="<?php echo $counter["counter"];?>" <?php if($ctr_no==$counter["counter"])echo "selected";?> ><?php echo ucfirst($counter["counter"]);?></option>
			<?php } ?>
		</select>
	</td>
	
</tr>
<tr>
	<td>Pump No <font color='red' size='5px'> *</font></td>
	<td><select name="pump_no" id="pump_no" style="width:200px;height:25px;" onfocus="this.style.background='#F3F781'">
		
	</select>
	</td>
	
</tr>
<tr>
	<td>KM Reading</td>
	<td><input name="km_rdng" id="km_rdng" type="text"></td>
</tr>


</table>
</div>
<?php if(isset($this->session->userdata['shift']))
	{
		$sft=$this->session->userdata['shift'];
	}else 
	{
		$sft=1;	
	}
?>
<div id="" style="float:left;width:30%;">
<table border="1"  style='margin:20px;width:80%;' height="100%">
<tr  style="border-bottom:.3px solid white;" ><td align="center" style="padding:10px;color:white;font-size:15px;font-weight:bolder;" bgcolor='#006666'>Mode Of Sales</td></tr>
<tr id="cash_row" style="background:#006666;"><td style="padding:5px;color:#006666; width=""><input type="radio" name="sales_mode" id="ca_sales" value="Cash_sales" checked onclick="javascript:hide_textbox(this.value)" class="radio"> <label for='ca_sales' style="display:inline;font-weight:normal;">F1&nbsp;&nbsp;:&nbsp;&nbsp;Cash Sales</label> </td></tr>
<tr id="indent_row"><td style="padding:8px;color:#006666;"><input type="radio" name="sales_mode" id="in_sales" value="Indent_sales" onclick="javascript:show_textbox(this.value)"  class="radio"> <label for='in_sales' style="display:inline;font-weight:normal;">F2&nbsp;&nbsp;:&nbsp;&nbsp;Indent Sales</label> </td></tr>
<tr id="credit_row"><td style="padding:8px;color:#006666;"> <input type="radio" name="sales_mode" id="cr_sales" value="Credit_card_sales" onclick="javascript:hide_textbox(this.value)"  class="radio"> <label for='cr_sales' style="display:inline;font-weight:normal;">F3&nbsp;&nbsp;:&nbsp;&nbsp;Credit Card Sales</label></td></tr>
<tr id="xtra_row"><td style="padding:8px;color:#006666;"><input type="radio" name="sales_mode" id="xr_sales" value="Xtra_reward_sales" onclick="javascript:hide_textbox(this.value)"  class="radio"> <label for='xr_sales' style="display:inline;font-weight:normal;">F4&nbsp;&nbsp;:&nbsp;&nbsp;XtraReward Card Sales</label></td></tr>
<tr id="fleet_row"><td style="padding:8px;color:#006666;"><input type="radio" name="sales_mode" id="fc_sales" value="Fleet_card_sales" onclick="javascript:hide_textbox(this.value)"  class="radio"> <label for='fc_sales' style="display:inline;font-weight:normal;">F5&nbsp;&nbsp;:&nbsp;&nbsp;XtraPower Card Sales</label></td></tr>
<tr id="easy_row"><td style="padding:8px;color:#006666"><input type="radio" name="sales_mode" id="ef_sales" value="Easy_fuel_sales" onclick="javascript:hide_textbox(this.value)"  class="radio"> <label for='ef_sales' style="display:inline;font-weight:normal;">F6&nbsp;&nbsp;:&nbsp;&nbsp;Easy Fuel Sales</label></td></tr>
<tr id="cheque_row"><td style="padding:8px;color:#006666;"><input type="radio" name="sales_mode" id="ch_sales" value="Cheque_sales" onclick="javascript:hide_textbox(this.value)"  class="radio"> <label for='ch_sales' style="display:inline;font-weight:normal;">F7&nbsp;&nbsp;:&nbsp;&nbsp;Cheque Sales</label></td></tr>
</table>
</div>
<div style="width:30%;float:left;" >
<input type='hidden' id='shift' name='shift' />
<input type='hidden' id='acct_date' name='acct_date' />
<table style="width:80%;margin-right:15px;margin-top:20px;margin-left:20px;"  border="1">
<tr style="border-bottom:.3px solid white;">
	<td align="center" bgcolor='#006666' style="color:white;font-size:15px;font-weight:bolder;">Shift</td><td id='shift_row' style='font-weight:bold;font-size:15px;'></td></tr>
<tr style="border-bottom:.3px solid white;">
	<td align="center" bgcolor='#006666' style="color:white;font-size:15px;font-weight:bolder;">Account Date</td><td id='acct_date_row' style='font-weight:bold;font-size:15px;'></td></tr>
	<!-- <tr style="<?php if($sft==1)
	{ 
		echo 'background:##006666';
	} else
	{
		echo'background:none';
	} ?>" id="shift1_row"><td align="center"><input class="radio" type="radio" name="shift" id="shift1" value="1" onclick='javascript:addshiftinsession(this.value)' <?php if($sft==1) echo "checked" ?>/> 
	<label for='shift1' style="display:inline;font-weight:normal;">I shift</label></td></tr>
	 
	<tr style="<?php if($sft==2)
	{ 
		echo 'background:#006666';
	} else
	{
		echo'background:none';
	} ?>""><td align="center" id="shift2_row"><input class="radio" type="radio" name="shift" id="shift2" value="2" onclick='javascript:addshiftinsession(this.value)' <?php if($sft==2) echo "checked" ?>/> 
	<label for='shift2' style="display:inline;font-weight:normal;">II shift</label> </td></tr>
	
	<tr style="<?php if($sft==3)
	{ 
		echo 'background:#006666';
	} else
	{
		echo'background:none';
	} ?>"">
	<td align="center" id="shift3_row"><input class="radio" type="radio" name="shift" id="shift3" value="3" onclick='javascript:addshiftinsession(this.value)' <?php if($sft==3) echo "checked" ?> /> 
	<label for='shift3' style="display:inline;font-weight:normal;">III shift</label></td>
</tr>
 -->
</table>

<table id='indent_status_tbl' style="width:90%;margin-right:15px;margin-top:20px;display:none;"  border="1">
	<tr align="center" bgcolor='#006666' style='color:white;font-size:15px;font-weight:bolder;'><td colspan='2'>Indent Availability Status</td></tr>
	<tr id='indent_entitled_row'><td>Entitled (Rs)</td><td id='indent_entitled'></td></tr>
	<tr id='indent_taken_row'><td>Taken (Rs)</td><td id='indent_taken'></td></tr>
	<tr id='indent_available_row'><td>Available (Rs)</td><td id='indent_available'></td></tr>
</table>

<table style="width:80%;margin-right:15px;margin-top:20px;margin-left:20px;"  border="1">
	<tr align="center" bgcolor='#006666' style='color:white;font-size:15px;font-weight:bolder;'><td colspan='2'>RFID Read Vehicles</td></tr>
	<?php foreach($rfid_vehicles as $obj){ ?>
	<tr id='<?php echo $obj["vehicle_no"];?>' onclick="javascript:get_veh_info(this.id)"><td colspan='2'><?php echo $obj["vehicle_no"];?></td></tr>
	<?php }?>
</table>

</div>

</div>


<div style="width:100%">
<div style="min-height:30%;height:30%;width:60%;display: inline-block;float: left;">
<table><tr ><td></td><td align='center' >
<table border="0" align="left" id="billtable" style="width:60%;border-radius:15px;margin-left:50px;" class='bill_table'>
	<tr bgcolor='#006666' style='color:white;font-size:15px;font-weight:bolder;' align="center" >
		<td>Item Name</td>
		<td >Quantity&nbsp;&nbsp;(Ltrs)</td>
		<td >Value&nbsp;&nbsp;(Rs)</td>
		<td >Rate&nbsp;&nbsp;(Rs)</td>
		
	</tr>
	
	<tr style="padding:0px;">
		<td align="center"><select name="item1" id="item1" style="width:200px;font-size:17px;" onfocus="this.style.background='#F3F781'" onblur="javascript:get_rate(this.value,'1') ">
			<option value="default">Select</option>
			<?php foreach($pdt_list as $pdt){ ?>
			<option value="<?php echo $pdt["product_name"];?>" ><?php echo $pdt["product_name"];?></option>
			<?php } ?>
			
			</select>
		</td>
		<td align="center"><input type="text" name="qty1" id="qty1" value="0" style="text-align:right;width:70px;font-size:18px;" onkeyup="javascript:cal_amt(this.value,1)" onkeydown="addrowbyslash(event)"/></td>
		<td align="center"><input type="text" name="val1" id="val1" value="0" style="text-align:right;width:100px;font-size:18px;" onblur="" onkeyup="javascript:crt_amt(this.value,1,event)" onkeydown="addrowbyslash(event)"/></td>
		<td align="center"><input type="text" name="rate1" id="rate1" value="0" style="text-align:right;width:70px;font-size:18px;background:#f0f0f0;border:1px solid #d0d0d0" readonly='readonly'  /></td>
		<td><a href="javascript:addrow()" class="add_link" id="add_link" >
			<img   alt="add_another_row"  src="<?php echo base_url();?>images/plus.png" title='Add Another Row' class="add"  /></a>
		</td>
		</tr>
</table>
</td></tr>
<tr><td></td>
<td align='center'>
<table border="0" align="left"  style="width:60%;border-radius:15px;margin-left:50px;" id='twotoil_table'>
	<tr bgcolor='#006666' style='color:white;font-size:15px;font-weight:bolder;' align="center" >
		<td>2T Oil Pump No</td>
		<td >Quantity&nbsp;&nbsp;(Ltrs)</td>
		<td >Value&nbsp;&nbsp;(Rs)</td>
		<td >Rate&nbsp;&nbsp;(Rs)</td>
		<td></td>
	</tr>
	
	<tr style="padding:0px;">
		<td align="center">
			<select name="2toilpump" id="2toilpump" style="width:200px;font-size:17px;" onfocus="this.style.background='#F3F781'" onblur="javascript:get_2toil_rate(this.value)">
			<option value="default">Select</option>
			
			
			</select>
		</td>
		<td align="center"><input type="text" name="2toilqty" id="2toilqty" value="0" style="text-align:right;width:70px;font-size:18px;" onkeyup="javascript:cal_amt_2toil(this.value)" onkeydown="addrowbyslash(event)"/></td>
		<td align="center"><input type="text" name="2toilval" id="2toilval" value="0" style="text-align:right;width:100px;font-size:18px;" onblur="" onkeyup="javascript:crt_amt_2toil(this.value)" onkeydown="addrowbyslash(event)"/></td>
		<td align="center"><input type="text" name="2toilrate" id="2toilrate" value="0" style="text-align:right;width:70px;font-size:18px;background:#f0f0f0;border:1px solid #d0d0d0" readonly='readonly'  /></td>
		<td>
			
		</td>
		</tr>
</table>
</td></tr></table>
</div >



<div style="min-height:30%;height:30%;width:30%;float: right;">
<div id="contentData">
</div>
</div>

</div>

<hr width="100%">
<div style="margin-top:2px;margin-left:280px;display:inline-block;">
<table border="0">
<tr><td><font style="font-size:20px;">Grand Total&nbsp;&nbsp;(Rs)</font></td>
<td> <input type="text" name="total" id="total" value="0" readonly="readonly" style="width:130px;height:30px;font-size:25px;color:#7e2217;font-weight:bold;text-align:right;" onkeypress="formsubmit(event)"/></td>
<!-- <input type="button" value="Print Bill" style="width:70px;" onclick="javascript:cashform_valid()"/> -->
<td><a href="javascript:cashform_valid()" class="link">
<img   alt="bill_print" id='bill_print' src="<?php echo base_url();?>images/bill_printer1.png" title='Print' class="print"  /></a></td>
</tr></table>
</div>
<input type="hidden" name="count" value="1" id="count" >
<input type="hidden" name="bill_sms" value="<?php echo $billsms_status->bill_sms; ?>" id="bill_sms" >
<input type="hidden" name="rowcount" id="rowcount" value=""  style="width:100px;" />
</form>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/cash_sales.js"></script>