<?php 

class Customer_master_xl_rpt{

        public function Export($data){
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=".date('dmY')."_Customer_Master.xls");
        print("<tr>");
        print("<p align='center' style='margin-top:10px;color:#006666;font-size:15pt;font-weight:bold;'>List Of Indent Customers</p>"); 
        print("</tr>");
        print("<table  border='1' align='left' cellpadding='1' cellspacing='1' width='100%' style='border-collapse:collapse;margin-bottom:20px;'>");
      	print("<tr bgcolor='#559999'>");
       	print("<td align='center' width='30%' ><font color='white'>Customer Name</font></td>");
		print("<td align='center' width='20%' ><font color='white'>Vehicle No</font></td>");
		print("<td align='center'  width='15%'><font color='white'>Phone No</font></td>");
		print("<td align='center' width='10%' ><font color='white'>TIN</font></td>");
		print("<td align='center' width='10%' ><font color='white'>DOB</font></td>");
		print("<td align='center' width='10%'><font color='white'>Indent Start</font></td>");
		print("<td align='center'   width='15%'><font color='white'>Indent End</font></td>");
		print("<td align='center'   width='15%'><font color='white'>Status</font></td>");
		print("</tr>");
 		print("</table>");
   
   print("<table width='100%' border='1' align='left' >");
   foreach($data as $row) {
   		print("<tr class='td_rows'>");
        print("<td width='30%' >$row->customer_name</td>");
        
       	print("<td width='20%'>$row->vehicle_number</td>");        
    //	print("<td width='20%' >$row->vehicle_number</td>");
       	print("<td width='15%'>$row->phone_number</td>");
        print("<td width='10%'>$row->tin</td>");
        print("<td width='10%'>$row->indent_dob</td>");
        print("<td width='10%'>$row->indent_start_no</td>");
		print("<td width='15%'>$row->indent_end_no</td>");
		print("<td width='15%'>".ucfirst(strtolower($row->status))."</td>");
       	print("</tr>");    	

   }
print("</table>");  

 }
}
?>