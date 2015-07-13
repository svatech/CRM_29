<?php
  print("<table  border='1' align='left' cellpadding='1' cellspacing='1'  class='alt_row' style='border-collapse:collapse;'>");
       print("<tr bgcolor='#559999' id='hdr_row' style='background-color:#559999;color:white;border-right:1px solid white; '>");
       print("<td width='10%' align='center'><span class='txt1_color'>Date</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Bill No</span></td>");
       print("<td width='23%' align='center'><span class='txt1_color'>Vendor Name</span></td>");
       print("<td width='22%' align='center'><span class='txt1_color'>Items Purchased</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Amount(Rs)</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Added By</span></td>");
       print("<td width='15%' align='center'><span class='txt1_color'>Added Time</span></td>");
       print("</tr>");
       $total=0;
       foreach($expenses_rpt as $openrow) {
       		 print("<tr class='small'>");
       		 print("<td width='10%' align='center'>".($openrow["exp_date"]!='0000-00-00' ? date('d-m-Y',strtotime($openrow["exp_date"])) : '')."</td>");
             print("<td width='10%' align='center'>".$openrow["bill_no"]."</td>");
             print("<td width='23%' align='center'>".$openrow["vendor_name"]."</td>");
             print("<td width='22%' align='center'>".$openrow["items"]."</td>");
             print("<td width='10%' align='center'>".$openrow["amount"]."</td>");
             $total+=$openrow["amount"];
             print("<td width='10%' align='center'>".$openrow["added_by"]."</td>");
              print("<td width='10%' align='center'>".($openrow["added_time"]!='0000-00-00' ? date('d-m-Y H:m:s',strtotime($openrow["added_time"])) : '')."</td>");             
             print("</tr>");
          }
          print("<tr style='color:#9900CC;font-weight:bold;'>");
		   print("<td width='10%' align='center'></td>");
	       print("<td width='10%' align='center'></td>");
	       print("<td width='23%' align='center'></td>");
	       print("<td width='22%' align='center'>Total</td>");
	       print("<td width='10%' align='center'>".$total."</td>");
	       print("<td width='10%' align='center'></td>");
	       print("<td width='10%' align='center'></td>");
	       print("</tr>");
          print("</table>");
			if(empty($expenses_rpt))
			{
			print("<div style='margin:150px 0px 0px 370px'>");	
			print("<font style='font-size:2em;color:#254117; font-family:'BebasNeueRegular', Arial, Helvetica, sans-serif; >Nothing to Display...!</font>");
			print("</div");	
			}