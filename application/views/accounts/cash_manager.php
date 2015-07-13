<div  style="height:auto;overflow:hidden;background:#006666;margin:30px;width:1000px;min-height:80px;border:0px solid black ;border-radius:10px;">
<p style="margin-left:80%;padding-top:5px;line-height:0.5em;">User: <b><?php echo $this->session->userdata('fullname');?></b>&nbsp;&nbsp;<img src="../../images/rightarrow1.png" width="10px" height="10px;"/>&nbsp;&nbsp;&nbsp;<strong>
 <a href="<?php echo site_url("logincheck/logout"); ?>" style="color:black;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='black'">Logout</a></strong></p>
<center style="margin-bottom:20px;font-size:20pt;position:inline;">Accounts Manager</center>
 </div>
<div style="height:auto; background:#CCCCCC;width:1000px;margin:30px;border:1px solid black ;border-radius:10px;">
<form name="testform" id="testform" method="post" action="" > 
<!-- <p style="padding-top:20px;margin-left:180px"><span style="font-weight:bolder;padding-left:20px;font-size:20pt;">Bill Information</span><span style="position:inline;padding-left:600px;">Account Date <input type="text" name="timedisp" id="timedisp" value=""  /></span> </p>
<hr width="100%">  -->
<div >
<table border="0" style="width:80%;margin-left:15%;padding:0px;float:left;margin-top:20px;" cellpadding="0" cellspacing="0">
<tr style='font-size:15px;'>
<td>Date</td>
		<td align='left'><input name="trans_date" id="trans_date" type="text" value='' style="width:100px;height:25px;" onkeypress=""></td>
</tr>
<tr style='font-size:15px;'>
<td>Cash-In Source</td>
		<td align='left'><input name="cash_source" id="cash_source" type="text" style="width:200px;height:25px;" value='From Pricol Limited'>
	</td>
</tr>


<tr style='font-size:15px;'>
<td>Amount</td>
		<td align='left'><input name="amount" id="amount" type="text" style="width:100px;height:25px;" onkeypress="formsubmit_testbill(event)">
	</td>
</tr>
<tr style='font-size:15px;' id='remarks_row'>
<td>Remarks</td>
		<td align='left'><textarea name="remarks" id="remarks" style="width:auto; max-width:250px; height:50px; resize:both;" ></textarea>
	</td>
</tr>
<tr align="center"><td colspan='2'>
</td></tr>
<tr align="center" style="height:40px;"><td colspan='2'>
<input type="button" value="Add" style="width:70px;" onclick="javascript:add_new_cash_in()"/>
</td></tr>
</table>
</div>
</form>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/accounts.js"></script>