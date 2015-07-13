
<?php 
$count0=0;
foreach($result as $row) { 
	
?>
<div>
<table style="width:100%;margin-left:10px;padding:0px;margin-right:10px;" cellpadding="3" cellspacing="3">
<tr>
	<td>Date</td>
	<td ><input name="trans_date" id="trans_date"  type="text" style="width:100px;height:20px;" value='<?php echo $row["transaction_date"];?>'></td>
</tr>

<tr>
	<td>Cash-In Source</td>
	<td>
			<input name="cash_source" id="cash_source" type="text" style="width:200px;height:20px;" value='<?php echo $row["cash_source"]?>' onkeyup="">
		</td>
	
</tr>
<tr>
	<td>Amount</td>
		<td>
			<input name="amount" id="amount" type="text" style="width:100px;height:20px;" value='<?php echo $row["amount"]?>' onkeypress='return opener.isFloatKey(event)' />
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