
<?php 
$count0=0;
foreach($transactions as $row) { 
	
?>
<div>
<table style="width:100%;margin-left:10px;padding:0px;margin-right:10px;" cellpadding="3" cellspacing="3">
<tr>
	<td>Transaction Type</td>
	<td >
	<select name='trans_type' id='trans_type' onchange='javascript:opener.check_trans_upd(this.value)'>
	<option value='CASH' <?php if($row["transaction_type"]=='CASH')echo "selected";?> >SHIFT AMOUNT-CASH DEPOSIT</option>
	<option value='CREDIT' <?php if($row["transaction_type"]=='CREDIT')echo "selected";?> >CREDIT CARD SALES CLEARANCE</option>
	<option value='FLEET' <?php if($row["transaction_type"]=='FLEET')echo "selected";?> >XTRAPOWER CARD SALES CLEARANCE</option>
	<option value='XTRAREWARD' <?php if($row["transaction_type"]=='XTRAREWARD')echo "selected";?> >XTRAREWARD CARD SALES CLEARANCE</option>
	<option value='EASYFUELS' <?php if($row["transaction_type"]=='EASYFUELS')echo "selected";?> >EASYFUELS CARD SALES CLEARANCE</option>
	</select>
	</td>
</tr>
<tr>
	<td>Deposited Date</td>
	<td ><input name="deposited_date" id="deposited_date"  type="text" style="width:100px;height:20px;" value='<?php echo $row["deposited_date"];?>'></td>
</tr>
<tr>
	<td>Bank Name</td>
	<td >
		<select name="bank_name" id="bank_name" style="width:200px;height:25px;" onchange='javascript:opener.checkBank_upd(this.value)' >
			<?php foreach($banks as $bank){ ?>
			<option value="<?php echo $bank["bank_code"];?>" <?php if($bank["bank_code"]==$row["bank_code"])echo "selected";?> ><?php echo $bank["bank_name"];?></option>
			<?php } ?>
			<option value='new_bank' >New Bank</option>
		</select>
	</td>
	</tr>
	
<tr style='display:none;' id='new_bank_row'>
<td>New Bank Name</td>
		<td><input name="new_bank" id="new_bank" type="text" style="width:150px;height:25px;">
	</td>
</tr>
<tr id='shift_date_row' <?php if($row["transaction_type"]!='CASH' && $row["transaction_type"]!='CREDIT' )echo "style='display:none;'";?> >
<td>Shift Date</td>
		<td><input name="shift_date" id="shift_date" type="text" style="width:150px;height:25px;" value='<?php echo $row["shift_date"];?>'>
	</td>
</tr>
<tr <?php if($row["transaction_type"]!='FLEET' && $row["transaction_type"]!='XTRAREWARD' && $row["transaction_type"]!='EASYFUELS')echo "style='display:none;'";?>  id='trans_period_row'>
<td>Cleared From</td>
		<td align='left'><input name="start_date" id="start_date" type="text" style="width:100px;height:25px;" value='<?php echo $row["trans_start_date"];?>' > To
		<input name="end_date" id="end_date" type="text" style="width:100px;height:25px;" value='<?php echo $row["trans_end_date"];?>'>
	</td>
</tr>
<tr>
	<td>Amount</td>
		<td>
			<input name="amount" id="amount" type="text" style="width:100px;height:20px;" value='<?php echo $row["amount"]?>' onkeyup="" onkeypress="return opener.isFloatKey(event)">
		</td>
</tr>
<tr>
	<td>Remarks</td>
	<td>
		<textarea name="remarks" id="remarks" style="width:250px;height:60px;"><?php echo $row["remarks"];?></textarea>
		
	</td>
</tr>

</table>
<input type='hidden' name='transaction_id' id='transaction_id' value='<?php echo $row["id"];?>' >
</div>
<?php }?>