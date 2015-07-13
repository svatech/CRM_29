<?php 

class Test_reg_xl_rpt{

        public function Export($data){
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=".date('dmY')."_Testing_Register_report.xls");
         print("<tr>");
        print("<p align='center' style='margin-top:10px;color:#006666;font-size:15pt;font-weight:bold;'>Testing Litres Register</p>"); 
        print("</tr>");
        print("<table  border='1' align='left' cellpadding='1' cellspacing='1'  style='border-collapse:collapse;margin-bottom:20px;'>");
       print("<tr bgcolor='#559999'>");
       print("<td width='15%' align='center'>Date</td>");
       print("<td width='10%' align='center'>Shift</td>");
       print("<td width='15%' align='center'>Pump No</td>");
       print("<td width='15%' align='center'>Testing Litres</td>");
       print("<td width='15%' align='center'>Purpose</td>");
       print("<td width='15%' align='center'>Entered By</td>");
       print("<td width='15%' align='center'>Entered Time</td>");
       print("</tr>");
        $total=0;
 foreach($data as $openrow) {
        	 print("<tr class='small'>");
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
        
        }
}

?>