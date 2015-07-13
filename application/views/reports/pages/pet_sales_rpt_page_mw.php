<?php
 print("<table width='100%' border='1' align='left' class='alt_row' cellpadding='1' cellspacing='1' style='border-collapse:collapse;margin-bottom:20px;'>");
       print("<tr bgcolor='#559999' id='hdr_row' style='background-color:#559999;color:white;border-right:1px solid white;'>");
       print("<td width='10%' align='center'>Date</td>");
      
       print("<td width='10%' align='center'><span class='txt1_color'>Pump No</span></td>");
       print("<td width='20%' align='center'><span class='txt1_color'>Close Reading</span></td>");
       print("<td width='20%' align='center'><span class='txt1_color'>Open Reading</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Sale Ltrs(Ltrs)</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Test Ltrs(Ltrs)</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Amount(Rs)</span></td>");
       print("</tr>");
       
      	 
            foreach($sale_rpt as $openrow) {
                print("<tr class='small'>");
             print("<td width='10%' align='center'>".$openrow["acct_dates"]."</td>");
            
             print("<td width='10%' align='center'>".$openrow["pump_no"]."</td>");
             print("<td width='20%' align='center'>".$openrow["close_rdng"]."</td>");
             print("<td width='20%' align='center'>".$openrow["open_rdng"]."</td>");
             print("<td width='10%' align='center'>".$openrow["Sale_ltrs"]."</td>");             
             print("<td width='10%' align='center'>".$openrow["test_ltrs"]."</td>");             
             print("<td width='10%' align='center'>".$openrow["Amount"]."</td>");
          }
       print("<tr style='color:#9900CC;font-weight:bold;'>");
	   print("<td width='5%' align='center'></td>");
       print("<td width='7%' align='center'></td>");
       print("<td width='7%' align='center'></td>");
       print("<td width='7%' align='center'></td>");
       print("<td width='7%' align='center'></td>");
       print("<td width='7%' align='center'>Total</td>");
       print("<td width='7%' align='center'>".$total."</td>");
       print("</tr>");
          print("</table>");
if(empty($sale_rpt))
{
print("<div style='margin:150px 0px 0px 370px'>");	
print("<font style='font-size:2em;color:#254117; font-family:'BebasNeueRegular', Arial, Helvetica, sans-serif; >Nothing to Display...!</font>");
print("</div");	
}