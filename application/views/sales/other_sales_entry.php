<script type="text/javascript">
var cust_array=<?php echo json_encode($indent_cust)?>;
var retail_cust_array=<?php echo json_encode($retail_customers)?>;
var truck_array= "";
$(document).ready(function(){
	document.getElementById("cust_name").focus();
});
</script>
<!-- <div  style="height:auto;overflow:hidden;background:#006666;margin:30px;width:1000px;min-height:80px;border:0px solid black ;border-radius:10px;">
<p style="margin-left:80%;padding-top:5px;line-height:1.5em;color:white;">User: <b><?php echo $this->session->userdata('fullname');?></b>&nbsp;&nbsp;<img src="../../images/rightarrow1.png" width="10px" height="10px;"/>&nbsp;&nbsp;&nbsp;<strong>
 <a href="<?php echo site_url("logincheck/logout"); ?>" style="color:white;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='white'">Logout</a></strong></p>
<center style="margin-bottom:20px;font-size:20pt;color:white;position:inline;">Other Products Bill Entry</center>
 </div>
  -->       
<div class='lengthy_form' style='height:auto;'>
<form name="other_sales_entry" id="other_sales_entry" method="post" action="<?php echo site_url("sales/other_sales_form"); ?>" > 
<!-- <p style="padding-top:20px;margin-left:180px"><span style="font-weight:bolder;padding-left:20px;font-size:20pt;">Bill Information</span><span style="position:inline;padding-left:600px;">Account Date <input type="text" name="timedisp" id="timedisp" value=""  /></span> </p>
<hr width="100%">  -->

<?php if(isset($this->session->userdata['counter']))
	{
		$ctr_no=$this->session->userdata['counter'];
	}else 
	{
		$ctr_no='one';	
	}
?>
<div style='width:100%;min-height:350px;height:auto;'>
<div style="float:left;width:40%;">
<p style="height:20px;margin-left:20px;padding:0px 10px 0px 0px;" align="right"><span style="font-size:11pt;color:red;">* Required Fields </span></p>
		
<table  border="0" style="margin-left:60px;padding:0px;float:left;margin:20px;" cellpadding="0" cellspacing="0">
<tr id="indent_cust_row" style="display:none;">
	<td>Indent Customers <font color='red' size='5px'> *</font></td>
	<td><input name="ind_cust_name" id="ind_cust_name" type="text" style="width:200px;height:25px;" >
	</td>
</tr>
<tr id="cust_row">
	<td >Customer Name <font color='red' size='5px'> *</font></td>
	<td ><input name="cust_name" id="cust_name" type="text" value ="" style="width:190px;height:25px;" onblur='get_other_pdts_customer_details(this.value)'></td>
	
</tr>
<tr id="same_name" style="display:none">
	<td>Customer Id</td>
		<td><select name="cust_id" id="cust_id" onchange="" onfocus="this.style.background='#F3F781'" style="width:250px;" onblur="fetch_other_pdts_customer(this.value)">
		
		</select>
	</td>
</tr>
<tr id="indent_box" style="display:none;">
	<td>Indent No <font color='red' size='5px'> *</font></td>
	<td><input name="indent_no" id="indent_no" type="text" style="width:200px;height:25px;" onfocus='checkIndentCust()' onblur="chk_ind_no(this.value)">
	<img id='incorrect' height=16px width=15px style='display: none' src='<?php echo  base_url();?>images/delete.png' /> 
	<img id='correct' height=16px width=15px style='display: none' src='<?php echo  base_url();?>images/accept.png' />
	</td>
</tr>
<tr id='refno_row' style='display:none;'>
	<td>Reference No</td>
	<td ><input name="ref_no" id="ref_no" type="text" style="width:200px;height:25px;" onblur=""></td>
</tr>
<tr>

	<td>Vehicle No <font color='red' size='5px'> *</font></td>
	<td ><input name="veh_no" id="veh_no" type="text" style="width:200px;height:25px;" ></td>
	</tr>
<tr>
	<td id="mbn">Mobile No</td>
	<td ><input name="mob_no" id="mob_no" type="text" maxlength="10" onkeypress="return isNumberKey(event)" style="width:200px;height:25px;" onblur="javascript:focusId('item1')"></td>
	
</tr>

<tr>
	<td>Counter No <font color='red' size='5px'> *</font></td>
		<td><select name="counterno" id="counterno" onchange="javascript:addcounterinsession(this.value)" onfocus="this.style.background='#F3F781'" onblur="this.style.background=''">
		<?php foreach($counters as $counter){ ?>
			<option value="<?php echo $counter["counter"];?>" <?php if($ctr_no==$counter["counter"])echo "selected";?> ><?php echo ucfirst($counter["counter"]);?></option>
			<?php } ?>
		</select>
	</td>
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
	<td>Oil service</td>
	<td><input type="checkbox" name="oil_service"  id="oil_service" onclick="javascript:show_kms()" style="width: 25px;height: 25px;"></td>
</tr>
<tr style="display:none;">
	<td><input type="text" name="Oil_service_status" id="Oil_service_status" value="0"></td>
</tr>

<tr id="show_avg" style="visibility :hidden;">

    <td>Average Km <font color='red' size='5px'> *</font></td>
    <td><input name="avg_km" id="avg_km" type="text" maxlength="10" onkeypress="return isNumberKey(event)" style="width:200px;height:25px;" ></td>	
</tr>
<tr id="show_km" style="visibility :hidden;" >
    <td>Km Reading <font color='red' size='5px'> *</font></td>
    <td><input name="km_reading" id="km_reading" type="text" maxlength="10" onkeypress="return isNumberKey(event)" style="width:200px;height:25px;" ></td>
</tr>
<tr id="show_dob" style="visibility :hidden;" >
    <td>DOB </td>
    <td><input name="oil_service_dob" id="oil_service_dob" type="text" maxlength="10" onkeypress="return isNumberKey(event)" style="width:200px;height:25px; text_align:center" ></td>
</tr>
<tr id="show_wed" style="visibility :hidden;" >
    <td>Wedding Anniversary Date </td>
    <td><input name="oil_service_wedding_date" id="oil_service_wedding_date" type="text" maxlength="10" onkeypress="return isNumberKey(event)" style="width:200px;height:25px; text_align:center" ></td>
</tr>
<tr id='chequeno_row' style='display:none;'>
	<td>Cheque No <font color='red' size='5px'> *</font></td>
	<td><input name="cheque_no" id="cheque_no" type="text" style='width:75px;'> &nbsp;&nbsp;Date&nbsp;&nbsp;&nbsp;<input name="cheque_date" id="cheque_date" type="text" style='width:75px;'></td>
</tr>
<tr id='bankname_row' style='display:none;'>
	<td>Bank Name <font color='red' size='5px'> *</font></td>
	<td><input name="bank_name" id="bank_name" type="text" style="width:200px;height:25px;"></td>
</tr>
</table>
</div>
<div id="" style="width:30%;float:left;">
<table border="1"  height="100%" style='margin:20px;width:80%;'>
<tr  style="border-bottom:.3px solid white;" ><td align="center" style="padding:10px;color:white;font-size:15px;font-weight:bolder;" bgcolor='#006666'>Mode Of Sales</td></tr>
<tr id="cash_row" style="background:#006666;"><td style="padding:5px;" width=""><input type="radio" name="sales_mode" id="ca_sales" value="Cash_sales" checked onclick="javascript:hide_textbox(this.value)" class="radio"> <label for='ca_sales' style="display:inline;font-weight:normal;">F1&nbsp;&nbsp;:&nbsp;&nbsp;Cash Sales</label> </td></tr>
<tr id="indent_row"><td style="padding:8px;color:#006666;"><input type="radio" name="sales_mode" id="in_sales" value="Indent_sales" onclick="javascript:show_textbox(this.value)"  class="radio"> <label for='in_sales' style="display:inline;font-weight:normal;">F2&nbsp;&nbsp;:&nbsp;&nbsp;Indent Sales</label> </td></tr>
<tr id="credit_row"><td style="padding:8px;color:#006666;"> <input type="radio" name="sales_mode" id="cr_sales" value="Credit_card_sales" onclick="javascript:hide_textbox(this.value)"  class="radio"> <label for='cr_sales' style="display:inline;font-weight:normal;">F3&nbsp;&nbsp;:&nbsp;&nbsp;Credit Card Sales</label></td></tr>
<tr id="xtra_row"><td style="padding:8px;color:#006666;"><input type="radio" name="sales_mode" id="xr_sales" value="Xtra_reward_sales" onclick="javascript:hide_textbox(this.value)"  class="radio"> <label for='xr_sales' style="display:inline;font-weight:normal;">F4&nbsp;&nbsp;:&nbsp;&nbsp;XtraReward card Sales</label></td></tr>
<tr id="fleet_row"><td style="padding:8px;color:#006666;"><input type="radio" name="sales_mode" id="fc_sales" value="Fleet_card_sales" onclick="javascript:hide_textbox(this.value)"  class="radio"> <label for='fc_sales' style="display:inline;font-weight:normal;">F5&nbsp;&nbsp;:&nbsp;&nbsp;XtraPower card Sales</label></td></tr>
<tr id="easy_row"><td style="padding:8px;color:#006666;"><input type="radio" name="sales_mode" id="ef_sales" value="Easy_fuel_sales" onclick="javascript:hide_textbox(this.value)"  class="radio"> <label for='ef_sales' style="display:inline;font-weight:normal;">F6&nbsp;&nbsp;:&nbsp;&nbsp;Easy Fuel Sales</label></td></tr>
<tr id="cheque_row"><td style="padding:8px;color:#006666;"><input type="radio" name="sales_mode" id="ch_sales" value="Cheque_sales" onclick="javascript:hide_textbox(this.value)"  class="radio"> <label for='ch_sales' style="display:inline;font-weight:normal;">F7&nbsp;&nbsp;:&nbsp;&nbsp;Cheque Sales</label></td></tr>
</table></div>

<?php if(isset($this->session->userdata['shift']))
	{
		$sft=$this->session->userdata['shift'];
	}else 
	{
		$sft=1;	
	}
?>
<div style="width:30%;float:left;">
<input type='hidden' id='shift' name='shift' />
<input type='hidden' id='acct_date' name='acct_date' />
<table style="width:80%;margin-right:15px;margin-top:20px;margin-left:20px;"  border="1">
<tr style="">
	<td align="center" bgcolor='#006666' style="color:white;font-size:15px;font-weight:bolder;">Shift</td><td id='shift_row' style='font-weight:bold;font-size:15px;'></td></tr>
<tr style="border-bottom:.3px solid white;">
	<td align="center" bgcolor='#006666' style="color:white;font-size:15px;font-weight:bolder;">Account Date</td><td id='acct_date_row' style='font-weight:bold;font-size:15px;'></td></tr>

<!--  <table style="width:35%;margin-left:10px;padding:0px;line-height:1.5em;margin:10px;" cellpadding="0" cellspacing="0">
<tr>
	<td>Shift</td>
	<td><input type="radio" name="shift" id="shift1" value="1" onclick='javascript:addshiftinsession(this.value)' <?php if($sft==1) echo "checked" ?>/> 
	<label for='shift1' style="display:inline;font-weight:normal;">I shift</label>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 <input type="radio" name="shift" id="shift2" value="2" onclick='javascript:addshiftinsession(this.value)' <?php if($sft==2) echo "checked" ?> />
	 <label for='shift2' style="display:inline;font-weight:normal;">II shift</label>
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <input type="radio" name="shift" id="shift3" value="3" onclick='javascript:addshiftinsession(this.value)' <?php if($sft==3) echo "checked" ?>/> 
	  <label for='shift3' style="display:inline;font-weight:normal;">III shift</label></td>
</tr> -->


</table>
<table id='indent_status_tbl' style="width:90%;margin-right:15px;margin-top:20px;display:none;"  border="1">
	<tr align="center" bgcolor='#006666' style='color:white;font-size:15px;font-weight:bolder;'><td colspan='2'>Indent Availability Status</td></tr>
	<tr id='indent_entitled_row' ><td>Entitled (Rs)</td><td id='indent_entitled'></td></tr>
	<tr id='indent_taken_row' ><td>Taken (Rs)</td><td id='indent_taken'></td></tr>
	<tr id='indent_available_row' ><td>Available (Rs)</td><td id='indent_available'></td></tr>
</table>
</div>
</div>
<input type="hidden" name="count" value="1" id="count" >
<div style="width:100%">
<div style="min-height:30%;height:30%;width:60%;margin:0px 0px 0px 10px; display: inline-block;float: left;">
<!--  <div style="min-height:150px;height:auto;margin:200px 200px 0px 100px;" align="center">-->
<table><tr ><td></td><td align='center' >
<table border="0" align="left" id="billtable" style="width:65%;border-radius:15px;margin-left:50px;" class='bill_table'>
<!--  <table border="0" id="billtable" style="width:70%;border-radius:15px;" class='bill_table'> -->
	<tr align="center" bgcolor='#006666' style='color:white;font-size:15px;font-weight:bolder;'>
		<td style='border-right:1px solid green;'>Item Name</td>
		<td style='border-right:1px solid green;'>Quantity&nbsp;&nbsp;</td>
		<td style='border-right:1px solid green;'>Value&nbsp;&nbsp;(Rs)</td>
		<td>Rate&nbsp;&nbsp;(Rs)</td>
	</tr>
	<tr align="center">
		<td style="height:30px"><select name="item1" id="item1" style="width:200px;font-size:17px;" onfocus="this.style.background='#F3F781'" onblur="javascript:get_rate(this.value,'1')">
			<option value="default">Select</option>
			<?php foreach($pdt_list as $pdt){ ?>
			<option value="<?php echo $pdt["product_name"];?>" ><?php echo $pdt["product_name"];?></option>
			<?php } ?>
			
			</select>
		</td>
		<td><input type="text" name="qty1" id="qty1" value="0" onchange="javascript:cal_amt(this.value,1)" onkeydown="addrowbyslash(event)" style="text-align:right;width:70px;font-size:18px;"/></td>
		<td><input type="text" name="val1" id="val1" value="0" onkeyup="javascript:crt_amt(this.value,1,event)" onkeydown="addrowbyslash(event)"  onblur="" style="text-align:right;width:100px;font-size:18px;"/></td>
		<td><input type="text" name="rate1" id="rate1" value="0" readonly="readonly" style='background:#f0f0f0;border:1px solid #d0d0d0;text-align:right;width:70px;font-size:18px;'/></td>
		<td><a href="javascript:addrow()" class="add_link" id="add_link" >
			<img   alt="add_another_row"  src="<?php echo base_url();?>images/plus.png" title='Add Another Row' class="add"  /></a>
		</td>
	</tr>
</table>
<!-- <p align="right">
	<a href="javascript:addrow()" class="add_link" id="add_link">
	<img   alt="add_another_row"  src="<?php echo base_url();?>images/plus.png" title='Add Another row' class="add"  /></a>

	 <input type="button" value="Add another Row" name="addItem" id="addItem" style="width:150px;margin-right:30px;"onclick="javascript:addrow()"/> 
	</p> -->
	</td></tr></table>
</div>

<div style="min-height:30%;height:30%;width:35%;float: right;">

<div id="contentData">
</div>

</div>

</div>

<hr width="100%">
<div style="margin-top:2px;margin-left:280px;display:inline-block;">
<table border="0">
<tr><td><font style="font-size:20px;">Grand Total&nbsp;&nbsp;(Rs)</font></td>
<td> <input type="text" name="total" id="total" value="0" readonly="readonly" style="width:130px;height:30px;font-size:25px;text-align:right;color:#7e2217;font-weight:bold" onkeypress="otherformsubmit(event)"/></td>
<!-- <input type="button" value="Print Bill" style="width:70px;" onclick="javascript:other_sales_form_valid()"/> -->
<td><a href="javascript:other_sales_form_valid()" class="link">
<img   alt="bill_print" id='bill_print' src="<?php echo base_url();?>images/bill_printer1.png" title='Print' class="print"  /></a></td>
</tr></table>
</div>
<?php foreach($customerid as $item){
		$cust= $item->other_pdts_cust_id ;
		$arr=str_split($cust,5);  
 		$sec=$arr[1]+1 ;
		if($sec <10 )
		{
		$sec="000".$sec;
		}else if($sec <100 )
		{
		$sec="00".$sec;
		}else if($sec <1000 )
		{	
		$sec="0".$sec;
		}
 		 $cust_id=$arr[0].$sec;} ?>
 		<input type="hidden" value="<?php echo $cust?>" id="current_custid" name="current_custid" > <input type="hidden" value="<?php echo $cust_id?>" id="next_custid" name="next_custid" >
 		<input type="hidden" name="bill_sms" value="<?php echo $billsms_status->bill_sms; ?>" id="bill_sms" >
 		<input type="hidden" name="rowcount" id="rowcount" value=""  style="width:100px;" />
</form>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/cash_sales.js"></script>