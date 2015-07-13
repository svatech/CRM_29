<?php 

class Prod_master_xl_rpt{

        public function Export($data){
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=".date('dmY')."_Product_Master.xls");
		print("<tr>");
        print("<p align='center' style='margin-top:10px;color:#006666;font-size:15pt;font-weight:bold;'>List Of Products</p>"); 
        print("</tr>");
        print("<table  border='1' align='left' cellpadding='1' cellspacing='1' width='100%' style='border-collapse:collapse;margin-bottom:20px;'>");
      	print("<tr bgcolor='#559999'>");
       	print("<td align='center' width='30%' ><font color='white'>Product Name</font></td>");
       	print("<td align='center' width='10%' ><font color='white'>Opening Stock</font></td>");
		print("<td align='center' width='10%' ><font color='white'>Product rate(Rs)</font></td>");
		print("<td align='center'  width='15%'><font color='white'>Category</font></td>");
		print("<td align='center' width='10%'><font color='white'>Status</font></td>");
		print("<td align='center'   width='15%'><font color='white'>Added by</font></td>");
		print("<td align='center'  width='20%'><font color='white'>Added Date</font></td>");
        print("</tr>");
 		print("</table>");
   
   print("<table width='100%' border='1' align='left' >");
   foreach($data as $row) {
   		print("<tr class='td_rows'>");
        print("<td width='30%' >$row->product_name</td>");
        print("<td width='10%' >$row->opening_stock</td>");
    	print("<td width='10%' >$row->product_rate</td>");
       	print("<td width='15%'>$row->category</td>");
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