<!-- <div  style="height:auto;overflow:hidden;background:#006666;margin:30px;width:1000px;min-height:80px;border:0px solid black ;border-radius:10px;">
<p style="margin-left:80%;padding-top:5px;line-height:0.5em;color:white;">User: <b><?php echo $this->session->userdata('fullname');?></b>&nbsp;&nbsp;<img src="../../images/rightarrow1.png" width="10px" height="10px;"/>&nbsp;&nbsp;&nbsp;<strong>
 <a href="<?php echo site_url("logincheck/logout"); ?>" style="color:white;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='white'">Logout</a></strong></p>
<center style="margin-bottom:20px;font-size:20pt;color:white;position:inline;">Indent Customer Details</center>
 </div>
  -->
 <div class='lengthy_form'>
<div class='filter_info' style="margin-left: 40px;margin-top:10px;">
<table>
<tr><td>
<font size="2px" >Search by Customer Name</font>
</td><td>
<input type="text" class="input" name="customer" id="customer"  style="width:125px;height:24px;" onkeyup="javascript:searchbycustomername()" >
</td><td>
<font size="2px">Search by Vehicle No</font>
</td><td>
<input type="text" class="input" name="vehicle_no" id="vehicle_no"  style="width:125px;height:24px;" onkeyup="javascript:searchbyvehicleno()" >
</td><td>
	<input type="button" value="Download Customer Master" style="height:25px;width:200px;margin-left:40px;" onclick="javascript:cust_master_dwnld()">
	</td></tr>
	</table>
			</div>
			<div style="margin-left: 75%;font-weight:bold;margin-top:10px;"><a  href="<?php echo site_url("master/customer_master");?>"><font color='#4c0000' size="3px" >Add New Indent Customer</font></a> </div>
			<hr width="100%">


			<div style="height:90%;overflow:scroll;">
			<table border="1" width="100%">
			<tr bgcolor="#559999">
			<td align="center" width="36%" style="border-right:1px solid white;"><span class="txt1_color">Customer Name</span></td>
			<td align="center" width="10%" style="border-right:1px solid white;"><span class="txt1_color">Vehicle</span></td>
			<td align="center" width="11%" style="border-right:1px solid white;"><span class="txt1_color">Phone Number</span></td>
			<td align="center" width="11%" style="border-right:1px solid white;"><span class="txt1_color">Tin</span></td>
			<td align="center" width="10%" style="border-right:1px solid white;"><span class="txt1_color">DOB</span></td>
			<td align="center" width="10%" style="border-right:1px solid white;"> <span class="txt1_color">Indent No(starting)</span></td>
			<td align="center" width="10%" style="border-right:1px solid white;"><span class="txt1_color">Indent No(ending)</span></td>
			<td align="center" width="10%" style="border-right:1px solid white;"><span class="txt1_color">Status</span></td>
			<td align="center" width="5%"><span class="txt1_color">Modify</span></td>
			</tr>
			
			

<?php
   $counter=0;
  // print("<table width='100%' height='100%' border='1' align='left' cellpadding='1' cellspacing='1' style='margin-bottom:20px'>");
   foreach($customermaster as $row) {
   		$counter++;     	
     	$rowid="row".$counter;
     	print("<tr id='$rowid' class='td_rows'>");
        $cust_id="cust_name".$counter;  
        $customer_name=$row->customer_name;            
        print("<td width='36%'  ><input type='text' height='' style='margin-left:0px;' class='plain_txt' id='$cust_id'  value=' $customer_name' /></td>");
    	$vehicle_column[$counter]=$row->vehicle_number;
		$veh_id="veh_no".$counter;  
		$vehicle_id=$vehicle_column[$counter];
		$vehicle=explode("-",$vehicle_id);
		$arr_count=count($vehicle);
		print("<input type='hidden' id='$veh_id'  value='$row->vehicle_number' />");
   		print("<td width='10%'><label class='lab'><select  class='drop' style='width:130px;'>");
		for($i=0;$i<$arr_count;$i++)
		{
		print("<option  value='$vehicle[$i]'>$vehicle[$i]</option>");

		}
		print("</select></label></td>");
		$cust1_id="cust".$counter;  
 		print("<input type='hidden' id='$cust1_id' value='".$row->customer_id."' />");
        $phone_id="phone".$counter;
        print("<td width='11%'><input type='text' style='' class='plain_txt' readonly='readonly' id='$phone_id' value='".$row->phone_number."' /></td>");
        $tin_id="tin".$counter;
        print("<td width='11%'><input type='text' style='' class='plain_txt' readonly='readonly' id='$tin_id' value='".$row->tin."'/></td>");
   		$tin_id="indent_dob".$counter;
        print("<td width='10%'><input type='text' style='' class='plain_txt' readonly='readonly' id='$tin_id' value='".$row->indent_dob."'/></td>");
        $indent_start_id="indent_start".$counter;
        print("<td width='10%'><input type='text' style='' class='plain_txt' readonly='readonly' id=' $indent_start_id' value='".$row->indent_start_no."' /></td>");
		$indent_end_id="indent_end".$counter;
        print("<td width='10%'><input type='text'  style='' class='plain_txt' readonly='readonly' id='$indent_end_id' value='".$row->indent_end_no."' /></td>");
        $edit_id="edit".$counter;
        print("<td width='10%'><input type='text'  style='' class='plain_txt' readonly='readonly' id='' value='".ucfirst(strtolower($row->status))."' /></td>");
        
        print("<td width='5%'><a style='' href='javascript:updatecustomer(\"".$row->customer_id."\");' id='edit_id'><font color=''>Edit </font></a></td>");
		print("</tr>");    	

   }
print("</table>");  
echo "<input type='hidden' id='hrowcount' value='$counter' />";
?>  
</div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/master_validation.js"></script>