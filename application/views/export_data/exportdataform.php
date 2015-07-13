
<?php 
$count0=0;
foreach($exportinfo as $row) { 
	
?>
<div>
<table style="width:100%;margin-left:10px;padding:0px;margin-right:10px;" cellpadding="3" cellspacing="3">
<tr>
	<td>Section Code</td>
	<td ><input name="section_code" id="section_code"  type="text" style="width:100px;height:20px;" value='<?php echo $row["section_code"];?>'></td>
</tr>
<tr>
	<td>Business Area</td>
	<td ><input name="business_area" id="business_area"  type="text" style="width:100px;height:20px;" value='<?php echo $row["business_area"];?>'></td>
</tr>	
<tr>
<td>SAP Sale Code</td>
		<td><input name="sap_sale_code" id="sap_sale_code" type="text" style="width:100px;height:25px;" value='<?php echo $row["sap_sale_code"];?>'>
	</td>
</tr>
<tr>
	<td>Cost Center</td>
	<td>
		<input name="cost_center" id="cost_center" type="text" style="width:100px;height:25px;" value='<?php echo $row["cost_center"];?>'>
		
	</td>
</tr>
<tr>
	<td>Profit Center</td>
		<td>
			<input name="profit_center" id="profit_center" type="text" style="width:100px;height:20px;" value='<?php echo $row["profit_center"]?>'>
		</td>
</tr>
<tr>
	<td>Indent Statement Report Reference</td>
		<td>
			<input name="indent_stmt_rpt_ref" id="indent_stmt_rpt_ref" type="text" style="width:210px;height:20px;" value='<?php echo $row["indent_stmt_rpt_ref"]?>' >
		</td>
</tr>
<tr>
	<td>Bank Transaction Report Reference</td>
		<td>
			<input name="bank_trans_rpt_ref" id="bank_trans_rpt_ref" type="text" style="width:210px;height:20px;" value='<?php echo $row["bank_trans_rpt_ref"]?>'>
		</td>
</tr>
<tr>
	<td>Cheque Sales Report Reference</td>
		<td>
			<input name="cheque_sales_rpt_ref" id="cheque_sales_rpt_ref" type="text" style="width:210px;height:20px;" value='<?php echo $row["cheque_sales_rpt_ref"]?>' >
		</td>
</tr>
<tr>
	<td>Indent Payments Report Reference</td>
		<td>
			<input name="indent_pmt_rpt_ref" id="indent_pmt_rpt_ref" type="text" style="width:210px;height:20px;" value='<?php echo $row["indent_pmt_rpt_ref"]?>' >
		</td>
</tr>
<tr>
	<td>ICICI Credit Sales Report Reference</td>
		<td>
			<input name="credit_sales_rpt_ref" id="credit_sales_rpt_ref" type="text" style="width:210px;height:20px;" value='<?php echo $row["credit_sales_rpt_ref"]?>' >
		</td>
</tr>
<tr>
	<td>HDFC Credit Sales Report Reference</td>
		<td>
			<input name="hdfc_credit_sales_ref" id="hdfc_credit_sales_ref" type="text" style="width:210px;height:20px;" value='<?php echo $row["hdfc_credit_sales_ref"]?>' >
		</td>
</tr>
<tr>
	<td>Cash Sales Report Reference</td>
		<td>
			<input name="cash_sales_rpt_ref" id="cash_sales_rpt_ref" type="text" style="width:210px;height:20px;" value='<?php echo $row["cash_sales_rpt_ref"]?>' >
		</td>
</tr>
</table>

</div>
<?php }?>