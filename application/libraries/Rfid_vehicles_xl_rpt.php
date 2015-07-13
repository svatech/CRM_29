<?php 

class Rfid_vehicles_xl_rpt{

        public function Export($data){
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=".date('dmY')."_RFID_Vehicles_Master.xls");
        print("<tr>");
        print("<p align='center' style='margin-top:10px;color:#006666;font-size:15pt;font-weight:bold;'>List Of RFID Enabled Vehicles</p>"); 
        print("</tr>");
        print("<table  border='1' align='left' cellpadding='1' cellspacing='1' width='100%' style='border-collapse:collapse;margin-bottom:20px;'>");
      	print("<tr bgcolor='#559999'>");
        print("<td align='center' width='30%' ><font color='white'>Vehicle No</font></td>");
		print("<td align='center'  width='70%'><font color='white'>Customer Name</font></td>");
		print("</tr>");
 		print("</table>");
   
   print("<table width='100%' border='1' align='left' >");
   foreach($data as $row) {
   		print("<tr class='td_rows'>");
        print("<td width='30%' >$row->vehicle_no</td>");
        print("<td width='70%'>$row->cust_name</td>");
       	print("</tr>");    	

   }
print("</table>");  

 }
}
?>