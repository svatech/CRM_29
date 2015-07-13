<?php

class Cash_inflow_rpt{
	

 public function Export($data){
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=".date('dmY')."_Cash_Inflow_Report.xls");
        print("<tr>");
        print("<p align='center' style='margin-top:10px;color:#006666;font-size:15pt;font-weight:bold;'>Cash Inflow Report</p>"); 
        print("</tr>");
        
  print("<table  border='1' align='left' cellpadding='1' cellspacing='1'  class='alt_row' style='border-collapse:collapse;'>");
       print("<tr bgcolor='#559999' id='hdr_row' style='background-color:#559999;color:white;border-right:1px solid white; '>");
       print("<td width='10%' align='center'>Date</td>");
       print("<td width='20%' align='center'>Cash Source</td>");
       print("<td width='10%' align='center'>Amount</td>");
       print("<td width='30%' align='center'>Remarks</td>");
       print("<td width='15%' align='center'>Added By</td>");
       print("<td width='15%' align='center'>Added Time</td>");
       print("</tr>");
       $total=0;
       foreach($data as $openrow) {
       		 print("<tr class='small'>");
       		  print("<td width='10%' align='center'>".($openrow["transaction_date"]!='0000-00-00' ? date('d-m-Y',strtotime($openrow["transaction_date"])) : '')."</td>");
             print("<td width='20%' align='center'>".$openrow["cash_source"]."</td>");
             print("<td width='10%' align='center'>".$openrow["amount"]."</td>");
             print("<td width='30%' align='center'>".$openrow["remarks"]."</td>");
             $total+=$openrow["amount"];
             print("<td width='15%' align='center'>".$openrow["added_by"]."</td>");
            print("<td width='15%' align='center'>".($openrow["added_time"]!='0000-00-00' ? date('d-m-Y H:m:s',strtotime($openrow["added_time"])) : '')."</td>");                  
             print("</tr>");
          }
             print("<tr style='color:#9900CC;font-weight:bold;'>");
	   print("<td width='10%' align='center'></td>");
	   print("<td width='20%' align='center'>Total</td>");
       print("<td width='10%' align='center'>".$total."</td>");
       print("<td width='30%' align='center'></td>");  
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