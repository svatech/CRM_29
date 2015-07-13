<?php 

class Tank_stock_xl_rpt{

        public function Export($data){
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=".date('dmY')."_Tank_stock_report.xls");
        print("<tr>");
        print("<p align='center' style='margin-top:10px;color:#006666;font-size:15pt;font-weight:bold;'>Tank Stock Report</p>"); 
        print("</tr>");
        print("<table  border='1' align='left' cellpadding='1' cellspacing='1'  style='border-collapse:collapse;margin-bottom:20px;'>");
       print("<tr bgcolor='#559999'>");
       print("<td width='10%' align='center'>Date</td>");
       print("<td width='8%' align='center'>Tank Name</td>");
       print("<td width='8%' align='center'>Product</td>");
       print("<td width='12%' align='center'>Volume</td>");
       print("<td width='12%' align='center'>Dip Level</td>");
       print("<td width='10%' align='center'>Water Level</td>");
       print("<td width='10%' align='center'>Density (15&deg;C)</td>");
       print("<td width='10%' align='center'>Actual Temp (&deg;C)</td>");
       print("<td width='10%' align='center'>Actual Temp Density</td>");
       print("<td width='10%' align='center'>Entered By</td>");
       print("</tr>");
 foreach($data as $openrow) {
        	 print("<tr class='small'>");
            print("<td width='10%' align='center'>".($openrow["added_date"]!='0000-00-00' ? date('d-m-Y',strtotime($openrow["added_date"])) : '')."</td>");
             print("<td width='8%' align='center'>".$openrow["tank_no"]."</td>");
             print("<td width='8%' align='center'>".$openrow["product"]."</td>");
             print("<td width='12%' align='center'>".$openrow["volume"]."</td>");
             print("<td width='12%' align='center'>".$openrow["dip_level"]."</td>");
             print("<td width='10%' align='center'>".$openrow["water_level"]."</td>");             
             print("<td width='10%' align='center'>".$openrow["spec_density"]."</td>");             
             print("<td width='10%' align='center'>".$openrow["actual_temp"]."</td>");             
             print("<td width='10%' align='center'>".$openrow["actual_temp_density"]."</td>");
             print("<td width='10%' align='center'>".$openrow["user"]."</td>");
             print("</tr>");
          }
          print("</table>");
        
        }
}

?>