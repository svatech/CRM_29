<?php
 print("<table width='100%'  border='1' align='right' cellpadding='1' class='alt_row' cellspacing='1' margin='10px' style='border-collapse:collapse;margin-bottom:0px;'>");
print("<tr bgcolor='#559999' id='hdr_row' style='background-color:#559999;color:white;border-right:1px solid white;' align='center'>");	
print("<td>Last Five Transactions</td>");
 print("</tr>");
 print("<table width='100%'  border='1' align='right' cellpadding='1' class='alt_row' cellspacing='1' margin='10px' style='border-collapse:collapse;margin-bottom:10px;'>");
 print("<tr bgcolor='#559999' id='hdr_row' style='background-color:#559999;color:white;border-right:1px solid white;'>");
	 print("<td width='40%' align='center'><span class='txt1_color'>Product</span></td>");
      	 	 print("<td width='30%' align='center'><span class='txt1_color'>Quantity</span></td>");
      		 print("<td width='30%' align='center'><span class='txt1_color'>Date</span></td>");
      		 print("</tr>"); 
      		
      		 foreach ($last_trans as $row){
print("<tr>");
      		 print("<td width='40%' align='center'>".$row["product"]."</td>");
             print("<td width='30%' align='center'>".$row["quantity"]."</td>");
             print("<td width='30%' align='center'>".$row["bill_time"]."</td>");
 print("</tr>");     		  	
      		  }
      		  ?>