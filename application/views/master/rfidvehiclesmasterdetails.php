<!-- <div  style="height:auto;overflow:hidden;background:#006666;margin:30px;width:1000px;min-height:80px;border:0px solid black ;border-radius:10px;">
<p style="margin-left:80%;padding-top:5px;line-height:0.5em;color:white;">User: <b><?php echo $this->session->userdata('fullname');?></b>&nbsp;&nbsp;<img src="../../images/rightarrow1.png" width="10px" height="10px;"/>&nbsp;&nbsp;&nbsp;<strong>
 <a href="<?php echo site_url("logincheck/logout"); ?>" style="color:white;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='white'">Logout</a></strong></p>
<center style="margin-bottom:20px;font-size:20pt;color:white;position:inline;">RFID Enabled Vehicles</center>
 </div>
  -->
<div 
class='lengthy_form'>
<div class='filter_info' style="margin-left: 40px;margin-top:10px;"><font size="2px">Search by Vehicle No</font>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" class="input" name="supplier" id="vehicle_no"  style="width:125px;height:24px;" onkeyup="javascript:searchbyvehicleno()" >
<input type="button" value="Download Master" style="height:25px;width:200px;margin-left:150px;" onclick="javascript:rfid_vehicles_dwnld()">
			</div>
			
			
			<hr width="100%" style='margin-top:10px;'>


			<div style="height:90%;overflow:scroll;">
			<table border="0" width="100%">
			<tr bgcolor="#559999">
			<td align="center" width="20%" style="border-right:1px solid white;"><span class="txt1_color">Vehicle No</span></td>
			<td align="center" width="60%" style="border-right:1px solid white;"><span class="txt1_color">Customer Name</span></td>
			<td align="center" width="20%"><span class="txt1_color">Remove</span></td>
			</tr>
			</table>
			

<?php
   $counter=0;
   print("<table width='100%'  border='1' align='left' cellpadding='1' cellspacing='1' style='margin-bottom:20px'>");
   foreach($vehicles as $row) {
   		$counter++;     	
     	$rowid="row".$counter;
     	print("<tr id='$rowid' class='td_rows'>");
        $veh_id="veh_no".$counter;  
        print("<td width='20%'  ><input type='text' height='' style='margin-left:0px;' class='plain_txt' id='$veh_id' title='$row->vehicle_no' value='$row->vehicle_no' /></td>");
    	$cust_id="cust".$counter;  
 		print("<td width='60%'><input type='text' style='' class='plain_txt' readonly='readonly' id='$cust_id' title='".$row->cust_name."' value='".$row->cust_name."' /></td>");
        $edit_id="edit".$counter;
        print("<td width='20%'><a style='' href='javascript:remove_rfid_details(\"".$row->vehicle_no."\");' id='edit_id'><font color=''>Remove </font></a></td>");
		print("</tr>");    	

   }
print("</table>");  
echo "<input type='hidden' id='hrowcount' value='$counter' />";
?>  
</div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>js/custom/master_validation.js"></script>