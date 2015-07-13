<?php 

class Supplier_master_xl_rpt{

        public function Export($data){
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=".date('dmY')."_Supplier_Master.xls");
        print("<tr>");
        print("<p align='center' style='margin-top:10px;color:#006666;font-size:15pt;font-weight:bold;'>List Of Sppliers</p>"); 
        print("</tr>");
        print("<table  border='1' align='left' cellpadding='1' cellspacing='1' width='100%' style='border-collapse:collapse;margin-bottom:20px;'>");
      	print("<tr bgcolor='#559999'>");
       	print("<td align='center' width='30%' ><font color='white'>Supplier Name</font></td>");
		//("<td align='center' width='20%' ><font color='white'>Products</font></td>");
		print("<td align='center' width='20%' ><font color='white'>Address</font></td>");
		print("<td align='center'  width='15%'><font color='white'>Phone No</font></td>");
		print("<td align='center' width='10%' ><font color='white'>TIN</font></td>");
		print("</tr>");
 		print("</table>");
   
   print("<table width='100%' border='1' align='left' >");
   foreach($data as $row) {
   		print("<tr class='td_rows'>");
        print("<td width='30%' >$row->supplier_name</td>");
       	//print("<td width='20%'>$row->supplied_products</td>");
	//	print("<td width='20%' >$row->vehicle_number</td>");
       	print("<td width='15%'>$row->supplier_address</td>");
        print("<td width='10%'>$row->phone_no</td>");
        print("<td width='10%'>$row->tin_no</td>");
		print("</tr>");    	
					 }
print("</table>");  

 }
}
?>