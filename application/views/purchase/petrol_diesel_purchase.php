<!--  <div  style="height:auto;overflow:hidden;background:#006666;margin:30px;width:1000px;min-height:80px;border:0px solid black ;border-radius:10px;">
<p style="margin-left:80%;padding-top:5px;line-height:0.5em;color:white;">User: <b><?php echo $this->session->userdata('fullname');?></b>&nbsp;&nbsp;<img src="../../images/rightarrow1.png" width="10px" height="10px;"/>&nbsp;&nbsp;&nbsp;<strong>
 <a href="<?php echo site_url("logincheck/logout"); ?>" style="color:white;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='white'">Logout</a></strong></p>
<center style="margin-bottom:20px;font-size:20pt;color:white;position:inline;">Petrol Diesel Purchase Entry</center>
 </div>
  --> 
<div class='lengthy_form' style='height:auto;'>
<form name="pet_pur_form" id="pet_pur_form" method="post" action="<?php echo site_url("purchase/petrol_pur"); ?>" >
<p style="height:25px;color:#4c0000;padding:10px 0px 0px 20px;" align="center"><span style="font-weight:bolder;font-size:20pt;">Purchase Information</span></p>
<hr width="100%">
<div align="center" style="margin:10px 0px 0px 10px;">
<?php foreach ($bill_nos as $no); ?>
<p style="height:20px;margin-left:20px;padding:0px 10px 0px 0px;" align="right"><span style="font-size:11pt;color:red;">* Required Fields </span></p>
<table style="width:80%">
	<tr>
		<td>Voucher No <font color='red' size='5px'> *</font></td>
		<td><input name="voucher_no" id="voucher_no" type="text" readonly="readonly" value="<?php echo $no['petrol_voucher'];?>" style="width:100px;height:20px;"></td>
		<td>Delivery Date <font color='red' size='5px'> *</font></td>
		<td><input name="acct_date" id="acct_date" type="text" style="width:100px;height:20px;" ></td>	
	</tr>
	
	<tr>
		<td>Invoice No <font color='red' size='5px'> *</font></td>
		<td><input name="inv_no" id="inv_no" type="text" style="width:100px;height:20px;"></td>
		<td>Invoice Date <font color='red' size='5px'> *</font></td>
		<td><input name="inv_date" id="inv_date" type="text" style="width:100px;height:20px;"></td>
	</tr>
	
	<tr>
		<td>Supplier Name <font color='red' size='5px'> *</font></td>
		<td colspan='3'><select name="party_name" id="party_name" style="width:250px;height:25px;">
			<option value='INDIAN OIL CORPORATION'>INDIAN OIL CORPORATION</option>	
			</select>
		</td>
	</tr>
</table>

</div>
<input type="hidden" name="count" value="1" id="count" >
<input type="hidden" name="tnk_count" value="1" id="tnk_count" >
<div align="center" style="min-height:100px;height:auto;margin:20px 0px 0px 10px;">
<table border="0" id="pet_pur_tbl" style="width:90%;border-radius:0px;border:0px solid green;" class='pet_pur_tbl' align="center">
	<tr align="center" bgcolor='#559999' style='color:white;'>
		<td width="" >Item Name</td>
		<td width="">Litres&nbsp;&nbsp;(Ltrs)</td>
		<td width="">Amount&nbsp;&nbsp;(Rs)</td>
		<td width="">Inv. Density</td>
		<td width="">Obs. Density</td> 
		
	</tr>
	
	<tr align="center">
		<td><select name="item1" id="item1" style="width:100%" onchange='' >
			<option value="default">Select</option>
			<?php foreach($pdt_list as $pdt){ ?>
			<option value="<?php echo $pdt["product_name"];?>" ><?php echo $pdt["product_name"];?></option>
			<?php } ?>
			</select>
		</td>
		<td><input type="text" name="qty1" id="qty1" onkeypress="return isFloatKey(event)" value="0" style="width:50px;text-align:right" onblur='javascript:check_qty(this.value,1)'  onkeyup="calculate_amount(this.value,'1')"/></td>
		<td><input type="text" name="val1" id="val1" onkeypress="return isFloatKey(event)" value="0" style="width:70px;text-align:right" onblur="javascript:tot_amt(this.value,1)"/></td>
		<td><input type="text" name="inv_den1" onkeypress="return isFloatKey(event)" id="inv_den1" value="0" style="width:50px;text-align:right" /></td>
		<td><input type="text" name="del_den1" onkeypress="return isFloatKey(event)" id="del_den1" value="0" style="width:50px;text-align:right"  onblur="check_density(this.value,'1')"/></td>
		<td><input type="hidden" name="status"  id="status" value="" style="width:50px;text-align:right"  /></td>
	</tr>
	
	

</table>
<p align="right"  style="margin-right:70px;">
<a href="javascript:addrow()" class="add_link" id="add_link">
<img   alt="add_another_row"  src="<?php echo base_url();?>images/plus.png" title='Add Another Row' class="add"  /></a>
	<!--  <input type="button" value="Add another Row" name="addItem" id="addItem" style="width:150px;margin-right:30px;"onclick="javascript:addrow()"/> -->
</p>
</div>
<p align="right" style="margin-right:250px;"><font style="font-size:18px;">Grand Total&nbsp;&nbsp;(Rs)&nbsp;&nbsp;</font><input type="text" name="total" id="total" value="0" readonly="readonly" style="width:100px;font-size:18px;"/></p>
<hr width="100%">
<div align="center" style="min-height:100px;height:auto;margin:10px 0px 0px 10px;">
<table border="0" id="tank_split_table" style="width:60%;border-radius:0px;border:0px solid green;" class='tank_split_table' align="center">
	<tr><th colspan='3'>Product Unloading Split up Details</th></tr>
	<tr><td colspan='3'></td></tr>
	<tr align="center" bgcolor='#559999' style='color:white;'>
		<th width="">Tank Name</th>
		<th width="">Product Name</th>
		<th width="">Qty (Ltrs)</th>
		</tr>
	<tr align="center">
	<td><select name="tnk1" id="tnk1" style="width:100%" onblur="javascript:get_tnk_pdt(this.value,1)" onchange="javascript:get_tnk_pdt(this.value,1)">
			<option value="default">Select</option>
			<?php foreach($tank_list as $tnk){ ?>
			<option value="<?php echo $tnk["tank_no"];?>" ><?php echo $tnk["tank_no"];?></option>
			<?php } ?>
			</select>
		</td>
	<td>
		<input type="text" name="pdt1" id="pdt1" value="" style="width:70px;" onchange=""/>
	</td>
	<td>
		<input type="text" name="ltrs1" id="ltrs1" value="0" onkeypress="return isFloatKey(event)" style="width:70px;text-align:right" onchange=""/></td>
	</tr>
</table>
<p align="right"  style="margin-right:170px;">
<a href="javascript:addnewrow()" class="add_link" id="add_link">
<img   alt="add_another_row"  src="<?php echo base_url();?>images/plus.png" title='Add Another Row' class="add"  /></a>

	<!--  <input type="button" value="Add another Row" name="addnewItem" id="addnewItem" style="width:150px;margin-right:30px;"onclick="javascript:addnewrow()"/>  -->
</p>
</div>
<p align="center"  ><input type="button" value="Register" style="width:70px;margin-right:80px;" onclick="javascript:pet_form_valid()"/></p>
</form>

</div>
<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/purchase.js"></script>