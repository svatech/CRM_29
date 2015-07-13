
<?php 
$count0=0;
foreach($expenses as $row) { 
	$billno=$row["bill_no"];
?>
<div>
<table style="width:100%;margin-left:10px;padding:0px;margin-right:10px;" cellpadding="3" cellspacing="3">
<tr>
	<td>Date</td>
	<td ><input name="exp_date" id="exp_date"  type="text" style="width:100px;height:20px;" value='<?php echo $row["exp_date"];?>'></td>
</tr>
<tr>
	<td>Bill No</td>
	<td ><input name="bill_no" id="bill_no"  type="text" style="width:100px;height:20px;" value='<?php echo $row["bill_no"];?>'></td>
</tr>
<tr>
	<td>Vendor Name</td>
	<td >
		<select name="vendor_name" id="vendor_name" style="width:200px;height:25px;" onchange='javascript:opener.checkVendor_upd(this.value)' >
			<?php foreach($vendors as $vendor){ ?>
			<option value="<?php echo $vendor["vendor_code"];?>" <?php if($vendor["vendor_code"]==$row["vendor_code"])echo "selected";?> ><?php echo $vendor["vendor_name"];?></option>
			<?php } ?>
			<option value='new_vendor' >New Vendor</option>
		</select>
	</td>
	</tr>
	
<tr style='display:none;' id='new_vendor_row'>
<td>New Vendor Name</td>
		<td><input name="new_vendor" id="new_vendor" type="text" style="width:150px;height:25px;">
	</td>
</tr>
<tr>
	<td>Items Purchased</td>
	<td>
		<textarea name="items" id="items" style="width:250px;height:60px;"><?php echo $row["items"];?></textarea>
		
	</td>
</tr>
<tr>
	<td>Amount</td>
		<td>
			<input name="amount" id="amount" type="text" style="width:100px;height:20px;" value='<?php echo $row["amount"]?>' onkeyup="" onkeypress="return opener.isFloatKey(event)">
		</td>
</tr>
</table>
<input type='hidden' name='expense_id' id='expense_id' value='<?php echo $row["id"];?>' >
</div>
<?php }?>