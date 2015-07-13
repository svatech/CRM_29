<!-- <div  style="height:auto;overflow:hidden;background:#006666;margin:30px;width:1000px;min-height:80px;border:0px solid black ;border-radius:10px;">
<p style="margin-left:80%;padding-top:5px;line-height:0.5em;color:white;">User: <b><?php echo $this->session->userdata('fullname');?></b>&nbsp;&nbsp;<img src="../../images/rightarrow1.png" width="10px" height="10px;"/>&nbsp;&nbsp;&nbsp;<strong>
 <a href="<?php echo site_url("logincheck/logout"); ?>" style="color:white;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='white'">Logout</a></strong></p>
<center style="margin-bottom:20px;font-size:20pt;color:white;position:inline;">Users Details</center>
 </div>
  -->
  <div class='lengthy_form'>
<div style="margin-left: 40px;margin-top:10px;"><font size="2px">Search by Name</font>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" class="input" name="user" id="user"  style="width:125px;height:24px;" onkeyup="javascript:searchbyname()" >
			</div>
			<div style="margin-left: 75%;color:#4c0000;font-weight:bold;"><a  href="<?php echo site_url("users/add_new_user");?>"><font color='#4c0000' size="3px" >Add New User</font></a> </div>
			<hr width="100%">


			<div style="height:90%;overflow:scroll;">
			<table border="0" width="100%">
			<tr bgcolor="#559999">
			<td align="center" width="17%" style="border-right:1px solid white;"><font class="txt1_color">Name</font></td>
			<td align="center" width="15%" style="border-right:1px solid white;"><font class="txt1_color">Username</font></td>
			<td align="center" width="15%" style="border-right:1px solid white;"><font class="txt1_color">Phone Number</font></td>
			<td align="center" width="8%" style="border-right:1px solid white;"><font class="txt1_color">User Role</font></td>
			<td align="center" width="10%" style="border-right:1px solid white;"><font class="txt1_color">Added By</font></td>
			<td align="center" width="15%" style="border-right:1px solid white;"><font class="txt1_color">Added Date</font></td>
			<td align="center" width="15%" style="border-right:1px solid white;"><font class="txt1_color">Last Login time</font></td>
			<td align="center" width="5%"><font  class="txt1_color">Modify</font></td>
			</tr>
			</table>
			

<?php
   $counter=0;
   print("<table width='100%' border='1' align='left' cellpadding='1' cellspacing='1' style='margin-bottom:20px'>");
   foreach($users as $row) {
   		$counter++;     	
     	$rowid="row".$counter;
     	print("<tr id='$rowid' class='td_rows'>");
        $name_id="name".$counter;  
        print("<td width='17%'  ><input type='text' height='' style='margin-left:0px;' class='plain_txt' id='$name_id'  value='".$row->name."' /></td>");
        $uname_id="uname".$counter;
        print("<td width='15%'><input type='text' style='' class='plain_txt' readonly='readonly' id='$uname_id' value='".$row->user_email."' /></td>");
    	$phone_id="phone".$counter;
        print("<td width='15%'><input type='text' style='' class='plain_txt' readonly='readonly' id='$phone_id' value='".$row->phone_number."' /></td>");
        $role_id="role".$counter;
        print("<td width='8%'><input type='text' style='' class='plain_txt' readonly='readonly' id='$role_id' value='".ucfirst($row->user_role)."'/></td>");
   		$addedby_id="added_by".$counter;
        print("<td width='10%'><input type='text' style='' class='plain_txt' readonly='readonly' id='$addedby_id' value='".$row->added_by."' /></td>");
		$addeddate_id="added_date".$counter;
        print("<td width='15%'><input type='text'  style='' class='plain_txt' readonly='readonly' id='$addeddate_id' value='".$row->user_date."' /></td>");
        $lastlogin_id="last_login".$counter;
        print("<td width='15%'><input type='text'  style='' class='plain_txt' readonly='readonly' id='$lastlogin_id' value='".$row->user_last_login."' /></td>");
        $edit_id="edit".$counter;
        print("<td width='5%'><a style='' href='javascript:updateuser(\"".$row->user_id."\");' id='edit_id'><font color=''>Edit </font></a></td>");
		print("</tr>");    	

   }
print("</table>");  
echo "<input type='hidden' id='hrowcount' value='$counter' />";
?>  
</div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/users.js"></script>