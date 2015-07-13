<?php 

class Tank_master_xl_rpt{

        public function Export($data){
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=".date('dmY')."_Tank_Master.xls");
        print("<tr>");
        print("<p align='center' style='margin-top:10px;color:#006666;font-size:15pt;font-weight:bold;'>Tank Master</p>"); 
        print("</tr>");
        print("<table  border='1' align='left' cellpadding='1' cellspacing='1' width='100%' style='border-collapse:collapse;margin-bottom:20px;'>");
      	print("<tr bgcolor='#559999'>");
       	print("<td align='center' width='30%' ><font color='white'>Tank Name</font></td>");
		print("<td align='center' width='10%' ><font color='white'>Product</font></td>");
		print("<td align='center'  width='15%'><font color='white'>Capacity(Ltrs)</font></td>");
		print("<td align='center' width='10%'><font color='white'>Status</font></td>");
		print("<td align='center'   width='15%'><font color='white'>Added by</font></td>");
		print("<td align='center'  width='20%'><font color='white'>Added Date</font></td>");
        print("</tr>");
 		print("</table>");
   
   print("<table width='100%' border='1' align='left' >");
   foreach($data as $row) {
   		print("<tr class='td_rows'>");
        print("<td width='30%' >$row->tank_no</td>");
    	print("<td width='10%' >$row->product</td>");
       	print("<td width='15%'>$row->capacity</td>");
        if($row->status == 1){
        print("<td width='10%'>Active</td>");}
   		else{
        print("<td width='10%'>Inactive</td>");}
        print("<td width='15%'>$row->updated_by</td>");
		print("<td width='20%'>$row->updated_date</td>");
       	print("</tr>");    	

   }
print("</table>");  

 }
}
?>