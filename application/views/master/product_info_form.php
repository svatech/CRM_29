<link rel="stylesheet" type="text/css" href="../../../css/mystyle.css">
<table style="width:100%" border="0">
	<tr>
		<td width="500px"><font class="font_align">Product Name</font></td>
		<?php foreach($product_info as $row){ ?> 
		 <td><?php print("<input name='prod_name' id='prod_name' class='input' readonly='readonly' type='text' style='width:200px;' value='".$row->product_name."'>")
		 ?><?php } ?>	</td>
	</tr>
	

<tr>
		<td><font class="font_align">Product's Sales Rate</font></td>
		<td colspan="" style=""><?php print("<input name='prod_rate' id='prod_rate' class='input' type='text' style='width:75px;' value='".$row->product_rate."'>")
		?>	
		</td>
	</tr>
	<tr>
		<td><font class="font_align">Category &nbsp;&nbsp;</font><span style="font-size:11px;" ></span></td>
		<td colspan=""><select name="category" id="category" class="dropdown" style="width:125px;height:24px;" onchange="opener.enterstock_pop()"><?php foreach ($category as $category_list) {
				if($row->category==$category_list->category)
			print("<option value='$row->category' selected='selected'>$row->category</option>  " );
			else
			print("<option value='$category_list->category'>$category_list->category</option>" );
			?><?php }?> </select></td>	
	</tr>
	<tr>
		<td><font class="font_align">Status</font></td>
		<td colspan=""><select name="status" id="status" class="dropdown"  style="width:78px;height:24px;">
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
		<td><font class="font_align">Tank Product</font></td>
		<td colspan=""><select name="tank_product" id="tank_product"  class="dropdown" style="width:78px;height:24px;">
			<?php if($row->tank_product==1)
            	print("<option value='$row->tank_product' selected='selected'>Yes</option>");
            else
                 print("<option value='1'>Yes</option>");
            if($row->tank_product==0)
                print("<option value='$row->tank_product' selected='selected'>No</option>");
            else
                 print("<option value='0'>No</option>");
            	
             ?></select></td>		
	</tr>
		<?php 
		if($row->category != 'FUEL')
		{
		print("<tr style='' id='stock_row'>");
		print("<td><font class='font_align'>Opening Stock</font></td>");
		print("<td colspan=''  style=''><input name='stock' id='stock'  class='input' type='text' style='width:75px;' value='$row->opening_stock'>");
		print("</td></tr>");
		}else 
		{
		print("<tr style='display:none' id='stock_row'>");
		print("<td><font class='font_align'>Opening Stock</font></td>");
		print("<td colspan=''  style=''><input name='stock' id='stock'  class=a'input' type='text' style='width:75px;' value='$row->opening_stock'>");
		print("</td></tr>");	
		}
		 
		?>
		<tr>
		<td><font class="font_align">Purchase Rate</font></td>
	
		<td colspan="" style=""><?php
			 print("<input name='prod_rate'  id='comm_rate' class='input'  type='text'  style='width:75px;'  value='".$row->commision_rate."' /> ");
		?>	
		</td>
	</tr>
	</table>
