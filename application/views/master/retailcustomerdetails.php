 <div class='lengthy_form'>
<div class='filter_info' style="margin-left: 40px;margin-top:10px;">
<table>
<tr><td>
<font size="2px" >Search by Customer Name</font>
</td><td>
<input type="text" class="input" name="customer" id="customer"  style="width:125px;height:24px;" onblur="javascript:searchbycustomername()" >
</td><td>
<font size="2px">Search by Vehicle No</font>
</td><td>
<input type="text" class="input" name="vehicle_no" id="vehicle_no"  style="width:125px;height:24px;" onblur="javascript:searchbyvehicleno()" >
</td><td>
	<input type="button" value="Download Customer Master" style="height:25px;width:200px;margin-left:40px;" onclick="javascript:retail_cust_dwnld()">
	</td></tr>
	</table>
			</div>
			<!-- <div style="margin-left: 75%;font-weight:bold;margin-top:10px;"><a  href="<?php echo site_url("master/customer_master");?>"><font color='#4c0000' size="3px" >Add New Indent Customer</font></a> </div> -->
			<hr width="100%">


			<div style="height:90%;overflow:scroll;">
			<table border="1" width="100%">
			<tr bgcolor="#559999">
			<td align="center" width="30%" style="border-right:1px solid white;"><span class="txt1_color">Customer Name</span></td>
			<td align="center" width="20%" style="border-right:1px solid white;"><span class="txt1_color">Vehicle</span></td>
			<td align="center" width="20%" style="border-right:1px solid white;"><span class="txt1_color">Phone Number</span></td>
			<td align="center" width="20%" style="border-right:1px solid white;"><span class="txt1_color">Status</span></td>
			<td align="center" width="10%"><span class="txt1_color">Modify</span></td>
			</tr>
			
			

<?php
   $counter=0;
  // print("<table width='100%' height='100%' border='1' align='left' cellpadding='1' cellspacing='1' style='margin-bottom:20px'>");
   foreach($retailcustomers as $row) {
   		$counter++;     	
     	$rowid="row".$counter;
     	print("<tr id='$rowid' class='td_rows'>");
        $cust_id="cust_name".$counter;  
        $customer_name=$row->customer_name;            
        print("<td width='30%'  ><input type='text' height='' style='margin-left:0px;' class='plain_txt' id='$cust_id'  value=' $customer_name' /></td>");
    	$veh_id="veh_no".$counter;  
		print("<input type='hidden' id='$veh_id'  value='$row->vehicle_number' />");
   		print("<td width='20%'><input type='text' style='' class='plain_txt' readonly='readonly' id='$veh_id' value='".$row->vehicle_number."' /></td>");
		$cust1_id="cust".$counter;  
 		print("<input type='hidden' id='$cust1_id' value='".$row->cust_id."' />");
        $phone_id="phone".$counter;
        print("<td width='20%'><input type='text' style='' class='plain_txt' readonly='readonly' id='$phone_id' value='".$row->mobile_number."' /></td>");
        $status_id="status".$counter;
        print("<td width='20%'><input type='text' style='' class='plain_txt' readonly='readonly' id='$status_id' value='".$row->status."'/></td>");
   		print("<td width='10%' align='center'><a style='' href='javascript:updateretailcustomer(\"".$row->cust_id."\");' id='edit_id'><font color=''>Edit </font></a></td>");
		print("</tr>");    	

   }
print("</table>");  
echo "<input type='hidden' id='hrowcount' value='$counter' />";
?>  
</div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/master_validation.js"></script>