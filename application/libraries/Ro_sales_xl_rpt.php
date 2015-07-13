<?php
class Ro_sales_xl_rpt{

        public function Export($stmt_date,$pump_sales,$other_sales){
        
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=RO_sales_on_".date('d-m-Y', strtotime($stmt_date)).".xls");
        print("<table  border='1' align='left' cellpadding='1' cellspacing='1'  style='border-collapse:collapse;margin-bottom:20px;'>");
        print("<tr bgcolor='#518C9C' style='color:white;border-right:1px solid white; '>");
        print("<td width='5%' align='center' colspan='13'>Sales Statement for ".date('d-m-Y', strtotime($stmt_date))."</td>");
        print("</tr>");
        print("<tr style='color:#4c0000;font-size:18px;font-weight:bold;margin:20px 0px 2px 20px;' align='left'><td colspan='9'>Pump Products Sales</td></tr>");
        print("<tr bgcolor='#518C9C' id='hdr_row_1' style='color:white;border-right:1px solid white; '>");
       print("<td width='10%' align='center'>Date</td>");
       print("<td width='10%' align='center'>Product Name</td>");
       print("<td width='10%' align='center'>Net Sales (Ltr)</td>");
       print("<td width='10%' align='center'>Testing Litres (Ltr)</td>");
       print("<td width='10%' align='center'>Cash Sales (Ltr)</td>");
       print("<td width='10%' align='center'>Indent Sales (Ltr)</td>");
       print("<td width='10%' align='center'>Credit Card Sales (Ltr)</td>");
       print("<td width='10%' align='center'>FC Sales (Ltr)</td>");
       print("<td width='10%' align='center'>XR Sales (Ltr)</td>");
       print("</tr>");
       foreach ($pump_sales as $openrow){
	   print("<tr class='td_rows'>");
	   $cash_sales=$openrow["net_sales"]-$openrow["Indent_sales"]-$openrow["Credit_sales"]-$openrow["fleet_sales"]-$openrow["xr_sales"];
	   print("<td width='10%' align='center'>".$openrow["acct_date"]."</td>");
	   print("<td width='10%' align='center'>".$openrow["product_name"]."</td>");
	   print("<td width='10%' align='center'>".$openrow["net_sales"]."</td>");
	   print("<td width='10%' align='center'>".$openrow["test_litres"]."</td>");
	   print("<td width='10%' align='center'>".$cash_sales."</td>");
	   print("<td width='10%' align='center'>".$openrow["Indent_sales"]."</td>");
	   print("<td width='10%' align='center'>".$openrow["Credit_sales"]."</td>");
	   print("<td width='10%' align='center'>".$openrow["fleet_sales"]."</td>");
	   print("<td width='10%' align='center'>".$openrow["xr_sales"]."</td>");
	   print("</tr>");
	    }
	    print("</table>");
         print("<table width='1500px' border='1' align='left' cellpadding='1' cellspacing='1' style='width:1100px;overflow:scroll;border-collapse:collapse;'>");
	   print("<tr style='color:#4c0000;font-size:18px;font-weight:bold;margin:20px 0px 2px 20px;' align='center'><td colspan='8'>Other Products Sales</td></tr>");
       print("<tr bgcolor='#518C9C' id='hdr_row_1' style='color:white;border-right:1px solid white; '>");
       print("<td width='10%' align='center'>Date</td>");
       print("<td width='10%' align='center'>Product Name</td>");
       print("<td width='10%' align='center'>Total Sales (Qty)</td>");
       print("<td width='10%' align='center'>Cash Sales (Qty)</td>");
       print("<td width='10%' align='center'>Indent Sales (Qty)</td>");
       print("<td width='10%' align='center'>Credit Card Sales (Qty)</td>");
       print("<td width='10%' align='center'>FC Sales (Qty)</td>");
       print("<td width='10%' align='center'>XR Sales (Qty)</td>");
       print("</tr>");
       
        foreach ($other_sales as $openrow){
	   print("<tr class='td_rows'>");
	   print("<td width='10%' align='center'>".$openrow["acct_date"]."</td>");
	   print("<td width='10%' align='center'>".$openrow["product"]."</td>");
	   print("<td width='10%' align='center'>".$openrow["qty"]."</td>");
	   print("<td width='10%' align='center'>".$openrow["bcs_qty"]."</td>");
	   print("<td width='10%' align='center'>".$openrow["is_qty"]."</td>");
	   print("<td width='10%' align='center'>".$openrow["cs_qty"]."</td>");
	   print("<td width='10%' align='center'>".$openrow["fs_qty"]."</td>");
	   print("<td width='10%' align='center'>".$openrow["xr_qty"]."</td>");
	   print("</tr>");
        }
        print("</table>");
        }
}