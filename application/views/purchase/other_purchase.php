<!-- <div  style="height:auto;overflow:hidden;background:#006666;margin:30px;width:1000px;min-height:80px;border:0px solid black ;border-radius:10px;">
<p style="margin-left:80%;padding-top:5px;line-height:0.5em;color:white;">User: <b><?php echo $this->session->userdata('fullname');?></b>&nbsp;&nbsp;<img src="../../images/rightarrow1.png" width="10px" height="10px;"/>&nbsp;&nbsp;&nbsp;<strong>
 <a href="<?php echo site_url("logincheck/logout"); ?>" style="color:white;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='white'">Logout</a></strong></p>
<center style="margin-bottom:20px;font-size:20pt;color:white;position:inline;">Other Products Purchase Entry</center>
 </div>
  -->
<div class='lengthy_form' style='height:auto;'>
<form name="other_pur_form" id="other_pur_form" method="post" action="<?php echo site_url('purchase/other_pur'); ?>" > 
<p style="height:25px;color:#4c0000;padding:10px 0px 0px 20px;" align="center"><span style="font-weight:bolder;font-size:20pt;">Purchase Information</span></p>
<hr width="100%">
<div align="center" style="margin:0px 0px 0px 10px;">
<?php foreach ($bill_nos as $no); ?>
<p style="height:20px;margin-left:20px;padding:0px 10px 0px 0px;" align="right"><span style="font-size:11pt;color:red;">* Required Fields </span></p>
<table style="width:80%" cellspacing="0" cellpadding="0">
	<tr>
		<td>Voucher No <font color='red' size='5px'> *</font></td>
		<td><input name="voucher_no" id="voucher_no" type="text" readonly="readonly" value="<?php echo $no['other_pur_voucher'];?>" style="width:100px;height:20px;"></td>	
		<td>Account Date <font color='red' size='5px'> *</font></td>
		<td><input name="acct_date" id="acct_date" type="text" style="width:100px;height:20px;"></td>
	</tr>
	
	<tr>
		<td>Bill No <font color='red' size='5px'> *</font></td>
		<td><input name="inv_no" id="inv_no" type="text" style="width:100px;height:20px;"></td>
		<td>Bill Date <font color='red' size='5px'> *</font></td>
		<td><input name="inv_date" id="inv_date" type="text" style="width:100px;height:20px;"></td>	
	</tr>
	<tr>
		<td>Payment Mode <font color='red' size='5px'> *</font></td>
		<td colspan="3"><input name="pay_mode" id="credit_pay" type="radio" value="CREDIT" checked>&nbsp;<label for="credit_pay" style="display:inline;font-weight:normal;">Credit</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="pay_mode" id="cash_pay" type="radio" value="CASH">&nbsp;<label for="cash_pay" style="display:inline;font-weight:normal;">Cash</label></td>		
	</tr>
	<tr>
		<td>Supplier <font color='red' size='5px'> *</font></td>
		<td colspan="3"><select name='party_name' id='party_name' >
							<option value='default'>Select</option>
							<?php foreach($supp_list as $pdt){ ?>
							<option value="<?php echo $pdt["supplier_name"];?>" ><?php echo $pdt["supplier_name"];?></option>
							<?php } ?>
							
						</select>
					<!-- onchange='get_supplier_prod(this.value)' -->	
		</td>		
		
	</tr>
</table>
</div>
<input type="hidden" name="count" value="1" id="count" >
<div align="center" style="min-height:100px;height:auto;margin:10px 0px 0px 10px;">
<table border="0" id="oth_pur_tbl" style="width:80%;border-radius:15px;border:0px solid green;" class='oth_pur_tbl' align="center">
	<tr align="center" bgcolor='#559999' style='color:white;'>
		<td width="">Item Name</td>
		<td width="">Quantity &nbsp;&nbsp;(Ltrs)</td>
		<td width="">Rate &nbsp;&nbsp;(Rs)</td>
		<td width="">Amount &nbsp;&nbsp;(Rs)</td> 
	</tr>
	<tr align="center">
		<td><select name="item1" id="item1" style="width:100%" onchange='javascript:fetch_comm_rate(this.value,1)' >
		 	<option value="default">Select</option>
			<?php foreach($pdt_list as $pdt){ ?>
			<option value="<?php echo $pdt["product_name"];?>" ><?php echo $pdt["product_name"];?></option>
			<?php } ?>  
			</select>
		</td>
		<td><input type="text" name="qty1" id="qty1" onkeypress="return isFloatKey(event)" value="0" style="width:50px;text-align:right" onchange="javascript:cal_amt(this.value,1)"/></td>
		<td><input type="text" name="rate1" id="rate1" onkeypress="return isFloatKey(event)" value="0" style="width:50px;text-align:right" onchange="javascript:cal_amt(this.value,1)"/></td>
		<td><input type="text" name="val1" id="val1" onkeypress="return isFloatKey(event)" value="0" style="width:70px;text-align:right" onchange="javascript:cal_amt(this.value,1)"/></td>
	</tr>
</table>
<p align="right"  style="margin-right:40px;">
<a href="javascript:opp_addrow()" class="add_link" id="add_link">
<img   alt="add_another_row"  src="<?php echo base_url();?>images/plus.png" title='Add Another Row' class="add"  /></a>
<!-- <input type="button" value="Add another Row" name="addItem" id="addItem" style="width:150px;margin-right:30px;"onclick="javascript:opp_addrow()"/> -->
</p>
</div>
<!-- <div style="width:60%;margin:10px 30px 20px 10px;float:left;" > -->
<table  width="60%" style="" cellpadding="0" cellspacing="0" align="right" >
	<tr >
		<td width="70%" align="right">Total &nbsp;&nbsp;(Rs)</td>
		<td width="30%" align="left"><input type="text" name="total" id="total" value="0" readonly="readonly" style="width:80px;text-align:right;"/></td>
	</tr>
	
	<tr >
		<td width="70%" align="right">Scheme Discount %<input type="text" name="sch_disc" id="sch_disc" value="0" onkeypress="return isFloatKey(event)" onblur="javascript:grand_tot(this.value)"  style="width:40px;text-align:right;"/></td>
		<td width="30%" align="left"><input type="text" name="sch_disc_amt" id="sch_disc_amt" value="0" onkeypress="return isFloatKey(event)" style="width:80px;text-align:right;onblur="" onkeyup="javascript:crt_amt(this.value,1,event)" /></td>
	</tr>
	<tr >
		<td width="70%" align="right">Cash Discount % <input type="text" name="cash_disc" id="cash_disc" onkeypress="return isFloatKey(event)" value="0" onblur="javascript:grand_tot(this.value)"   style="width:40px;text-align:right;"/></td>
		<td width="30%" align="left"><input type="text" name="cash_disc_amt" id="cash_disc_amt" value="0" onkeypress="return isFloatKey(event)" style="width:80px;text-align:right;onblur="" onkeyup="javascript:crt_amt(this.value,1,event)" /></td>
	</tr>
	<tr >
		<td width="70%" align="right">VAT Tax %<input type="text" name="vat" id="vat" value="0" onkeypress="return isFloatKey(event)" onblur="javascript:grand_tot(this.value)" style="width:40px;text-align:right;"/></td>
		<td width="30%" align="left"><input type="text" name="vat_amt" id="vat_amt" value="0" onkeypress="return isFloatKey(event)" style="width:80px;text-align:right;onblur="" onkeyup="javascript:crt_amt(this.value,1,event)" /></td>
	</tr>
	<tr >
		<td width="70%" align="right">Others &nbsp;&nbsp;(Rs)</td>
		<td width="30%" align="left"><input type="text" name="other_amt" id="other_amt" onkeypress="return isFloatKey(event)" value="0" onblur="javascript:grand_tot(this.value)" style="width:80px;text-align:right;"/></td>
	</tr>
	
	<tr align="right">
		<td width="70%" align="right"><font style="font-size:18px;">Grand Total &nbsp;&nbsp;(Rs)</font></td>
		<td width="30%" align="left"><input type="text" name="grnd_tot" id="grnd_tot" value="0" readonly="readonly" style="width:80px;text-align:right;font-size:18px"/></td>
	</tr>
</table>
<input type="button" value="Register" style="width:70px;margin:10px 80px 30px 400px;" onclick="javascript:other_form_valid()"/>

</form>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/purchase.js"></script>