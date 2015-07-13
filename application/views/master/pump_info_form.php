

<table style="width:100%" border="0">
	<tr>
		<td width="50%"><font class="font_align">Pump Name</font></td>
		  <?php foreach($pump_info as $row) {?>
		<td><?php print("<input name='pump_no' id='pump_no' class='input' readonly='readonly' type='text' style='width:75px;' value='".$row->pump_no."'>")
		?>	
	</tr>
	
	<tr>
		<td><font class="font_align">Tank Name &nbsp;&nbsp;</font><span style="font-size:11px;" ></span></td>
		<td colspan=""><select name="tank_no" id="tank_no" class="dropdown" style="width:125px;height:24px;" onchange="opener.tank_product_pop(this.value)"><?php foreach ($tank as $tank_list) {
				if($row->tank_no==$tank_list->TANK_NO)
			print("<option value='$row->tank_no' selected='selected'>$row->tank_no</option>  " );
			else
			print("<option value='$tank_list->TANK_NO'>$tank_list->TANK_NO</option>" );
			?><?php }?> </select></td>	
	</tr>
	<tr>
		<td><font class="font_align">Product Name</font></td>
		<td><input name="prod_name" class="input" id="prod_name" type="text" style="width:125px;height:25px;" value="<?php echo $row->product_name;?>" onblur=""></td>		
	</tr>
	<tr>
		<td><font class="font_align">Status</font></td>
		<td colspan=""><select name="status" id="status" class="dropdown" style="width:78px;height:24px;">
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
		<td><font class="font_align">Counter</font></td>
		<td colspan=""><select name="counter" id="counter" class="dropdown" style="width:78px;height:24px;">
			<?php if($row->counter=="one")
            	print("<option value='$row->counter' selected='selected'>One</option>");
            else
                 print("<option value='One'>One</option>");
            if($row->counter=="Two")
                print("<option value='$row->counter' selected='selected'>Two</option>");
            else
            	print("<option value='Two'>two</option>");
            	 if($row->counter=="Three")
                print("<option value='$row->counter' selected='selected'>Three</option>");
            else
            	print("<option value='Three'>three</option>");
             ?></select></td>		
	</tr>
	<tr>
		<td width=""><font class="font_align">Reading</font></td>
		<td><?php print("<input name='reading' id='reading' class='input' readonly='readonly' type='text' style='width:75px;' value='".$row->last_close_reading."'>");
		  }
		  ?>	
	</tr>
</table>