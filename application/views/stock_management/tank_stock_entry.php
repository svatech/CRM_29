<!-- <div  style="height:auto;overflow:hidden;background:#006666;margin:30px;width:1000px;min-height:80px;border:0px solid black ;border-radius:10px;">
<p style="margin-left:80%;padding-top:5px;line-height:0.5em;color:white;">User: <b><?php echo $this->session->userdata('fullname');?></b>&nbsp;&nbsp;<img src="../../images/rightarrow1.png" width="10px" height="10px;"/>&nbsp;&nbsp;&nbsp;<strong>
 <a href="<?php echo site_url("logincheck/logout"); ?>" style="color:white;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='white'">Logout</a></strong></p>
<center style="margin-bottom:20px;font-size:20pt;color:white;position:inline;">Stock Management</center>
 </div>
 
  -->
 	<form name="tank_stock_form" id="tank_stock_form" method="post" action="<?php echo site_url("stock/tank_stock_details"); ?>" > 
	<div class='short_form'>
	<p style="height:40px; color:#4c0000;padding:20px 0px 0px 20px;" align="center"><span style="font-weight:bolder;font-size:18pt;">Tank Stock Entry </span></p>
	<hr width="100%">

	<input type="hidden" name="count" id="count" value="0"/>
	<div align="center" style="margin:10px 0px 0px 10px;">
	<p style="height:20px;margin-left:20px;padding:0px 30px 0px 0px;" align="right"><span style="font-size:11pt;color:red;">* Required Fields </span></p>
	<table style="width:80%" border="0"  >
	<tr>
		<td width=""><font class="font_align">Account Date</font></td>
		<td><input name="acct_date" class="input" id="acct_date" type="text" style="width:125px;height:18px; value="" /></td>			
	</tr>
	<tr>
		<td width="150px"><font class="font_align">Tank Name</font><font color='red' size='5px'> *</font></td>
		<td><select name="tank_no" id="tank_no" style="height:25px;width:auto;" onchange="javascript:get_product(this.value)" >
			<option value="">Select</option>	
			<?php foreach($tankdetails as $tank_details){?>
			<option value="<?php echo $tank_details->tank_no; ?>"><?php echo $tank_details->tank_no; ?></option>
			<?php  }?>
			</select><img id='incorrect' height=16px width=15px style='display: none' src='<?php echo  base_url();?>images/delete.png' /> 
			<img id='correct' height=16px width=15px style='display: none' src='<?php echo  base_url();?>images/accept.png' /></td>	</tr>
	
	<tr>
		<td width=""><font class="font_align">Product</font></td>
		<td><input name="product" class="input" id="product" type="text" readonly='readonly' style="width:125px;height:18px; value="" /></td>			
	</tr>
	<tr>
		<td width=""><font class="font_align">Volume (Ltrs)</font><font color='red' size='5px'> *</font></td>
		<td><input name="volume" class="input" id="volume" type="text" onkeypress="return isFloatKey(event)" style="width:100px;height:18px; value="" /></td>			
	</tr>
	<tr>
		<td width=""><font class="font_align">Dip Level(cms)</font></td>
		<td><input name="dip_level" class="input" id="dip_level" type="text" onkeypress="return isFloatKey(event)" style="width:100px;height:18px; value="" /></td>			
	</tr>
	<tr>
		<td width=""><font class="font_align">Water Level(cms)</font></td>
		<td><input name="water_level" class="input" id="water_level" type="text" onkeypress="return isFloatKey(event)" style="width:100px;height:18px; value="" /></td>			
	</tr>
	<tr>
		<td width=""><font class="font_align">Density at 15&deg;C</font></td>
		<td><input name="density" class="input" id="density" type="text" onkeypress="return isFloatKey(event)" style="width:100px;height:18px; value="" /></td>			
	</tr>
	<tr>
		<td width=""><font class="font_align">Actual Temp Density</font></td>
		<td><input name="act_density" class="input" id="act_density" type="text" onkeypress="return isFloatKey(event)" style="width:100px;height:18px; value="" /></td>			
	</tr>
	<tr>
		<td width=""><font class="font_align">Actual Temp (&deg;C)</font></td>
		<td><input name="act_temp" class="input" id="act_temp" type="text" onkeypress="return isFloatKey(event)" style="width:100px;height:18px; value="" /></td>			
	</tr>
	<tr>
		<td colspan="2" align="center"><input style="width:90px" class="button" value="Register" id="button" type="button"  onclick="javascript:tank_details_validation();"></td></tr>
		
</table>
</div>
</div>
</form>
<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/stock_entry.js"></script>
