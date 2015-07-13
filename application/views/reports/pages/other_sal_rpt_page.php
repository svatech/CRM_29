<?php
 print("<table width='100%' border='1' align='left' class='alt_row' cellpadding='1' cellspacing='1' margin='10px' style='border-collapse:collapse;margin-bottom:20px;'>");
       print("<tr bgcolor='#559999' id='hdr_row' style='background-color:#559999;color:white;border-right:1px solid white;'>");
       print("<td width='15%' align='center'><span class='txt1_color'>Date</span></td>");
       print("<td width='15%' align='center'><span class='txt1_color'>Shift</span></td>");
       print("<td width='30%' align='center'><span class='txt1_color'>Item Name</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Quantity(Ltrs)</span></td>");
       print("<td width='15%' align='center'><span class='txt1_color'>Rate(Rs)</span></td>");
       print("<td width='15%' align='center'><span class='txt1_color'>Amount(Rs)</span></td>");
       print("</tr>");
       $total=0;
      	    
            foreach($other_rpt as $openrow) {
        	    print("<tr class='small'>");
			print("<td width='15%' align='center'>".($openrow["acct_date"]!='0000-00-00' ? date('d-m-Y',strtotime($openrow["acct_date"])) : '')."</td>");
             print("<td width='15%' align='center'>".$openrow["shift"]."</td>");
             print("<td width='30%' align='center'>".$openrow["product"]."</td>");
             print("<td width='10%' align='center'>".$openrow["qty"]."</td>");
             print("<td width='15%' align='center'>".$openrow["rate"]."</td>");
		
             print("<td width='15%' align='center'>".round($openrow["amt"],3)."</td>");             
			$total+=$openrow["amt"];
             print("</tr>");
          }
          print("<tr style='color:#9900CC;font-weight:bold;'>");
          print("<td width='15%' align='center'></td>");
       print("<td width='15%' align='center'></td>");
       print("<td width='30%' align='center'></td>");
       print("<td width='10%' align='center'></td>");
       print("<td width='10%' align='center'>Total</td>");
       print("<td width='10%' align='center'>".$total."</td>");
       print("</tr>");
          print("</table>");
  			if(empty($other_rpt))
			{
			print("<div style='margin:150px 0px 0px 370px'>");	
			print("<font style='font-size:2em;color:#254117; font-family:'BebasNeueRegular', Arial, Helvetica, sans-serif; >Nothing to Display...!</font>");
			print("</div");	
			}