<!-- <div  style="height:auto;overflow:hidden;background:#006666;margin:30px;width:1000px;min-height:80px;border:0px solid black ;border-radius:10px;">
<p style="margin-left:80%;padding-top:5px;line-height:0.5em;color:white;">User: <b><?php echo $this->session->userdata('fullname');?></b>&nbsp;&nbsp;<img src="../../images/rightarrow1.png" width="10px" height="10px;"/>&nbsp;&nbsp;&nbsp;<strong>
 <a href="<?php echo site_url("logincheck/logout"); ?>" style="color:white;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='white'">Logout</a></strong></p>
<center style="margin-bottom:20px;font-size:20pt;color:white;position:inline;">Add New User</center>
 </div> -->
 <form name="userform" id="userform" method="post" action="<?php echo site_url("logincheck/create"); ?>" > 
<div style="width:550px;height:auto;overflow:hidden;min-height:350px; background:#CCCCCC;margin:40px 0px 0px 25%;border:1px solid black ;border-radius:10px;">
<p style="height:40px;padding:20px 0px 0px 20px;color:#4c0000" align="center"><span style="font-weight:bolder;font-size:18pt;">New User Entry </span></p>
<hr width="100%">
<div align="center" style="margin:10px 0px 0px 0px;">
<p style="height:20px;margin-left:20px;padding:0px 30px 0px 0px;" align="right"><span style="font-size:11pt;color:red;">* Required Fields </span></p>
<table style="width:80%" border="0">
	<tr>
		<td ><font class="font_align">Name</font><font color='red' size='5px'> *</font></td>
		<td><input name="u_name" id="u_name" class="input" type="text" style="width:150px;height:18px;" value="" ></td>		
	</tr>
	<tr style="height:0%;">
		<td width="40%" ><font class="font_align">Username</font><font color='red' size='5px'> *</font></td>
		<td ><input name="username" id="username" class="input" type="text" style="width:150px;height:18px;" value="" onblur="javascript:check_username()"></td>
		
		<td>	<img id='incorrect' height=16px width=15px style='display: none' src='<?php echo  base_url();?>images/delete.png' /> 
			<img id='correct' height=16px width=15px style='display: none' src='<?php echo  base_url();?>images/accept.png' /></td>	
	</tr>
	<tr>
		<td ><font class="font_align">Password</font><font color='red' size='5px'> *</font></td>
		<td><input name="passwd" id="passwd" class="input" type="password" style="width:150px;height:18px;" value="" onkeyup="check_passwd()"></td>		
	</tr>
	<tr>
		<td ><font class="font_align">Confirm Password</font><font color='red' size='5px'> *</font></td>
		<td><input name="cpasswd" id="cpasswd" class="input" type="password" style="width:150px;height:18px;" value="" onkeyup="check_passwd()"></td>		
		<td id='passwd_match'></td>
	</tr>
	<tr>
		<td ><font class="font_align">Phone Number</font></td>
		<td><input name="ph_num" id="ph_num" class="input" type="text" style="width:150px;height:18px;" value="" ></td>		
	</tr>
	
	<tr>
		<td ><font class="font_align">User Role</font><font color='red' size='5px'> *</font></td>
		<td><select name="userrole" id="userrole"  style="width:100px;height:24px;">
			<option value="cashier">Cashier</option>
			<option value="manager">Manager</option>
			<option value="admin">Admin</option></select>
		</td>		
	</tr>
	
	<tr>
		<td colspan="2" align="center" ><input style="width:100px" class="button" value="Add User" id="button" type="button"  onclick="javascript:user_form()">
		</td>
	</tr>
		
 		</table>
</div>
</div>
</form>
<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/users.js"></script>