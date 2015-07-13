
<table style="width:80%;margin-left:10px;padding:0px;margin-right:10px;" cellpadding="3" cellspacing="3">
<tr>
	<td>Bill No</td>
	<td><input name="bill_no" id="bill_no" readonly="readonly" type="text" style="width:100px;height:20px;" value='<?php echo $bill_no;?>'></td>
</tr>
<tr>
	<td>Payment Date</td>
	<td><input name="payment_date" id="payment_date"  type="text" style="width:100px;height:20px;" value=''></td>
</tr>
<tr>
	<td>Payment Mode</td>
	<td><select name='payment_mode' id='payment_mode' onchange='javascript:opener.check_paymode(this.value)'>
	<option value='CASH' >CASH</option>
	<option value='CHEQUE'>CHEQUE</option>
	<option value='NEFT'>NEFT</option>
	<option value='RTGS'>RTGS</option>
	</select></td>
</tr>
<tr>
	<td>Amount</td>
	<td><input name="payment_amount" id="payment_amount"  type="text" style="width:100px;height:20px;" value=''></td>
</tr>
<tr id='chequeno_row' style='display:none;'>
	<td>Cheque No</td>
	<td><input name="cheque_no" id="cheque_no"  type="text" style="width:100px;height:20px;" value=''></td>
</tr>
<tr id='chequedate_row' style='display:none;'>
	<td>Cheque Date</td>
	<td><input name="cheque_date" id="cheque_date"  type="text" style="width:100px;height:20px;" value=''></td>
</tr>
<tr id='bankname_row' style='display:none;'>
	<td>Bank Name</td>
	<td><input name="bank_name" id="bank_name"  type="text" style="width:100px;height:20px;" value=''></td>
</tr>
<tr id='refno_row' style='display:none;'>
	<td>Reference No</td>
	<td><input name="ref_no" id="ref_no"  type="text" style="width:100px;height:20px;" value=''></td>
</tr>
</table>
