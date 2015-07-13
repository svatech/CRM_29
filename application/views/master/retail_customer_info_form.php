<link rel="stylesheet" type="text/css" href="../../../css/mystyle.css">
<table style="width:100%" border="0">
	<tr><?php foreach($customer_info as $row){ ?> 
		<td><font class="font_align">Customer Id &nbsp;&nbsp;</font><span style="font-size:11px;" ></span></td>
		 <td><?php print("<input name='cust_id' id='cust_id' class='input' readonly='readonly' type='text' style='width:75px;' value='".$row->cust_id."'>")
		 ?></td>
	</tr>
	<tr>
		<td width=""><font class="font_align">Customer Name</font></td>
		
		 <td><?php print("<input name='cust_name' id='cust_name' class='input'  type='text' style='width:250px;' value='".$row->customer_name."'>")
		 ?>	</td>
	</tr>
	<tr>
		<td><font class="font_align">Vehicle Number &nbsp;&nbsp;</font><span style="font-size:11px;" ></span></td>
		 <td><?php print("<input name='vehicle_number' id='vehicle_number' class='input'  type='text' style='width:250px;' value='".$row->vehicle_number."'>")
		 ?></td>	
	</tr>
	<tr>
		<td><font class="font_align">Mobile Number &nbsp;&nbsp;</font><span style="font-size:11px;" ></span></td>
		 <td><?php print("<input name='mobile_number' id='mobile_number' class='input'  type='text' style='width:150px;' value='".$row->mobile_number."'>")
		 ?></td>
	</tr>
	<tr>
		<td><font class="font_align">Reference Number &nbsp;&nbsp;</font><span style="font-size:11px;" ></span></td>
		 <td><?php print("<input name='reference_no' id='reference_no' class='input'  type='text' style='width:150px;' value='".$row->reference_no."'>")
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
	