
<?php 
$count0=0;
foreach($bill as $row) { 
	$billno=$row["bill_no"];
$count0++;
if($count0 ==1){ ?>
<div>
<table style="width:80%;margin-left:10px;padding:0px;margin-right:10px;" cellpadding="3" cellspacing="3">

<tr>
	<td>Bill No</td>
	<td ><input name="bill_no" id="bill_no" readonly="readonly" type="text" style="width:100px;height:20px;" value='<?php echo $row["bill_no"];?>'></td>

	<td>Bill Date</td>
	<td ><input name="bill_date" id="bill_date" type="text" style="width:100px;height:20px;" value='<?php echo $row["bill_date"];?>'></td>
</tr>
<tr>
	<td>Customer Name</td>
	<td ><input type='hidden' id='cust_id' name='cust_id' value='<?php echo $row["cust_id"];?>' />
	<input name="cust_name" id="cust_name" type="text" style="width:250px;height:20px;" value='<?php echo $row["customer_name"];?>' onblur='opener.getVehList(this.value)'></td>
	<td>Bill Amount </td>
	<td ><input name="bill_amt" id="bill_amt" type="text" style="width:100px;height:20px;" value='<?php echo $row["bill_amount"];?>' onkeyup=""></td>
</tr>
<tr>
	<td>Sales From</td>
	<td>
		<input name="from_date" id="from_date" type="text" style="width:100px;height:20px;" value='<?php echo $row["from_date"];?>' onkeyup="">
	</td>

	<td>To</td>
		<td>
			<input name="to_date" id="to_date" type="text" style="width:100px;height:20px;" value='<?php echo $row["to_date"];?>' onkeyup="">
	</td>
</tr>
<tr>
	<td>Amount Paid</td>
		<td>
			<input name="paid_amt" id="paid_amt" type="text" style="width:100px;height:20px;" value='<?php echo $row["paid_amt"]?>' onkeyup="">
		</td>
	<td>Balance Amount</td>
	<?php $bal_amt=$row["bill_amount"]-$row["paid_amt"];?>
	<td><input name="bal_amt" id="bal_amt" type="text" style="width:50px;height:20px;" value='<?php echo $bal_amt?>'></td>
</tr>
</table>
</div>
<div style="min-height:140px;height:auto;width:100%;margin:10px 10px 0px 10px;">
<table border="0" id="paymt_table" class='paymt_table' style="width:100%;border-radius:15px;border-collapse:collapse;" class='paymt_table' align="center">
	<tr bgcolor='' style='color:black;' align="center">
		<td colspan='8'>Payment Details</td>
	</tr>
	<tr bgcolor='#559999' style='color:white;' align="center">
		<td>Date</td>
		<td>Mode of Payment</td>
		<td>Amount</td>
		<td>Cheque No</td>
		<td>Cheque Date</td>
		<td>Bank Name</td>
		<td>Status</td>
		<td>Clearance Date</td>
		<td>Cancel</td>
	</tr>
	<?php } } ?>
	
	<?php 
	$count1=0;
	foreach($payment as $details) {  
		$count1++;
	?>
	<tr align="center"> 
	    <td><input type='hidden' name='<?php echo "pid".$count1?>' id='<?php echo "pid".$count1?>' value='<?php echo $details->id;?>' /><input type="text" name="<?php echo "pdate".$count1?>" id="<?php echo "pdate".$count1?>" value="<?php echo $details->payment_date;?>" readonly='readonly' style="background:#f0f0f0;border:1px solid #d0d0d0;text-align:right;width:70px;"/></td>
		<td><input type="text" name="<?php echo "pmode".$count1?>" id="<?php echo "pmode".$count1?>" value="<?php echo $details->payment_mode;?>" readonly='readonly' style="background:#f0f0f0;border:1px solid #d0d0d0;text-align:right;width:70px;"/></td>
		<td><input type="text" name="<?php echo "pamount".$count1?>" id="<?php echo "pamount".$count1?>" value="<?php echo $details->amount;?>" readonly='readonly' style="background:#f0f0f0;border:1px solid #d0d0d0;text-align:right;width:70px;"/></td>
		<td><input type="text" name="<?php echo "chequeno".$count1?>" id="<?php echo "chequeno".$count1?>" value="<?php echo $details->cheque_no;?>" readonly='readonly' style="background:#f0f0f0;border:1px solid #d0d0d0;text-align:right;width:70px;" /></td>
		<td><input type="text" name="<?php echo "chequedate".$count1?>" id="<?php echo "chequedate".$count1?>" value="<?php echo $details->cheque_date;?>" readonly='readonly' style="background:#f0f0f0;border:1px solid #d0d0d0;text-align:right;width:70px;" /></td>
		<td><input type="text" name="<?php echo "bankname".$count1?>" id="<?php echo "bankname".$count1?>" value="<?php echo $details->bank_name;?>" readonly='readonly' style="background:#f0f0f0;border:1px solid #d0d0d0;text-align:right;width:70px;" /></td>
		<td><select name='<?php echo "chequestatus".$count1?>' id='<?php echo "chequestatus".$count1?>' onchange='opener.update_chequestatus(this.value,<?php echo $count1;?>)' <?php if($details->payment_mode=='CASH') echo "disabled" ?> >
				<option value='NOT_CLEARED' <?php if($details->cheque_status=='NOT_CLEARED') echo "selected"?> >NOT CLEARED</option>
				<option value='CLEARED' <?php if($details->cheque_status=='CLEARED') echo "selected"?> >CLEARED</option>
				<option value='BOUNCED' <?php if($details->cheque_status=='BOUNCED') echo "selected"?> >BOUNCED</option>
		</select>
		</td>
		<td><input type="text" class='clearance_date' name="<?php echo "cleardate".$count1?>" id="<?php echo "cleardate".$count1?>" value="<?php echo $details->clearance_date;?>" onchange='javascript:opener.update_clearancedate(this.value,<?php echo $count1;?>)' disabled style="background:#f0f0f0;border:1px solid #d0d0d0;text-align:right;width:70px;" /></td>
		<td><a  href='javascript:opener.cancel_payment(<?php echo $details->id;?>);' id='<?php echo "cancel".$count1?>'><font color=''>Cancel</font></a></td>
	</tr><?php  }?>
	<?php if($bal_amt > 0){?>
	<tr align='center'><td colspan='8' ><input type='button' name='make_payment' id='make_payment' value='Make Payment' onclick='javascript:opener.make_payment("<?php echo $billno;?>")'/></td></tr>
	<?php } ?>
</table>
</div>
