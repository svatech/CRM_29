<?php foreach($cust_info as $row){
$cust_name=$row["customer_name"];
$cust_id=$row["customer_id"];
}

foreach($adv_paymts as $row){
	$adv_paymt=$row["ADVANCE_PAYMENTS"];
}
?>

<table style="width:80%;margin-left:10px;padding:0px;margin-right:10px;" cellpadding="3" cellspacing="3">

<tr>
	<td>Customer Name</td>
	<td><textarea name="cust_name" id="cust_name" readonly="readonly" disabled style="width:200px;"><?php echo $cust_name?></textarea>
	<input type='hidden' id='cust_id' value='<?php echo $cust_id ;?>' />
	</td>
</tr>
 <tr>
	<td>Payment Type</td>
	<td><select name='pay_type' id='pay_type' onchange='javascript:opener.check_paytype(this.value)'>
	<option value='bill' >Bill Payment</option>
	<option value='advance'>Make Advance Payment</option>
	<option value='deduce'>Debit From Advance Payment</option>
	</select></td>
</tr>
 
<tr id='billno_row'>
	<td>Bill No</td>
	<td><input name="bill_no" id="bill_no"  type="text" style="width:100px;height:20px;" onblur='javascript:opener.get_bill_details(this.value)' value=''></td>
</tr>
<tr id='billamt_row'>
	<td>Bill Amount</td>
	<td><input name="bill_amt" id="bill_amt" readonly="readonly"  type="text" style="width:100px;height:20px;"  value=''></td>
</tr>
<tr id='amtpaid_row'>
	<td>Amount Paid</td>
	<td><input name="paid_amt" id="paid_amt" readonly="readonly" type="text" style="width:100px;height:20px;"  value=''></td>
</tr>
<tr id='balamt_row'>
	<td>Balance Amount</td>
	<td><input name="bal_amt" id="bal_amt"  readonly="readonly" type="text" style="width:100px;height:20px;"  value=''></td>
</tr>
<tr id='payment_date_row'>
	<td>Payment Date</td>
	<td><input name="payment_date" id="payment_date"  type="text" style="width:100px;height:20px;" value=''></td>
</tr>
<tr id='payment_mode_row'>
	<td>Payment Mode</td>
	<td><select name='payment_mode' id='payment_mode' onchange='javascript:opener.check_paymode(this.value)'>
	<option value='CASH' >CASH</option>
	<option value='CHEQUE'>CHEQUE</option>
	<option value='NEFT'>NEFT</option>
	<option value='RTGS'>RTGS</option>
	<option value='CREDIT_CARD'>CREDIT CARD</option>
	<option value='DEMAND_DRAFT'>DEMAND DRAFT</option>
	</select></td>
</tr>
<tr id='advance_payment_row' style='display:none;'>
	<td>Amount Paid in Advance</td>
	<td><input name="advance_payment" id="advance_payment" readonly="readonly" type="text" style="width:100px;height:20px;" value='<?php echo $adv_paymt;?>'></td>
</tr>
<tr>
	<td>Amount</td>
	<td><input name="payment_amount" id="payment_amount"  type="text" style="width:100px;height:20px;" value='' onkeypress='return opener.isFloatKey(event)'></td>
</tr>
<tr id='chequeno_row' style='display:none;'>
	<td>Cheque No</td>
	<td><input name="cheque_no" id="cheque_no"  type="text" style="width:100px;height:20px;" value=''></td>
</tr>
<tr id='chequedate_row' style='display:none;'>
	<td>Cheque Date</td>
	<td><input name="cheque_date" id="cheque_date"  type="text" style="width:100px;height:20px;" value=''></td>
</tr>
<tr id='ddno_row' style='display:none;'>
	<td>DD No</td>
	<td><input name="dd_no" id="dd_no"  type="text" style="width:100px;height:20px;" value=''></td>
</tr>
<tr id='dddate_row' style='display:none;'>
	<td>DD Date</td>
	<td><input name="dd_date" id="dd_date"  type="text" style="width:100px;height:20px;" value=''></td>
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