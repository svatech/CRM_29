<?php

 $total=0;
  print("<table  border='1' align='left' cellpadding='1' cellspacing='1'  class='alt_row' style='border-collapse:collapse;'>");
       print("<tr bgcolor='#559999' id='hdr_row' style='background-color:#559999;color:white;border-right:1px solid white; '>");
       print("<td width='7%' align='center'><span class='txt1_color'>Bill No</span></td>");
       print("<td width='7%' align='center'><span class='txt1_color'>Bill Date</span></td>");
       print("<td width='22%' align='center'><span class='txt1_color'>Customer Name</span></td>");
       print("<td width='9%' align='center'><span class='txt1_color'>Reference No</span></td>");
       print("<td width='9%' align='center'><span class='txt1_color'>Sales from</span></td>");
       print("<td width='9%' align='center'><span class='txt1_color'>Upto</span></td>");
       print("<td width='9%' align='center'><span class='txt1_color'>Amount</span></td>");
       print("<td width='9%' align='center'><span class='txt1_color'>Paid Amount</span></td>");
       print("<td width='9%' align='center'><span class='txt1_color'>Balance</span></td>");
       print("<td width='9%' align='center'><span class='txt1_color'>Made By</span></td>");
      $tot_bill_amt=0;
      $tot_paid_amt=0;
      $tot_bal_amt=0;

      foreach($indent_stmt as $row) {
     		 print("<tr class='small'>");
       		 print("<td width='7%' align='center'>".$row["bill_no"]."</td>");
       		 print("<td width='7%' align='center'>".($row["bill_date"]!='0000-00-00' ? date('d-m-Y',strtotime($row["bill_date"])) : '')."</td>");
             print("<td width='22%' align='center'>".$row["customer_name"]."</td>");
             print("<td width='9%' align='center'>".$row["tin"]."</td>");
             print("<td width='9%' align='center'>".($row["from_date"]!='0000-00-00' ? date('d-m-Y',strtotime($row["from_date"])) : '')."</td>");
             print("<td width='9%' align='center'>".($row["to_date"]!='0000-00-00' ? date('d-m-Y',strtotime($row["to_date"])) : '')."</td>");
             $tot_bill_amt=$tot_bill_amt+$row["bill_amount"];
             print("<td width='9%' align='center'>".$row["bill_amount"]."</td>");
             $tot_paid_amt=$tot_paid_amt+$row["amount"];
             print("<td width='9%' align='center'>".$row["amount"]."</td>");
             $total= $row["bill_amount"]-$row["amount"];
             $tot_bal_amt=$tot_bal_amt+round($total,3);
             print("<td width='9%' align='center'>".round($total,3)."</td>");
             print("<td width='9%' align='center'>".$row["action_user"]."</td>");
            
            // print("<td width='10%'><a  href='javascript:show_rfid_details(\"".$openrow["bill_no"]."\");' id='edit_id' ><font color=''>Click</font></a></td>"); 
          }
     if($tot_bill_amt>0){
     	print("<tr style='color:#9900CC;font-weight:bold;'>");
     	print("<td colspan='6' align='right'>Total</td>");
     	print("<td width='10%' align='center'>".round($tot_bill_amt,2)."</td>");
     	print("<td width='10%' align='center'>".round($tot_paid_amt,2)."</td>");
     	print("<td width='10%' align='center'>".round($tot_bal_amt,2)."</td>");
     	print("<td width='9%' align='center'></td>");
     	print("</tr>");
     }
          print("</table>");
			if(empty($indent_stmt))
			{
			print("<div style='margin:150px 0px 0px 370px'>");	
			print("<font style='font-size:2em;color:#254117; font-family:'BebasNeueRegular', Arial, Helvetica, sans-serif; >Nothing to Display...!</font>");
			print("</div");	
			}
			?>