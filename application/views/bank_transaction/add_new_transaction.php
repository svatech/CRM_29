<!-- <div  style="height:auto;overflow:hidden;background:#006666;margin:30px;width:1000px;min-height:80px;border:0px solid black ;border-radius:10px;">
<p style="margin-left:80%;padding-top:5px;line-height:0.5em;color:white;">User: <b><?php echo $this->session->userdata('fullname');?></b>&nbsp;&nbsp;<img src="../../images/rightarrow1.png" width="10px" height="10px;"/>&nbsp;&nbsp;&nbsp;<strong>
 <a href="<?php echo site_url("logincheck/logout"); ?>" style="color:white;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='white'">Logout</a></strong></p>
<center style="margin-bottom:20px;font-size:20pt;color:white;position:inline;">Add New Transaction</center>
 </div>
  -->
<div class='short_form'>
<form name="testform" id="testform" method="post" action="" > 
<!-- <p style="padding-top:20px;margin-left:180px"><span style="font-weight:bolder;padding-left:20px;font-size:20pt;">Bill Information</span><span style="position:inline;padding-left:600px;">Account Date <input type="text" name="timedisp" id="timedisp" value=""  /></span> </p>
<hr width="100%">  -->
<div style="margin:10px 0px 0px 0px;" >
<p style="height:20px;margin-left:20px;padding:0px 30px 0px 0px;" align="right"><span style="font-size:11pt;color:red;">* Required Fields </span></p>
<table border="0" style="width:90%;margin-left:10%;padding:0px;float:left;margin-top:20px;" cellpadding="0" cellspacing="0">
<tr style='font-size:15px;'>
<td>Transaction Type <font color='red' size='5px'> *</font></td>
	<td align='left'><select name='trans_type' id='trans_type' onchange='javascript:check_trans(this.value)'>
	<option value='CASH' >SHIFT AMOUNT-CASH DEPOSIT</option>
	<option value='CREDIT'>CREDIT CARD SALES CLEARANCE</option>
	<option value='FLEET'>XTRAPOWER CARD SALES CLEARANCE</option>
	<option value='XTRAREWARD'>XTRAREWARD CARD SALES CLEARANCE</option>
	<option value='EASYFUELS'>EASYFUELS CARD SALES CLEARANCE</option>
	</select>
	</td>
</tr>
<tr style='font-size:15px;' id='dep_date_row'>
<td>Deposited Date <font color='red' size='5px'> *</font></td>
		<td align='left'><input name="deposited_date" id="deposited_date" type="text" value='' style="width:100px;height:25px;" onkeypress=""></td>
</tr>
<tr style='font-size:15px;'id='bank_name_row'>
<td>Bank Name</td>
		<td align='left'>
		<select name="bank_name" id="bank_name" style="width:220px;height:25px;" onblur='javascript:check_bankname(this.value)' >
			<?php foreach($banks as $bank){ ?>
			<option value="<?php echo $bank["bank_code"];?>"  ><?php echo $bank["bank_name"];?></option>
			<?php } ?>
			<option value='new_bank' >New...</option>
		</select>
	</td>
</tr>
<tr style='font-size:15px;display:none;' id='new_bank_row'>
<td>New Bank Name</td>
		<td align='left'><input name="new_bank" id="new_bank" type="text" style="width:200px;height:25px;">
	</td>
</tr>
<tr style='font-size:15px;' id='shift_date_row'>
<td>Shift Date <font color='red' size='5px'> *</font></td>
		<td align='left'><input name="shift_date" id="shift_date" type="text" style="width:100px;height:25px;" >
	</td>
</tr>
<tr style='font-size:15px;display:none;' id='trans_period_row'>
<td>Cleared From</td>
		<td align='left'><input name="start_date" id="start_date" type="text" style="width:100px;height:25px;" > To
		<input name="end_date" id="end_date" type="text" style="width:100px;height:25px;" >
	</td>
</tr>
<tr style='font-size:15px;' id='amount_row'>
<td>Amount <font color='red' size='5px'> *</font></td>
		<td align='left'><input name="amount" id="amount" type="text" onkeypress="return isFloatKey(event)" style="width:100px;height:25px;" onkeypress="formsubmit_testbill(event)">
	</td>
</tr>
<tr style='font-size:15px;' id='remarks_row'>
<td>Remarks <font color='red' size='5px'> *</font></td>
		<td align='left'><textarea name="remarks" id="remarks" style="width:auto; max-width:250px; height:50px; resize:both;" ></textarea>
	</td>
</tr>

<tr align="center"><td colspan='2'>
</td></tr>
<tr align="center" style="height:40px;"><td colspan='2'>
<input type="button" value="Add" style="width:70px;" onclick="javascript:add_new_transaction()"/>
</td></tr>
</table>
</div>
</form>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/bank_transaction.js"></script>