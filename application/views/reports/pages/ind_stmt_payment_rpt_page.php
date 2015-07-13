<?php
 print("<table width='100%' border='1' align='left' cellpadding='1' class='alt_row' cellspacing='1' margin='10px' style='border-collapse:collapse;margin-bottom:20px;'>");
       print("<tr bgcolor='#559999' id='hdr_row' style='background-color:#559999;color:white;border-right:1px solid white;'>");
       print("<td width='10%' align='center'><span class='txt1_color'>Bill No</span></td>");
       print("<td width='20%' align='center'><span class='txt1_color'>Customer Name</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Ref No</span></td>");
       print("<td width='8%' align='center'><span class='txt1_color'>Payment Mode</span></td>");
       print("<td width='8%' align='center'><span class='txt1_color'>Amount</span></td>");
       print("<td width='8%' align='center'><span class='txt1_color'>Payment Date</span></td>");
       print("<td width='9%' align='center'><span class='txt1_color'>Cheque No</span></td>");
       print("<td width='9%' align='center'><span class='txt1_color'>Cheque Date</span></td>");
       print("<td width='9%' align='center'><span class='txt1_color'>Cheque Status</span></td>");
       print("<td width='15%' align='center'><span class='txt1_color'>Bank Name</span></td>");
       print("<td width='12%' align='center'><span class='txt1_color'>Clearance Date</span></td>");
       print("</tr>");
       			$total=0;
      	    foreach($indent_rpt as $openrow) {
        	 print("<tr class='small'>");
			 print("<td width='10%' align='center'>".$openrow["bill_no"]."</td>");
             print("<td width='20%' align='center'>".$openrow["customer_name"]."</td>");
             print("<td width='10%' align='center'>".$openrow["tin"]."</td>");
             print("<td width='8%' align='center'>".$openrow["payment_mode"]."</td>");
             print("<td width='8%' align='center'>".$openrow["amount"]."</td>");
             print("<td width='8%' align='center'>".($openrow["payment_date"]!='0000-00-00' ? date('d-m-Y',strtotime($openrow["payment_date"])) : '')."</td>");
             print("<td width='9%' align='center'>".$openrow["cheque_no"]."</td>");             
             print("<td width='9%' align='center'>".($openrow["cheque_date"]!='0000-00-00' && $openrow["cheque_date"]!=''? date('d-m-Y',strtotime($openrow["cheque_date"])) : '')."</td>");
             print("<td width='9%' align='center'>".$openrow["cheque_status"]."</td>");             
             print("<td width='15%' align='center'>".$openrow["bank_name"]."</td>");
             print("<td width='10%' align='center'>".($openrow["clearance_date"]!='0000-00-00' && $openrow["clearance_date"]!='' ? date('d-m-Y',strtotime($openrow["clearance_date"])) : '')."</td>");
             $total+=$openrow["amount"];
             print("</tr>");
            }
			print("<tr style='color:#9900CC;font-weight:bold;'>");
	   print("<td width='10%' align='center'></td>");
       print("<td width='20%' align='center'></td>");
       print("<td width='10%' align='center'></td>");
       print("<td width='8%' align='center'>Total</td>");
       print("<td width='8%' align='center'>".$total."</td>");
       print("<td width='8%' align='center'></td>");
       print("<td width='9%' align='center'></td>");
       print("<td width='9%' align='center'></td>");
       print("<td width='9%' align='center'></td>");
       print("<td width='15%' align='center'></td>");
       print("<td width='10%' align='center'></td>");
       print("</tr>");
          print("</table>");
          	if(empty($indent_rpt))
			{
			print("<div style='margin:150px 0px 0px 370px'>");	
			print("<font style='font-size:2em;color:#254117; font-family:'BebasNeueRegular', Arial, Helvetica, sans-serif; >Nothing to Display...!</font>");
			print("</div");	
			}
  