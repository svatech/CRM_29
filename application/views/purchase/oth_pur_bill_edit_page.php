<?php 
$count0=0;
foreach($bill_details as $row) { 
$count0++;
if($count0 ==1){ ?>
<table style="width:80%">
	<tr>
		<td>Voucher No</td>
		<td><input name="voucher_no" id="voucher_no" type="text" readonly="readonly" value="<?php echo $row->voucher_no?>" style="width:100px;height:20px;"></td>
		<td>Delivery Date</td>
		<td><input name="acct_date" id="acct_date" type="text" style="width:100px;height:20px;" value="<?php echo $row->account_date?>"></td>	
	</tr>
	
	<tr>
		<td>Invoice No</td>
		<td><input name="inv_no" id="inv_no" type="text" style="width:100px;height:20px;" value="<?php echo $row->bill_no?>"></td>
		<td>Invoice Date</td>
		<td><input name="inv_date" id="inv_date" type="text" style="width:100px;height:20px;" value="<?php echo $row->bill_date?>"></td>
	</tr>
	<tr>
		<td>Payment Mode</td>
		<td colspan='3'><select name="pay_mode" id="pay_mode" style="width:250px;height:25px;">
			<option value='CASH' <?php if($row->payment_mode=='CASH'){echo "selected";} ?> >Cash</option>
			<option value='CREDIT' <?php if($row->payment_mode=='CREDIT'){echo "selected";} ?> >Credit</option>	
			</select>
		</td>
	</tr>
	<tr>
		<td>Supplier Name</td>
		<td colspan='3'><select name="party_name" id="party_name" style="width:250px;height:25px;">
			<?php foreach($suppliers as $supp){ ?>
			<option value="<?php echo $supp["supplier_name"];?>" <?php if($supp["supplier_name"]==$row->party_name){echo "selected";} ?>><?php echo $supp["supplier_name"];?></option>
			<?php } ?>	
			</select>
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
	foreach($pdt_details as $details) {  
	$count1++;	?>
	<tr align="center"> 
	   <?php $item="item".$count1; ?>
	   <?php $qty="qty".$count1; ?>
	   <?php $rate="rate".$count1; ?>
	   <?php $amt="amt".$count1; ?>
	   <td><select name="<?php echo $item;?>" id="<?php echo $item; ?>" style='width:100%;' onchange='javascript:opener.edit_page_cal_amt()'>
		<option value="default">Select</option>
		 <?php foreach($pdt_list as $pdt){ ?>
			<option value="<?php echo $pdt["product_name"];?>" <?php if($pdt["product_name"]==$details->item_name){echo "selected";} ?>><?php echo $pdt["product_name"];?></option>
			<?php } ?>
		</select>
		</td>
		<td><input type="text" name="<?php echo $qty;?>" id="<?php echo $qty;?>" value="<?php echo $details->quantity;?>" style="width:50px;text-align:right" onchange='javascript:opener.edit_page_cal_amt()' onkeypress="return opener.isFloatKey(event)"/></td>
		<td><input type="text" name="<?php echo $rate;?>" id="<?php echo $rate;?>" value="<?php echo $details->rate;?>" style="width:50px;text-align:right" onchange='javascript:opener.edit_page_cal_amt()' onkeypress="return opener.isFloatKey(event)"/></td>
		<td><input type="text" name="<?php echo $amt;?>" id="<?php echo $amt;?>" value="<?php echo $details->amount;?>" style="width:70px;text-align:right" onchange='javascript:opener.edit_page_cal_amt()' onkeypress="return opener.isFloatKey(event)"/></td>
		</tr>
		<?php }?>
		<tr><td><input type="hidden" name="voucher_version" id="voucher_version" value="<?php echo $details->voucher_updated;?>"></td></tr>
	</table>
	<p align="right">
<input type="hidden" name="count" value="<?php echo $count1;?>" id="count" >
<input type="button" value="Add another Row" name="addItem" id="addItem" style="width:120px;margin-right:10px;" onclick="opener.addanotherrow_other()"/></p>
<table  width="60%" style="" cellpadding="0" cellspacing="7px" align="right" >
	<tr >
		<td width="70%" align="right">Total &nbsp;&nbsp;(Rs)</td>
		<td width="30%" align="left"><input type="text" name="total" id="total" value="<?php  echo $row->total; ?>" readonly="readonly" style="width:80px;text-align:right;"/></td>
	</tr>
	
	<tr >
		<td width="70%" align="right">Scheme Discount %<input type="text" name="sch_disc" id="sch_disc" onchange='javascript:opener.edit_page_cal_amt()' value="<?php  echo $row->scheme_dis_per; ?>" onkeypress="return opener.isFloatKey(event)" style="width:40px;text-align:right;"/></td>
		<td width="30%" align="left"><input type="text" name="sch_disc_amt" id="sch_disc_amt" onchange='javascript:opener.edit_page_cur_amt()'value="<?php  echo $row->scheme_discount; ?>" onkeypress="return opener.isFloatKey(event)" style="width:80px;text-align:right;"/></td>
	</tr>
	<tr >
		<td width="70%" align="right">Cash Discount % <input type="text" name="cash_disc" id="cash_disc" onchange='javascript:opener.edit_page_cal_amt()' value="<?php  echo $row->cash_dis_per; ?>" onkeypress="return opener.isFloatKey(event)" style="width:40px;text-align:right;"/></td>
		<td width="30%" align="left"><input type="text" name="cash_disc_amt" id="cash_disc_amt" onchange='javascript:opener.edit_page_cur_amt()' value="<?php  echo $row->cash_discount; ?>" onkeypress="return opener.isFloatKey(event)"  style="width:80px;text-align:right;"/></td>
	</tr>
	<tr >
		<td width="70%" align="right">VAT Tax %<input type="text" name="vat" id="vat" value="<?php  echo $row->vat_tax_per; ?>" onchange='javascript:opener.edit_page_cal_amt()' onkeypress="return opener.isFloatKey(event)" style="width:40px;text-align:right;"/></td>
		<td width="30%" align="left"><input type="text" name="vat_amt" id="vat_amt"  onchange='javascript:opener.edit_page_cur_amt()' value="<?php  echo $row->vat_tax; ?>" onkeypress="return opener.isFloatKey(event)" style="width:80px;text-align:right;"/></td>
	</tr>
	<tr >
		<td width="70%" align="right">Others &nbsp;&nbsp;(Rs)</td>
		<td width="30%" align="left"><input type="text" name="other_amt" id="other_amt" value="<?php  echo $row->others; ?>" onchange='javascript:opener.edit_page_cal_amt()' onkeypress="return opener.isFloatKey(event)" style="width:80px;text-align:right;"/></td>
	</tr>
	
	<tr align="right">
		<td width="70%" align="right">Grand Total &nbsp;&nbsp;(Rs)</td>
		<td width="30%" align="left"><input type="text" name="grnd_tot" id="grnd_tot" value="<?php  echo $row->grand_total; ?>" readonly="readonly" style="width:80px;text-align:right;"/></td>
	</tr>
</table>
</div>
<hr width="100%">


