<?php 

class Transactions_rpt{

        public function Export($data){
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=".date('dmY')."_Transactions_report.xls");
        print("<tr>");
        print("<p align='center' style='margin-top:10px;color:#006666;font-size:15pt;font-weight:bold;'>Bank Transaction Report</p>"); 
        print("</tr>");
        print("<table  border='1' align='left' cellpadding='1' cellspacing='1'  style='border-collapse:collapse;margin-bottom:20px;'>");
       print("<tr bgcolor='#559999'>");
       print("<td width='10%' align='center'>Deposited Date</td>");
       print("<td width='10%' align='center'>Bank Name</td>");
       print("<td width='23%' align='center'>Shift Date</td>");
       print("<td width='22%' align='center'>Amount(Rs)</td>");
       print("<td width='10%' align='center'>Remarks</td>");
       print("<td width='10%' align='center'>Added By</td>");
       print("<td width='15%' align='center'>Added Time</td>");
       print("</tr>");
       $total=0;
	   foreach($data as $openrow) {
        	 print("<tr class='small'>");
        	  print("<td width='10%' align='center'>".($openrow["deposited_date"]!='0000-00-00' ? date('d-m-Y',strtotime($openrow["deposited_date"])) : '')."</td>");
             print("<td width='10%' align='center'>".$openrow["bank_name"]."</td>");
             print("<td width='23%' align='center'>".$openrow["shift_date"]."</td>");
             print("<td width='22%' align='center'>".$openrow["amount"]."</td>");
             print("<td width='10%' align='center'>".$openrow["remarks"]."</td>");
             $total+=$openrow["amount"];
             print("<td width='10%' align='center'>".$openrow["added_by"]."</td>");
             print("<td width='10%' align='center'>".($openrow["added_time"]!='0000-00-00' ? date('d-m-Y H:m:s',strtotime($openrow["added_time"])) : '')."</td>");          
             print("</tr>");
          }
          print("<tr style='color:#9900CC;font-weight:bold;'>");
	   print("<td width='10%' align='center'></td>");
       print("<td width='23%' align='center'></td>");
       print("<td width='10%' align='center'>Total</td>");
       print("<td width='10%' align='center'>".$total."</td>");
       print("<td width='22%' align='center'></td>");
       print("<td width='10%' align='center'></td>");
       print("<td width='10%' align='center'></td>");
       print("</tr>");
          print("</table>");
        
        }
}

?>