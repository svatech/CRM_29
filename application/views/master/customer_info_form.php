<link rel="stylesheet" type="text/css" href="../../../css/mystyle.css">
<table style="width:100%" border="0">
	<tr><?php foreach($customer_info as $row){ ?> 
		<td><font class="font_align">Customer Id &nbsp;&nbsp;</font><span style="font-size:11px;" ></span></td>
		 <td><?php print("<input name='cust_id' id='cust_id' class='input' readonly='readonly' type='text' style='width:75px;' value='".$row->customer_id."'>")
		 ?></td>
	</tr>
	<tr>
		<td width=""><font class="font_align">Customer Name</font></td>
		
		 <td><?php print("<input name='cust_name' id='cust_name' class='input'  type='text' style='width:250px;' value='".$row->customer_name."'>")
		 ?>	</td>
	</tr>
	

<tr>
		<td ><font class="font_align">Address</font></td>
		<td colspan="" style="" width="50%"><?php print("<textarea name='addr' id='addr' class='txtarea' rows='2' cols='40'  style='width:250px;' >$row->address</textarea>")
		?>	
		</td>
	</tr>
	<tr>
		<td><font class="font_align">Phone Number &nbsp;&nbsp;</font><span style="font-size:11px;" ></span></td>
		 <td><?php print("<input name='phone_number' id='phone_number' class='input'  type='text' style='width:150px;' value='".$row->phone_number."'>")
		 ?></td>
	</tr>
	<tr>
	<tr>
		<td><font class="font_align">DOB &nbsp;&nbsp;</font><span style="font-size:11px;" ></span></td>
		 <td><?php print("<input name='indent_dob' id='indent_dob' class='input'  type='date' style='width:150px;' value='".$row->indent_dob."'>")
		 ?></td>
	</tr>
	<tr>
			
		<td><font class="font_align">TIN &nbsp;&nbsp;</font><span style="font-size:11px;" ></span></td>
		 <td><?php print("<input name='tin' id='tin' class='input'  type='text' style='width:100px;' value='".$row->tin."'>")
		 ?></td>	
	</tr>
 	
	<tr>
		<td><font class="font_align">Vehicle Number &nbsp;&nbsp;</font><span style="font-size:11px;" ></span></td>
		 <td><?php print("<input name='vehicle_number' id='vehicle_number' class='input'  type='text' style='width:250px;' value='".$row->vehicle_number."'>")
		 ?></td>	
	</tr>
	<tr>
		<td><font class="font_align">Initial Deposit &nbsp;&nbsp;</font><span style="font-size:11px;" ></span></td>
		 <td><?php print("<input name='initial_deposit' id='initial_deposit' class='input'  type='text' style='width:250px;' value='".$row->initial_deposit."'>")
		 ?></td>	
	</tr>
<tr>
		<td><font class="font_align">Indent Number(start) &nbsp;&nbsp;</font><span style="font-size:11px;" ></span></td>
		 <td><?php print("<input name='indent_start_no' id='indent_start_no' class='input'  type='text' style='width:75px;' value='".$row->indent_start_no."'>")
		 ?></td>	
	</tr>
	<tr>
		<td><font class="font_align">Indent Number(end) &nbsp;&nbsp;</font><span style="font-size:11px;" ></span></td>
		 <td><?php print("<input name='indent_end_no' id='indent_end_no' class='input'  type='text' style='width:75px;' value='".$row->indent_end_no."'>")
		 ?></td>	
	</tr>
	<tr>
		<td><font class="font_align">Indent Limit &nbsp;&nbsp;</font><span style="font-size:11px;" ></span></td>
		 <td><?php print("<input name='indent_limit' id='indent_limit' class='input'  type='text' style='width:75px;' value='".$row->indent_limit."'>")
		 ?></td>	
	</tr>
	<tr>
		<td><font class="font_align">Opening Balance &nbsp;&nbsp;</font><span style="font-size:11px;" ></span></td>
		 <td><?php print("<input name='open_bal' id='open_bal' class='input'  type='text' style='width:75px;' value='".$row->opening_balance."'>")
		 ?></td>	
	</tr>
	<tr>
		<td><font class="font_align">Status &nbsp;&nbsp;</font><span style="font-size:11px;" ></span></td>
		 <td>
		 <select name="status" id="status" class="dropdown"  style="width:78px;height:24px;">
			<option value='ACTIVE' <?php if($row->status=='ACTIVE') echo "selected";?> >Active</option>
			<option value='BLOCKED' <?php if($row->status=='BLOCKED') echo "selected";?> >Blocked</option>
			<option value='INACTIVE' <?php if($row->status=='INACTIVE') echo "selected";?> >Inactive</option>
          </select>
             </td>	
	</tr>
<?php } ?>
	</table>
	