<link rel="stylesheet" type="text/css" href="../../../css/mystyle.css">
<table style="width:100%" border="0">
	<tr><?php foreach($supplier_info as $row){ ?> 
		<td><font class="font_align">Supplier Id &nbsp;&nbsp;</font><span style="font-size:11px;" ></span></td>
		 <td><?php print("<input name='supp_id' id='supp_id' class='input' readonly='readonly' type='text' style='width:75px;' value='".$row->supplier_id."'>")
		 ?></td>
	</tr>
	<tr>
		<td width=""><font class="font_align">Supplier Name</font></td>
		
		 <td><?php print("<input name='supp_name' id='supp_name' class='input'  type='text' style='width:250px;' value='".$row->supplier_name."'>")
		 ?>	</td>
	</tr>
	

<tr>
		<td ><font class="font_align">Address</font></td>
		<td colspan="" style="" width="50%"><?php print("<textarea name='addr' id='addr' class='txtarea' rows='2' cols='40'  style='width:250px;' >$row->supplier_address</textarea>")
		?>	
		</td>
	</tr>
	<tr>
		<td><font class="font_align">Phone Number &nbsp;&nbsp;</font><span style="font-size:11px;" ></span></td>
		 <td><?php print("<input name='phone_number' id='phone_number' class='input'  type='text' style='width:150px;' value='".$row->phone_no."'>")
		 ?></td>
	</tr>
	<tr>
		
		<td><font class="font_align">TIN &nbsp;&nbsp;</font><span style="font-size:11px;" ></span></td>
		 <td><?php print("<input name='tin' id='tin' class='input'  type='text' style='width:100px;' value='".$row->tin_no."'>")
		 ?></td>	
	</tr>
 	
	<tr>
		<td><font class="font_align">Supplying Products &nbsp;&nbsp;</font><span style="font-size:11px;" ></span></td>
		 <td><?php print("<input name='products' id='products' class='input'  type='text' style='width:250px;' value='".$row->supplied_products."'>")
		 ?></td>	
	</tr>



<?php } ?>
	</table>
	