<!-- <div  style="height:auto;overflow:hidden;background:#006666;margin:30px;width:1000px;min-height:80px;border:0px solid black ;border-radius:10px;">
<p style="margin-left:80%;padding-top:5px;line-height:0.5em;color:white;">User: <b><?php echo $this->session->userdata('fullname');?></b>&nbsp;&nbsp;<img src="../../images/rightarrow1.png" width="10px" height="10px;"/>&nbsp;&nbsp;&nbsp;<strong>
 <a href="<?php echo site_url("logincheck/logout"); ?>" style="color:white;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='white'">Logout</a></strong></p>
<center style="margin-bottom:20px;font-size:20pt;color:white;position:inline;">Supplier Details</center>
 </div>
  -->
 <div class='lengthy_form'>
<div class='filter_info' style="margin-left: 40px;margin-top:20px;font-weight:bold"><font size="2px">Search by Supplier</font>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" class="input" name="supplier" id="supplier"  style="width:125px;height:24px;" onkeyup="javascript:searchbysuppliername()" >
<input type="button" value="Download Supplier Master" style="height:25px;width:200px;margin-left:150px;" onclick="javascript:supp_master_dwnld()">
			</div>
			<div style="margin-left: 75%;font-weight:bold"><a  href="<?php echo site_url("master/supplier_master");?>"><font color='#4c0000' size="3px" >Add New Supplier</font></a> </div>
			<hr width="100%">


			<div style="height:84%;overflow:scroll;">
			<table border="0" width="100%" >
			<tr bgcolor="#559999">
			<td align="center" width="25%" style="border-right:1px solid white;"><span class="txt1_color">Supplier Name</span></td>
			<td align="center" width="40%" style="border-right:1px solid white;"><span class="txt1_color">Address</span></td>
			<td align="center" width="15%" style="border-right:1px solid white;"><span class="txt1_color">Phone Number</span></td>
			<td align="center" width="12%" style="border-right:1px solid white;"><span class="txt1_color">Tin</span></td>
			<td align="center" width="8%"><span class="txt1_color">Modify</span></td>
			</tr>
			</table>
			

<?php
   $counter=0;
   print("<table width='100%'  border='1' align='left' cellpadding='1' cellspacing='1' style='margin-bottom:20px'>");
   foreach($suppliermaster as $row) {
   		$counter++;     	
     	$rowid="row".$counter;
     	print("<tr id='$rowid' class='td_rows'>");
        $supp_id="supp_name".$counter;  
        $supplier_name=$row->supplier_name;            
        print("<td width='25%'  ><input type='text' height='' style='margin-left:0px;' class='plain_txt' id='$supp_id' title='$supplier_name' value=' $supplier_name' /></td>");
    	$products[$counter]=$row->supplied_products;
		$product_id="product".$counter;  
		$product_arr=$products[$counter];
		$product=explode("-",$product_arr);
		$arr_count=count($product);
   		//print("<td width='25%'><label class='lab'><select id='$product_id' class='drop'>");
		//for($i=0;$i<$arr_count;$i++)
		//{
		//print("<option  value='$product[$i]'>$product[$i]</option>");
		//}
		//print("</select></label></td>");
		$supp1_id="supp".$counter;  
 		print("<input type='hidden' id='$supp1_id' value='".$row->supplier_id."' />");
 		$address_id="addr".$counter;
        print("<td width='40%'><input type='text' style='' class='plain_txt' readonly='readonly' id='$address_id' title='".$row->supplier_address."' value='".$row->supplier_address."' /></td>");
        $phone_id="phone".$counter;
        print("<td width='15%'><input type='text' style='' class='plain_txt' readonly='readonly' id='$phone_id' value='".$row->phone_no."' /></td>");
        $tin_id="tin".$counter;
        print("<td width='12%'><input type='text' style='' class='plain_txt' readonly='readonly' id='$tin_id' value='".$row->tin_no."'/></td>");
   		$edit_id="edit".$counter;
        print("<td width='8%'><a style='' href='javascript:updatesupplier(\"".$row->supplier_id."\");' id='edit_id'><font color=''>Edit </font></a></td>");
		print("</tr>");    	

   }
print("</table>");  
echo "<input type='hidden' id='hrowcount' value='$counter' />";
?>  
</div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/master_validation.js"></script>