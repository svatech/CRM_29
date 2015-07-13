<!-- <div  style="height:auto;overflow:hidden;background:#006666;margin:30px;width:1000px;min-height:80px;border:0px solid black ;border-radius:10px;">
<p style="margin-left:80%;padding-top:5px;line-height:0.5em;color:white">User: <b><?php echo $this->session->userdata('fullname');?></b>&nbsp;&nbsp;<img src="../../images/rightarrow1.png" width="10px" height="10px;"/>&nbsp;&nbsp;&nbsp;<strong>
 <a href="<?php echo site_url("logincheck/logout"); ?>" style="color:white;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='black'">Logout</a></strong></p>
<center style="margin-bottom:20px;font-size:20pt;position:inline;color:white">Indent Customer Master</center>
 </div>
  -->
 <form name="customerform" id="tankform" method="post" action="<?php echo site_url("master/customer_details"); ?>" > 
<div class='short_form'>
<p style="height:40px;padding:20px 0px 0px 20px;" align="center"><span style="font-weight:bolder;font-size:18pt;color:#4c0000">Indent Customer Entry </span></p>
<hr width="100%">
<div align="center" style="margin:20px 0px 0px 0px;">
<p style="height:20px;margin-left:20px;padding:0px 30px 0px 0px;" align="right"><span style="font-size:11pt;color:red;">* Required Fields </span></p>
<table style="width:100%" border="0">
	<tr style="height:0%;">
		<td width="40%" ><font class="font_align">Customer Name</font><font color='red' size='5px'> *</font></td>
		<td ><textarea name="cust_name" id="cust_name" rows="2" cols="50" class="txtarea" onblur="javascript:check_customer()" ></textarea></td>
		
		<td>	<img id='incorrect' height=16px width=15px style='display: none' src='<?php echo  base_url();?>images/delete.png' /> 
			<img id='correct' height=16px width=15px style='display: none' src='<?php echo  base_url();?>images/accept.png' /></td>	
	</tr>
	
	<tr>
		<td ><font class="font_align">Address&nbsp;&nbsp;</font><font color='red' size='5px'> *</font><span style="font-size:11px;" ></span></td>
		<td ><textarea name="addr" id="addr" rows="4" cols="50"  class="txtarea" onblur='javascript:check_address()'></textarea>	</td>
	</tr>
	<tr>
		<td ><font class="font_align">Phone Number</font></td>
		<td><input name="ph_num" id="ph_num" class="input" type="text" style="width:150px;height:18px;" value="" ></td>		
	</tr>
	 
	
	<tr>
		<td ><font class="font_align">TIN</font></td>
		<td><input name="tin" id="tin" class="input" type="text" style="width:150px;height:18px;" value="" ></td>		
	</tr>
	<tr>
		<td><font class="font_align">DOB</font></td>
		<td><input name="indent_dob" id="indent_dob" type="text" style="width:150px;height:18px;" value=""></td>
    </tr>
	
	<tr>
		<td ><font class="font_align">Vehicle Number</font><font color='red' size='5px'> *</font></td>
		<td><textarea name="vehicle" id="vehicle" rows="2" cols="50"  class="txtarea"></textarea></td>		
	</tr>
	<tr>
	<td ><font class="font_align">Initial Deposit (Rs)</font></td>
		<td><input name="initial_deposit" id="initial_deposit" onkeypress="return isFloatKey(event)"  class="input" type="text" style="width:150px;height:18px;" value="" ></td>	
	</tr>
	<tr>
	<td ><font class="font_align">Indent No (Start)</font><font color='red' size='5px'> *</font></td>
		<td><input name="indent_no_start" id="indent_no_start" onkeypress="return isFloatKey(event)" class="input" type="text" style="width:150px;height:18px;" value="" ></td>	
	</tr>
	<tr>
	<td ><font class="font_align">Indent No (End)</font><font color='red' size='5px'> *</font></td>
		<td><input name="indent_no_end" id="indent_no_end" onkeypress="return isFloatKey(event)" class="input" type="text" style="width:150px;height:18px;" value="" ></td>	
	</tr>
	
	<tr>
	<td ><font class="font_align">Indent Limit (Rs)</font><font color='red' size='5px'> *</font></td>
		<td><input name="indent_limit" id="indent_limit" onkeypress="return isFloatKey(event)" class="input" type="text" style="width:150px;height:18px;" value="" ></td>	
	</tr>
	<tr>
	<td ><font class="font_align">Opening Balance (Rs)</font><font color='red' size='5px'> *</font></td>
		<td><input name="open_bal" id="open_bal" onkeypress="return isFloatKey(event)" class="input" type="text" style="width:150px;height:18px;" value="" ></td>	
	</tr>
	<tr>
	<td ><font class="font_align">Status</font><font color='red' size='5px'> *</font></td>
		<td><select name='status' id='status'>
			<option value='ACTIVE'>Active</option>
			<option value='BLOCKED'>Blocked</option>
			<option value='INACTIVE'>Inactive</option>
		</select>
		</td>	
	</tr>
	<tr>
		<td colspan="2" align="center"><input style="width:100px" class="button" value="Register" id="button" type="button"  onclick="javascript:customer_form()"></td></tr>
		<?php foreach($customerid as $item){
		$cust= $item->cust_id ;
		$arr=str_split($cust,4);  
 		$sec=$arr[1]+1 ;
		if($sec <10 )
		{
		$sec="000".$sec;
		}else if($sec <100 )	
		{
		$sec="00".$sec;
		}else if($sec <1000 )
		{	
		$sec="0".$sec;
		}
 		 $cust_id=$arr[0].$sec;
		} ?>
 		<tr> <td><input type="hidden" value="<?php echo $cust?>" id="current_custid" name="current_custid" > </td><td><input type="hidden" value="<?php echo $cust_id?>" id="next_custid" name="next_custid" > </td>
 		 </tr></table>
</div>
</div>
</form>
<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/master_validation.js"></script>