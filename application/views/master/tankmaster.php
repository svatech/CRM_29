<!-- <div  style="height:auto;overflow:hidden;background:#006666;margin:30px;width:1000px;min-height:80px;border:0px solid black ;border-radius:10px;">
<p style="margin-left:80%;padding-top:5px;line-height:0.5em;color:white;">User: <b><?php echo $this->session->userdata('fullname');?></b>&nbsp;&nbsp;<img src="../../images/rightarrow1.png" width="10px" height="10px;"/>&nbsp;&nbsp;&nbsp;<strong>
 <a href="<?php echo site_url("logincheck/logout"); ?>" style="color:white;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='white'">Logout</a></strong></p>
<center style="margin-bottom:20px;font-size:20pt;color:white;position:inline;">Tank Master</center>
 </div>
  -->
 <form name="tankform" id="tankform" method="post" action="<?php echo site_url("master/tank_details"); ?>" > 
<div class='short_form'>
<p style="height:40px;padding:20px 0px 0px 20px;" align="center"><span style="font-weight:bolder;font-size:18pt;color:#4c0000;">New Tank Entry </span></p>
<hr width="100%">
<div align="center" style="margin:20px 0px 0px 10px;">
<p style="height:20px;margin-left:20px;padding:0px 30px 0px 0px;" align="right"><span style="font-size:11pt;color:red;">* Required Fields </span></p>
<table style="width:80%" border="0">
	<tr style="height:0%;">
		<td width="100px" ><font class="font_align">Tank Name</font><font color='red' size='5px'> *</font></td>
		<td ><input name="tank_no" id="tank_no" class="input" type="text" style="width:75px;height:18px; value="" onblur="javascript:check_tank()" style="border-color:#E8A317;">
		
			<img id='incorrect' height=16px width=15px style='display: none' src='<?php echo  base_url();?>images/delete.png' /> 
			<img id='correct' height=16px width=15px style='display: none' src='<?php echo  base_url();?>images/accept.png' /></td>	
	</tr>
	
	<tr>
		<td ><font class="font_align">Capacity&nbsp;&nbsp;</font><span style="font-size:11px;" >(in Ltrs)</span><font color='red' size='5px'> *</font></td>
		<td colspan=""><input name="capacity" id="capacity"  class="input" type="text" style="width:75px;height:18px; value="" onkeypress="return isFloatKey(event)">	
		</td>	
	</tr>
	<tr>
		<td ><font class="font_align">Status</font><font color='red' size='5px'> *</font></td>
		<td colspan=""><select name="status" id="status"  style="width:78px;height:24px;">
			<option value="">Select</option>
			<option value="1">Active</option>
			<option value="0">Inactive</option></select></td>			
	</tr>
	
	
	<tr>
		<td ><font class="font_align">Product Name</font><font color='red' size='5px'> *</font></td>
		<td colspan="" width="130px"><select name="prod_name" id="prod_name"  style="width:125px;height:24px;">
			<option value="">Please Select</option>
			<?php foreach ($prod as $prod_list) {?>
			<option value="<?php echo $prod_list->PRODUCT_NAME;?>"><?php echo $prod_list->PRODUCT_NAME;?></option>
			<?php  } ?>
			</select></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input style="width:90px" class="button" value="Register" id="button" type="button"  onclick="javascript:tank_form()"></td></tr>
</table>
</div>
</div>
</form>
<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/master_validation.js"></script>