<?php 
$count0=0;
foreach($oldpurchasedetails_other as $row) { 
$count0++;
if($count0 ==1){ ?>
<table style="width:80%">
	<tr>
		<td>Voucher No</td>
		<td><input readonly='readonly' name="voucher_no" id="voucher_no" type="text" readonly="readonly" value="<?php echo $row->voucher_no?>" style="width:100px;height:20px;"></td>
		<td>Delivery Date</td>
		<td><input readonly='readonly' name="acct_date" id="acct_date" type="text" style="width:100px;height:20px;" value="<?php echo $row->account_date?>"></td>	
	</tr>
	
	<tr>
		<td>Invoice No</td>
		<td><input readonly='readonly' name="inv_no" id="inv_no" type="text" style="width:100px;height:20px;" value="<?php echo $row->bill_no?>"></td>
		<td>Invoice Date</td>
		<td><input readonly='readonly' name="inv_date" id="inv_date" type="text" style="width:100px;height:20px;" value="<?php echo $row->bill_date?>"></td>
	</tr>
	<tr>
		<td>Payment Mode</td>
		<td colspan='3'><input readonly='readonly' name="pay_mode" id="pay_mode" style="width:250px;height:25px;" value="<?php echo $row->payment_mode?>">
			
		</td>
	</tr>
	<tr>
		<td>Supplier Name</td>
		<td colspan='3'><input readonly='readonly' name="party_name" id="party_name" style="width:250px;height:25px;" value="<?php echo $row->party_name?>">
			
		</td>
	</tr>
</table>

<div align="center" style="min-height:100px;height:auto;margin:20px 0px 0px 10px;">
<table border="0" id="billtable" style="width:90%;border-radius:0px;border:0px solid green;" class='billtable' align="center">
	<tr align="center" bgcolor='#559999' style='color:white;'>
		<td width="">Item Name</td>
		<td width="">Quantity</td>
		<td width="">Rate&nbsp;&nbsp;(Rs)</td>
		<td width="">Amount&nbsp;&nbsp;(Rs)</td>
		</tr>
<?php }}?>	
<?php 
	$count1=0;
	foreach($oldproductpurchasedetails_other as $details) {  
	$count1++;	?>
	<tr align="center"> 
	   <?php $item="item".$count1; ?>
	   <?php $qty="qty".$count1; ?>
	   <?php $rate="rate".$count1; ?>
	   <?php $amt="amt".$count1; ?>
	   <td><input readonly='readonly' name="<?php echo $item;?>" id="<?php echo $item; ?>" style='width:100%;' value="<?php echo $details->item_name;?>">
		
		</td>
		<td><input readonly='readonly' type="text" name="<?php echo $qty;?>" id="<?php echo $qty;?>" value="<?php echo $details->quantity;?>" style="width:50px;text-align:right" /></td>
		<td><input readonly='readonly' type="text" name="<?php echo $rate;?>" id="<?php echo $rate;?>" value="<?php echo $details->rate;?>" style="width:50px;text-align:right" /></td>
		<td><input readonly='readonly' type="text" name="<?php echo $amt;?>" id="<?php echo $amt;?>" value="<?php echo $details->amount;?>" style="width:70px;text-align:right" /></td>
		</tr>
		<?php }?>
		<tr><td><input readonly='readonly' type="hidden" name="voucher_version" id="voucher_version" value="<?php echo $details->voucher_updated;?>"></td></tr>
	</table>
	<p align="right">
<input readonly='readonly' type="hidden" name="count" value="<?php echo $count1;?>" id="count" >

<table  width="60%" style="" cellpadding="0" cellspacing="7px" align="right" >
	<tr >
		<td width="70%" align="right">Total &nbsp;&nbsp;(Rs)</td>
		<td width="30%" align="left"><input readonly='readonly' type="text" name="total" id="total" value="<?php  echo $row->total; ?>" readonly="readonly" style="width:80px;text-align:right;"/></td>
	</tr>
	<tr >
		<td width="70%" align="right">Cash Discount % <input readonly='readonly' type="text" name="cash_disc" id="cash_disc"  value="<?php  echo $row->cash_dis_per; ?>"  style="width:40px;text-align:right;"/></td>
		<td width="30%" align="left"><input readonly='readonly' type="text" name="cash_disc_amt" id="cash_disc_amt" value="<?php  echo $row->cash_discount; ?>"   style="width:80px;text-align:right;"/></td>
	</tr>
	<tr >
		<td width="70%" align="right">Scheme Discount %<input readonly='readonly' type="text" name="sch_disc" id="sch_disc"  value="<?php  echo $row->scheme_dis_per; ?>"  style="width:40px;text-align:right;"/></td>
		<td width="30%" align="left"><input readonly='readonly' type="text" name="sch_disc_amt" id="sch_disc_amt" value="<?php  echo $row->scheme_discount; ?>" readonly="readonly" style="width:80px;text-align:right;"/></td>
	</tr>
	<tr >
		<td width="70%" align="right">VAT Tax %<input readonly='readonly' type="text" name="vat" id="vat" value="<?php  echo $row->vat_tax_per; ?>" style="width:40px;text-align:right;"/></td>
		<td width="30%" align="left"><input readonly='readonly' type="text" name="vat_amt" id="vat_amt" value="<?php  echo $row->vat_tax; ?>" readonly="readonly" style="width:80px;text-align:right;"/></td>
	</tr>
	<tr >
		<td width="70%" align="right">Others &nbsp;&nbsp;(Rs)</td>
		<td width="30%" align="left"><input readonly='readonly' type="text" name="other_amt" id="other_amt" value="<?php  echo $row->others; ?>"  style="width:80px;text-align:right;"/></td>
	</tr>
	
	<tr align="right">
		<td width="70%" align="right">Grand Total &nbsp;&nbsp;(Rs)</td>
		<td width="30%" align="left"><input readonly='readonly' type="text" name="grnd_tot" id="grnd_tot" value="<?php  echo $row->grand_total; ?>" readonly="readonly" style="width:80px;text-align:right;"/></td>
	</tr>
</table>
</div>
<hr width="100%">


