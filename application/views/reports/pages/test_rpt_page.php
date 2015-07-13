<?php
 print("<table width='100%' border='1' align='left' class='alt_row' cellpadding='1' cellspacing='1' margin='10px' style='border-collapse:collapse;margin-bottom:20px;'>");
       print("<tr bgcolor='#559999' id='hdr_row' style='background-color:#559999;color:white;border-right:1px solid white;'>");
       print("<td width='15%' align='center'><span class='txt1_color'>Date</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Shift</span></td>");
       print("<td width='15%' align='center'><span class='txt1_color'>Pump No</span></td>");
       print("<td width='15%' align='center'><span class='txt1_color'>Testing Litres</span></td>");
       print("<td width='15%' align='center'><span class='txt1_color'>Purpose</span></td>");
       print("<td width='15%' align='center'><span class='txt1_color'>Entered By</span></td>");
       print("<td width='15%' align='center'><span class='txt1_color'>Entered Time</span></td>");
       print("</tr>");
       
      	    $total=0;
            foreach($test_info as $openrow) {
        	 print("<tr class='small' align='center'>");
              print("<td width='15%' align='center'>".($openrow["account_date"]!='0000-00-00' ? date('d-m-Y',strtotime($openrow["account_date"])) : '')."</td>");
             print("<td width='10%' align='center'>".$openrow["shift"]."</td>");
             print("<td width='15%' align='center'>".$openrow["pump_no"]."</td>");
             print("<td width='15%' align='center'>".round($openrow["test_qty"],3)."</td>");
             $total+=$openrow["test_qty"];
             print("<td width='15%' align='center'>".$openrow["purpose"]."</td>");
             print("<td width='15%' align='center'>".$openrow["added_by"]."</td>");
             print("<td width='15%' align='center'>".($openrow["added_time"]!='0000-00-00' ? date('d-m-Y H:m:s',strtotime($openrow["added_time"])) : '')."</td>");
             print("</tr>");
          }
          print("<tr style='color:#9900CC;font-weight:bold;'>");
	   print("<td width='15%' align='center'></td>");
       print("<td width='10%' align='center'></td>");
       print("<td width='15%' align='center'>Total</td>");
       print("<td width='15%' align='center'>".$total."</td>");
       print("<td width='15%' align='center'></td>");
       print("<td width='15%' align='center'></td>");
       print("<td width='15%' align='center'></td>");
       print("</tr>");
          print("</table>");
  			if(empty($test_info))
			{
			print("<div style='margin:150px 0px 0px 370px'>");	
			print("<font style='font-size:2em;color:#254117; font-family:'BebasNeueRegular', Arial, Helvetica, sans-serif; >Nothing to Display...!</font>");
			print("</div");	
			}