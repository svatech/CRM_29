<!-- <div  style="height:auto;overflow:hidden;background:#006666;margin:30px;width:1000px;min-height:80px;border:0px solid black ;border-radius:10px;">
<p style="margin-left:80%;padding-top:5px;line-height:0.5em;color:white;">User: <b><?php echo $this->session->userdata('fullname');?></b>&nbsp;&nbsp;<img src="../../images/rightarrow1.png" width="10px" height="10px;"/>&nbsp;&nbsp;&nbsp;<strong>
 <a href="<?php echo site_url("logincheck/logout"); ?>" style="color:white;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='white'">Logout</a></strong></p>
<center style="margin-bottom:20px;font-size:20pt;color:white;position:inline;">Add New Expense</center>
 </div>
  -->
<div class='short_form'>
<form name="testform" id="testform" method="post" action="" > 
<!-- <p style="padding-top:20px;margin-left:180px"><span style="font-weight:bolder;padding-left:20px;font-size:20pt;">Bill Information</span><span style="position:inline;padding-left:600px;">Account Date <input type="text" name="timedisp" id="timedisp" value=""  /></span> </p>
<hr width="100%">  -->
<div style="margin:10px 0px 0px 0px;" >
<p style="height:20px;margin-left:20px;padding:0px 30px 0px 0px;" align="right"><span style="font-size:11pt;color:red;">* Required Fields </span></p>
<table border="0" style="width:80%;margin-left:15%;padding:0px;float:left;margin-top:20px;" cellpadding="0" cellspacing="0">
<tr style='font-size:15px;'>
<td>Date <font color='red' size='5px'> *</font></td>
		<td align='left'><input name="exp_date" id="exp_date" type="text" value='' style="width:100px;height:25px;" onkeypress=""></td>
</tr>
<tr style='font-size:15px;'>
<td>Bill No <font color='red' size='5px'> *</font></td>
		<td align='left'><input name="bill_no" id="bill_no" type="text" style="width:100px;height:25px;" >
	</td>
</tr>
<tr style='font-size:15px;'>
<td>Vendor Name <font color='red' size='5px'> *</font></td>
		<td align='left'>
		<select name="vendor_name" id="vendor_name" style="width:200px;height:25px;" onblur='javascript:checkVendor(this.value)' >
			<?php foreach($vendors as $vendor){ ?>
			<option value="<?php echo $vendor["vendor_code"];?>"  ><?php echo $vendor["vendor_name"];?></option>
			<?php } ?>
			<option value='new_vendor' >New Vendor</option>
		</select>
	</td>
</tr>
<tr style='font-size:15px;display:none;' id='new_vendor_row'>
<td>New Vendor Name <font color='red' size='5px'> *</font></td>
		<td align='left'><input name="new_vendor" id="new_vendor" type="text" style="width:200px;height:25px;">
	</td>
</tr>
<tr style='font-size:15px;'>
<td>Items Purchased <font color='red' size='5px'> *</font></td>
		<td align='left'><textarea name="items" id="items" style="width:100px;height:25px;" ></textarea>
	</td>
</tr>
<tr style='font-size:15px;'>
<td>Amount <font color='red' size='5px'> *</font></td>
		<td align='left'><input name="amount" id="amount" type="text"  onkeypress="return isFloatKey(event)" style="width:100px;height:25px;" onkeypress="formsubmit_testbill(event)">
	</td>
</tr>
<tr align="center"><td colspan='2'>
</td></tr>
<tr align="center" style="height:40px;"><td colspan='2'>
<input type="button" value="Add" style="width:70px;" onclick="javascript:add_new_expense()"/>
</td></tr>
</table>
</div>
</form>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/expense_mgr.js"></script>