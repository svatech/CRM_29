<?php 

class Retail_customer_master_xl_rpt{

        public function Export($data){
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=".date('dmY')."_Retail_customer_Master.xls");
        print("<tr>");
        print("<p align='center' style='margin-top:10px;color:#006666;font-size:15pt;font-weight:bold;'>List Of Retail Customers</p>"); 
        print("</tr>");
        print("<table  border='1' align='left' cellpadding='1' cellspacing='1' width='100%' style='border-collapse:collapse;margin-bottom:20px;'>");
      	print("<tr bgcolor='#559999'>");
       	print("<td align='center' width='30%' ><font color='white'>Customer Name</font></td>");
		print("<td align='center' width='20%' ><font color='white'>Vehicle No</font></td>");
		print("<td align='center'  width='15%'><font color='white'>Mobile No</font></td>");
		print("<td align='center' width='10%' ><font color='white'>Reference No</font></td>");
		print("<td align='center'   width='15%'><font color='white'>Status</font></td>");
		print("</tr>");
 		print("</table>");
   
   print("<table width='100%' border='1' align='left' >");
   foreach($data as $row) {
   		print("<tr class='td_rows'>");
        print("<td width='30%' >$row->customer_name</td>");
        
       	print("<td width='20%'>$row->vehicle_number</td>");        
    //	print("<td width='20%' >$row->vehicle_number</td>");
       	print("<td width='15%'>$row->mobile_number</td>");
        print("<td width='10%'>$row->reference_no</td>");
       print("<td width='15%'>".ucfirst(strtolower($row->status))."</td>");
       	print("</tr>");    	

   }
print("</table>");  

 }
}
?>