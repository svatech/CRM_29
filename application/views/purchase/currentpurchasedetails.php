<?php 
$count0=0;
foreach($bill_details as $row) { 
$count0++;
if($count0 ==1){ ?>
<table style="width:80%">
	<tr>
		<td>Voucher No </td>
		<td><input readonly="readonly" name="voucher_no" id="voucher_no" type="text" readonly="readonly" value="<?php echo $row->voucher_no?>" style="width:100px;height:20px;"></td>
		<td>Delivery Date</td>
		<td><input readonly="readonly" name="acct_date" id="acct_date" type="text" style="width:100px;height:20px;" value="<?php echo $row->account_date?>"></td>	
	</tr>
	
	<tr>
		<td>Invoice No</td>
		<td><input readonly="readonly" name="inv_no" id="inv_no" type="text" style="width:100px;height:20px;" value="<?php echo $row->invoice_no?>"></td>
		<td>Invoice Date</td>
		<td><input readonly="readonly" name="inv_date" id="inv_date" type="text" style="width:100px;height:20px;" value="<?php echo $row->invoice_date?>"></td>
	</tr>
	
	<tr>
		<td>Supplier Name</td>
		<td><input readonly="readonly" name="party_name" id="party_name" type="text" style="width:200px;height:20px;" value="<?php echo $row->party_name?>"></td>
	</tr>
</table>

<div align="center" style="min-height:100px;height:auto;margin:20px 0px 0px 10px;">
<table border="0" id="billtable" style="width:90%;border-radius:0px;border:0px solid green;" class='billtable' align="center">
	<tr align="center" bgcolor='#559999' style='color:white;'>
		<td width="">Item Name</td>
		<td width="">Litres&nbsp;&nbsp;(Ltrs)</td>
		<td width="">Amount&nbsp;&nbsp;(Rs)</td>
		<td width="">Inv. Density</td>
		<td width="">Del. Density</td> 
		
	</tr>
<?php }}?>	
<?php 
	$count1=0;
	foreach($pdt_details as $details) {  
	$count1++;	?>
	<tr align="center"> 
	   <?php $item="item".$count1; ?>
	   <?php $qty="qty".$count1; ?>
	   <?php $amt="amt".$count1; ?>
	   <?php $inv_den="inv_den".$count1; ?>
	   <?php $del_den="del_den".$count1; ?>
		<td><input readonly="readonly" name="<?php echo $item;?>" id=" <?php echo $item; ?>" style='width:100%;' value="<?php echo $details->item_name;?>" />
		</td>
		<td><input readonly="readonly" type="text" name="<?php echo $qty;?>" id="<?php echo $qty;?>" value="<?php echo $details->quantity;?>" style="width:50px;text-align:right"/></td>
		<td><input readonly="readonly" type="text" name="<?php echo $amt;?>" id="<?php echo $amt;?>" value="<?php echo $details->amount;?>" style="width:70px;text-align:right" onchange='javascript:opener.get_tot_amt()'/></td>
		<td><input readonly="readonly" type="text" name="<?php echo $inv_den;?>" id="<?php echo $inv_den;?>" value="<?php echo $details->inv_density;?>" style="width:50px;text-align:right" /></td>
		<td><input readonly="readonly" type="text" name="<?php echo $del_den;?>" id="<?php echo $del_den;?>" value="<?php echo $details->del_density;?>" style="width:50px;text-align:right" /></td>
		<td><input readonly="readonly" type="hidden" name="voucher_version" id="voucher_version" value="<?php echo $details->voucher_updated;?>"></td>
		</tr>
		<?php }?>
	</table>
	<p align="right">
<input readonly="readonly" type="hidden" name="count" value="<?php echo $count1;?>" id="count" >

<p align="left" style="margin-left:445px;">Grand Total&nbsp;&nbsp;(Rs)<input readonly="readonly" type="text" name="total" id="total" value="<?php  echo $row->total; ?>"  readonly="readonly"  style="width:100px;"/></p>
</div>
<hr width="100%">
<div align="center" style="min-height:100px;height:auto;margin:10px 0px 0px 10px;">
<table border="0" id="tank_table" style="width:60%;border-radius:0px;border:0px solid green;" class='tank_table' align="center">
	<tr><th colspan='3'>Product Unloading Split up Details</th></tr>
	<tr><td colspan='3'></td></tr>
	<tr align="center" bgcolor='#559999' style='color:white;'>
		<th width="">Tank Name</th>
		<th width="">Product Name</th>
		<th width="">Qty (Ltrs)</th>
		</tr>
		<?php 
	$count2=0;
	foreach($tank_loads as $res) {  
	$count2++;	?>
	<tr align="center">
	   <?php $tnk="tnk".$count2; ?>
	   <?php $pdt="pdt".$count2; ?>
	   <?php $ltrs="ltrs".$count2; ?>
	   
	<td><input readonly="readonly" name="<?php echo $tnk;?>" id=" <?php echo $tnk; ?>" style='width:100%;' value="<?php echo $res->tank_name;?>" />
		</td>
	<td>
		<input readonly="readonly" type="text" name="<?php echo $pdt;?>" id="<?php echo $pdt;?>" value="<?php echo $res->product;?>" style="width:70px;" onchange=""/>
	</td>
	<td>
		<input readonly="readonly" type="text" name="<?php echo $ltrs;?>" id="<?php echo $ltrs;?>" value="<?php echo $res->quantity;?>" style="width:70px;text-align:right" onchange=""/></td>
	</tr>
	<?php }?>
</table>
<input readonly="readonly" type="hidden" name="tank_count" value="<?php echo $count2;?>" id="tank_count" >

</div>