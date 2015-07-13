<?php
  print("<table  border='1' align='left' cellpadding='1' cellspacing='1'  class='alt_row' style='border-collapse:collapse;'>");
       print("<tr bgcolor='#559999' id='hdr_row' style='background-color:#559999;color:white;border-right:1px solid white; '>");
       print("<td width='10%' align='center'><span class='txt1_color'>Vehicle No</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Action Time</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Bill No</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Bill Date</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Details</span></td>");

       foreach($result as $openrow) {
     		 print("<tr class='small'>");
       		 print("<td width='10%' align='center'>".$openrow["vehicle_no"]."</td>");
             print("<td width='20%' align='center'>".$openrow["action_time"]."</td>");
             print("<td width='10%' align='center'>".$openrow["bill_no"]."</td>");
             print("<td width='30%' align='center'>".$openrow["bill_time"]."</td>");
             print("<td width='10%'><a  href='javascript:show_rfid_details(\"".$openrow["bill_no"]."\");' id='edit_id' ><font color=''>Click</font></a></td>"); 
          }
     
          print("</table>");
			if(empty($result))
			{
			print("<div style='margin:150px 0px 0px 370px'>");	
			print("<font style='font-size:2em;color:#254117; font-family:'BebasNeueRegular', Arial, Helvetica, sans-serif; >Nothing to Display...!</font>");
			print("</div");	
			}
			?>