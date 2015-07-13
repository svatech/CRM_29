

<table style="width:100%" border="0">
	<tr>
		<td width="500px"><font class="font_align">Tank Name</font></td>
		  <?php foreach($tank_info as $row) {?>
		<td><?php print("<input name='tank_no' class='input' id='tank_no' readonly='readonly' type='text' style='width:75px;' value='".$row->tank_no."'>")
		?>	
	</tr>
	
	<tr>
		<td><font class="font_align">Capacity&nbsp;&nbsp;</font><span style="font-size:11px;" ></span></td>
		<td colspan=""><?php print("<input name='capacity' class='input' id='capacity' type='text' style='width:75px;' value='".$row->capacity."'>")
		?>	Ltrs</td>	
	</tr>
	<tr>
		<td><font class="font_align">Status</font></td>
		<td colspan=""><select name="status" class="dropdown" id="status"  style="width:78px;height:24px;">
			<?php if($row->status=="1")
            	print("<option value='$row->status' selected='selected'>Active</option>");
            else
                 print("<option value='1'>Active</option>");
            if($row->status=="0")
                print("<option value='$row->status' selected='selected'>Inactive</option>");
            else
            	print("<option value='0'>Inactive</option>");
             ?></select></td>		
	</tr>
	<tr>
		<td><font class="font_align">Product Name</font></td>
		<td colspan="" style=""><select name="prod_name" id="prod_name" class="dropdown"  style="width:125px;height:24px;">
			<?php foreach ($prod as $prod_list) {
				if($row->product==$prod_list->PRODUCT_NAME)
			print("<option value='$row->product' selected='selected'>$row->product</option>  " );
			else
			print("<option value='$prod_list->PRODUCT_NAME'>$prod_list->PRODUCT_NAME</option>" );
			?><?php }?> 
			</select></td><?php } ?>	
	</tr>
	
</table>