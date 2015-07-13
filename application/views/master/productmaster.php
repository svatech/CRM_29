<!-- <div  style="height:auto;overflow:hidden;background:#006666;margin:30px;width:1000px;min-height:80px;border:0px solid black ;border-radius:10px;">
<p style="margin-left:80%;padding-top:5px;line-height:0.5em;color:white;">User: <b><?php echo $this->session->userdata('fullname');?></b>&nbsp;&nbsp;<img src="../../images/rightarrow1.png" width="10px" height="10px;"/>&nbsp;&nbsp;&nbsp;<strong>
 <a href="<?php echo site_url("logincheck/logout"); ?>" style="color:white;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='white'">Logout</a></strong></p>
<center style="margin-bottom:20px;font-size:20pt;color:white;position:inline;">Product Master</center>
 </div>
  -->
<form name="productform" id="productform" method="post" action="<?php echo site_url("master/product_details"); ?>" > 
<div class='short_form'>
<p style="height:40px;padding:20px 0px 0px 20px;" align="center"><span style="font-weight:bolder;font-size:18pt;color:#4c0000">New Product Entry </span></p>
<hr width="100%">
<div align="center" style="margin:20px 0px 0px 100px;">
<p style="height:20px;margin-left:20px;padding:0px 30px 0px 0px;" align="right"><span style="font-size:11pt;color:red;">* Required Fields </span></p>
<table style="width:100%" border="0">
	<tr>
		<td  width="60%"><font class="font_align">Product Name</font><font color='red' size='5px'> *</font></td>
		<td><input name="prod_name" id="prod_name" class="input" type="text" style="width:150px;height:18px; value="" onblur="javascript:check_product()"></td>
			<td><img id='incorrect' height=16px width=15px style='display: none' src='<?php echo  base_url();?>images/delete.png' /> 
			<img id='correct' height=16px width=15px style='display: none' src='<?php echo  base_url();?>images/accept.png' /></td>	
	</tr>
	
	<tr>
		<td width=""><font class="font_align">Product Rate</font><font color='red' size='5px'> *</font></td>
		<td><input name="prod_rate" class="input" id="prod_rate" type="text" onkeypress="return isFloatKey(event)" style="width:75px;height:18px; value=""></td>			
	</tr>
	<tr>
		<td><font class="font_align">Status</font><font color='red' size='5px'> *</font></td>
		<td><select name="status" id="status"  style="width:78px;height:24px;">
			<option value="">Select</option>
			<option value="1">Active</option>
			<option value="0">Inactive</option></select></td>			
	</tr>
	
	
	<tr>
		<td><font class="font_align">Category</font></td>
		<td><select name="category" id="category"  style="width:80px;height:25px; value="" onchange="javascript:enterstock()">
		<?php foreach ($category as $ctg){?>
		<option value="<?php echo $ctg->category; ?>"><?php echo $ctg->category; ?></option>
		<?php } ?>
		</select>
		</td>
		<td width="200px"><input type="checkbox" name="tank_product" id="tank_product" value="1" ><font class="font_align">Tank Product</font></td>
	</tr>
	<tr style="display:none" id="stock_row">
		<td width=""><font class="font_align">Opening Stock</font></td>
		<td><input name="stock" class="input" id="stock" type="text" onkeypress="return isFloatKey(event)" style="width:75px;height:18px;" value=""></td>			
	</tr>
	<tr>
		<td colspan="2" align="center"><input style="width:100px" class="button" value="Register" id="button" type="button"  onclick="javascript:product_form()"></td></tr>
</table>
</div>
</div>
</form>
<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/master_validation.js"></script>