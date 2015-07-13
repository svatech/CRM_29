<div  style="height:70px;background:#8AC5D3;">
<p style="margin-left:80%;padding-top:5px;line-height:0.5em;">User: <b><?php echo $this->session->userdata('admin_user_email');?></b>&nbsp;&nbsp;<img src="../../images/rightarrow1.png" width="10px" height="10px;"/>&nbsp;&nbsp;&nbsp;<strong>
 <a href="<?php echo site_url("logincheck/logout"); ?>" style="color:black;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='black'">Logout</a></strong></p>
<center style="margin-bottom:20px;font-size:20pt;position:inline;">Retail Bill for Sales</center>
 </div>

<div style="height:700px; background:#CEF6F5;margin:20px;border:2px solid black ;border-rius:20px;">
<form name="cashform" id="cashform" method="post" action="<?php echo site_url("sales/cash_form"); ?>" > 
<p style="pding-top:20px;"><span style="font-weight:bolder;padding-left:20px;font-size:20pt;">Bill Information</span><span style="position:inline;padding-left:600px;">Date/Time <input type="text" name="timedisp" id="timedisp" value=""  /></span></p>
<hr width="100%">


<div>
<table style="width:40%;margin-left:60px;padding:0px;float:left;" cellpadding="0" cellspacing="0">

<tr>
	<td>Vehicle No</td>
	<td ><input name="veh_no" id="veh_no" type="text" style="width:200px;height:25px;"></td>
</tr>
<tr>
	<td>Customer Name</td>
	<td ><input name="cust_name" id="cust_name" type="text" style="width:250px;height:25px;"></td>
</tr>
<tr>
	<td>Mobile No</td>
	<td ><input name="mob_no" id="mob_no" type="text" style="width:200px;height:25px;"></td>
</tr>
<tr>
	<td>Pump No</td>
	<td><select name="pump_no" id="pump_no" style="width:200px;height:25px;">
			<option value="default">Select</option>
			<?php foreach($pump_list as $pump){ ?>
			<option value="<?php echo $pump["pump_no"];?>" ><?php echo $pump["pump_no"];?></option>
			<?php } ?>
	</select>
	</td>
</tr>
<tr>
	<td>Counter No</td>
		<td><select name="counterno" id="counterno">
		<option value="one">One</option>
		<option value="two">Two</option>
		<option value="three">Three</option>
		</select>
	</td>
</tr>
</table>
<fieldset style="width:400px;padding:5px;">
<legend >Mode of Sales</legend>
<input type="radio" name="sales_mode" id="ca_sales" value="Cash_sales" checked onclick="javascript:hide_textbox()"> <label for='ca_sales' style="display:inline;font-weight:normal;">Cash Sales(F1)</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="sales_mode" id="in_sales" value="Indent_sales" onclick="javascript:show_textbox()" > <label for='in_sales' style="display:inline;font-weight:normal;">Indent Sales(F2)</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="sales_mode" id="cr_sales" value="Credit_card_sales" onclick="javascript:hide_textbox()"> <label for='cr_sales' style="display:inline;font-weight:normal;">Credit Sales(F3)</label> &nbsp;&nbsp;&nbsp;
<br style="line-height:1.5em;">
<input type="radio" name="sales_mode" id="xr_sales" value="Xtra_reward_sales" onclick="javascript:hide_textbox()"> <label for='xr_sales' style="display:inline;font-weight:normal;">Xtra Reward Sales(F4)</label> &nbsp;&nbsp;&nbsp;
<input type="radio" name="sales_mode" id="fc_sales" value="Fleet_card_sales" onclick="javascript:hide_textbox()"> <label for='fc_sales' style="display:inline;font-weight:normal;">Fleet Card Sales(F5)</label>
</fieldset>
	<?php if(isset($this->session->userdata['shift']))
	{
		$sft=$this->session->userdata['shift'];
	}else 
	{
		$sft=1;	
	}
	?>
<table style="width:35%;margin-left:10px;padding:0px;line-height:1.5em;margin:10px;" cellpadding="0" cellspacing="0">
<tr>
	<td>Shift</td>
	<td><input type="radio" name="shift" id="shift1" value="1" onclick='javascript:sample(this.value)' <?php if($sft==1) echo "checked" ?>/>
	 <label for='shift1' style="display:inline;font-weight:normal;">I shift</label>	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
	 <input type="radio" name="shift" id="shift2" value="2" onclick='javascript:sample(this.value)' <?php if($sft==2) echo "checked" ?> /> <label for='shift2' style="display:inline;font-weight:normal;">II shift</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 <input type="radio" name="shift" id="shift3" value="3" onclick='javascript:sample(this.value)' <?php if($sft==3) echo "checked" ?> /> <label for='shift3' style="display:inline;font-weight:normal;">III shift</label></td>
	
</tr>
<tr>
	<td>KM Reading</td>
	<td><input name="km_rdng" id="km_rdng" type="text"></td>
</tr>

<tr id="indent_box" style="display:none;">
	<td>Indent No</td>
	<td><input name="indent_no" id="indent_no" type="text"></td>
</tr>

</table>
</div>
<input type="hidden" name="count" value="1" id="count" >

<div style="min-height:200px;height:auto;margin:60px 200px 0px 60px;border:2px solid green;border-radius:0px;">
<table border="1" id="billtable" style="width:100%;border-radius:15px;" class='bill_table'>
	<tr>
		<td>Item Name</td>
		<td>Quantity</td>
		<td>Rate</td>
		<td>Value</td>
	</tr>
	
	<tr>
		<td><select name="item1" id="item1" style="width:100%;" onblur="javascript:get_rate(this.value,'1')">
			<option value="default">Select</option>
			<?php foreach($pdt_list as $pdt){ ?>
			<option value="<?php echo $pdt["product_name"];?>" ><?php echo $pdt["product_name"];?></option>
			<?php } ?>
			
			</select>
		</td>
		<td><input type="text" name="qty1" id="qty1" value="0" onchange="javascript:cal_amt(this.value,1)" /></td>
		<td><input type="text" name="rate1" id="rate1" value="0"/></td>
		<td><input type="text" name="val1" id="val1" value="0" onchange="javascript:crt_amt(this.value,1,event)" /></td>
		
	</tr>
</table>
<p align="right">
	<input type="button" value="Add another Row" name="addItem" id="addItem" style="width:150px;margin-right:30px;"onclick="javascript:addrow()"/>
	</p>
</div>
<p align="right" style="margin-right:200px;">Grand Total <input type="text" name="total" id="total" value="0" readonly="readonly" style="width:100px;" onkeypress="runscript(event)"/></p>
<p align="center"><input type="button" value="Print Bill" style="width:70px;" onclick="javascript:cashform_valid()"/></p>
</form>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/cash_sales.js"></script>