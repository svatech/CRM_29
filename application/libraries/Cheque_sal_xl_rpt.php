<?php

class Cheque_sal_xl_rpt{
	

 public function Export($data){
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=".date('dmY')."_Cheque_Sal_Report.xls");
        print("<tr>");
        print("<p align='center' style='margin-top:10px;color:#006666;font-size:15pt;font-weight:bold;'>Cheque Sales Report</p>"); 
        print("</tr>");
 		print("<table width='100%' border='1' align='left' cellpadding='1' class='alt_row' cellspacing='1' margin='10px' style='border-collapse:collapse;margin-bottom:20px;'>");
       print("<tr bgcolor='#559999' id='hdr_row' style='background-color:#559999;color:white;border-right:1px solid white;'>");
       print("<td width='10%' align='center'><span class='txt1_color'>Bill No</span></td>");
       print("<td width='20%' align='center'><span class='txt1_color'>Customer Name</span></td>");
       print("<td width='9%' align='center'><span class='txt1_color'>Vehicle no</span></td>");
       print("<td width='9%' align='center'><span class='txt1_color'>Amount</span></td>");
       print("<td width='8%' align='center'><span class='txt1_color'>Payment Date</span></td>");
       print("<td width='9%' align='center'><span class='txt1_color'>Cheque No</span></td>");
       print("<td width='9%' align='center'><span class='txt1_color'>Cheque Date</span></td>");
       print("<td width='15%' align='center'><span class='txt1_color'>Bank Name</span></td>");
       print("<td width='15%' align='center'><span class='txt1_color'>Cheque Status</span></td>");
        print("<td width='9%' align='center'><span class='txt1_color'>Clearance Date</span></td>");
       print("</tr>");
       $total=0;
      	    foreach($data as $openrow) {
        	 print("<tr class='small'>");
			 print("<td width='10%' align='center'>".$openrow["bill_number"]."</td>");
             print("<td width='20%' align='center'>".$openrow["customer_name"]."</td>");
			 print("<td width='9%' align='center'>".$openrow["vehicle_number"]."</td>");
             print("<td width='9%' align='center'>".$openrow["total_amount"]."</td>");
             $total+=$openrow["total_amount"];
             print("<td width='8%' align='center'>".$openrow["acct_date"]."</td>");
             print("<td width='9%' align='center'>".$openrow["cheque_no"]."</td>");             
             print("<td width='9%' align='center'>".$openrow["cheque_date"]."</td>");             
             print("<td width='15%' align='center'>".$openrow["bank_name"]."</td>");
			  print("<td width='15%' align='center'>".$openrow["cheque_status"]."</td>");
			    print("<td width='9%' align='center'>".($openrow["clearance_date"]!='0000-00-00' && $openrow["clearance_date"]!='' ? date('d-m-Y',strtotime($openrow["clearance_date"])) : '')."</td>");
             print("</tr>");
            }
			print("<tr style='color:#9900CC;font-weight:bold;'>");
	   print("<td width='15%' align='center'></td>");
	   print("<td width='15%' align='center'></td>");
	   print("<td width='15%' align='center'>Total</td>");
       print("<td width='10%' align='center'>".$total."</td>");
       print("<td width='15%' align='center'></td>");
       print("<td width='15%' align='center'></td>");
       print("<td width='15%' align='center'></td>");
       print("<td width='15%' align='center'></td>");
       print("<td width='15%' align='center'></td>");
       print("<td width='15%' align='center'></td>");
       print("</tr>");
          print("</table>");
          	if(empty($data))
			{
			print("<div style='margin:150px 0px 0px 370px'>");	
			print("<font style='font-size:2em;color:#254117; font-family:'BebasNeueRegular', Arial, Helvetica, sans-serif; >Nothing to Display...!</font>");
			print("</div");	
			}
 }
}
  
?>
