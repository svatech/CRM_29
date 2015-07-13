<link rel="stylesheet" type="text/css" href="../../../css/mystyle.css">
<table style="width:100%" border="0">
	<?php foreach($user_info as $row){ ?> 
	<tr>	
	<td><font class="font_align">Username &nbsp;&nbsp;</font><span style="font-size:11px;" ></span></td>
		 <td><?php print("<input name='username' id='username' class='input' readonly='readonly' type='text' style='width:75px;' value='".$row->user_email."'>")
		 ?></td>
	</tr>
	
	<tr>
		<td width=""><font class="font_align">Name</font></td>
		
		 <td><?php print("<input name='u_name' id='u_name' class='input'  type='text' style='width:150px;' value='".$row->name."'>")
		 ?>	</td>
	</tr>
	<tr>
		<td><font class="font_align">Change Password &nbsp;&nbsp;</font><span style="font-size:11px;" ></span></td>
		 <td><?php print("<input name='passwd' id='passwd' class='input'  type='password' style='width:150px;' value=''>")
		 ?></td>
	</tr>
	<tr>
		<td><font class="font_align">Confirm Password &nbsp;&nbsp;</font><span style="font-size:11px;" ></span></td>
		 <td><?php print("<input name='cpasswd' id='cpasswd' class='input'  type='password' style='width:150px;' value=''>")
		 ?></td>
	</tr>

	
	<tr>
		<td><font class="font_align">Phone Number &nbsp;&nbsp;</font><span style="font-size:11px;" ></span></td>
		 <td><?php print("<input name='ph_num' id='ph_num' class='input'  type='text' style='width:150px;' value='".$row->phone_number."'>")
		 ?></td>
	</tr>
	<tr>
		<td><font class="font_align">User Role &nbsp;&nbsp;</font><span style="font-size:11px;" ></span></td>
		 <td><select name="userrole" id="userrole" style="width:100%" >
			<option value="cashier" <?php if($row->user_role=='cashier'){echo "selected";}?> >Cashier</option>
			<option value="manager" <?php if($row->user_role=='manager'){echo "selected";}?> >Manager</option>
			<option value="admin" <?php if($row->user_role=='admin'){echo "selected";}?> >Admin</option>
			</select>
		</td>
	</tr>
	
 	
	
<?php } ?>
	</table>
	