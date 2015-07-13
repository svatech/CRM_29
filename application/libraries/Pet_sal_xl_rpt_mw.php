<?php 

class Pet_sal_xl_rpt_mw{

        public function Export($data){
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=".date('dmY')."_Petrol_Diesel_Sales_Report.xls");
         print("<tr>");
        print("<p align='center' style='margin-top:10px;color:#006666;font-size:15pt;font-weight:bold;'>Monthwise Petrol/Diesel Sales Report</p>"); 
        print("</tr>");
        print("<table  border='1' align='left' cellpadding='1' cellspacing='1'  style='border-collapse:collapse;margin-bottom:20px;'>");
       print("<tr bgcolor='#559999'>");
       
       print("<td width='10%' align='center'>Date</td>");
       print("<td width='10%' align='center'>Pump No</td>");
       print("<td width='20%' align='center'>Close Reading</td>");
       print("<td width='20%' align='center'>Open Reading</td>");
       print("<td width='10%' align='center'>Sale Ltrs(Ltrs)</td>");
       print("<td width='10%' align='center'>Test Ltrs(Ltrs)</td>");
       print("<td width='10%' align='center'>Amount(Rs)</td>");
       print("</tr>");
       $total=0;
 foreach($data as $openrow) {
        	    print("<tr class='small'>");
             
             print("<td width='12%' align='center'>".($openrow["acct_dates"]!='0000-00-00' ? date('d-m-Y',strtotime($openrow["acct_dates"])) : '')."</td>");
             print("<td width='10%' align='center'>".$openrow["pump_no"]."</td>");
             print("<td width='20%' align='center'>".$openrow["close_rdng"]."</td>");
             print("<td width='20%' align='center'>".$openrow["open_rdng"]."</td>");
             print("<td width='10%' align='center'>".$openrow["Sale_ltrs"]."</td>");             
             print("<td width='10%' align='center'>".$openrow["test_ltrs"]."</td>");             
             print("<td width='10%' align='center'>".$openrow["Amount"]."</td>");
             $total+=$openrow["Amount"];
             print("</tr>");
          }
          print("<tr style='color:#9900CC;font-weight:bold;'>");
	   print("<td width='5%' align='center'></td>");
       print("<td width='7%' align='center'></td>");
       print("<td width='7%' align='center'></td>");
       print("<td width='7%' align='center'></td>");
       print("<td width='7%' align='center'></td>");
       print("<td width='7%' align='center'>Total</td>");
       print("<td width='7%' align='center'>".$total."</td>");
       print("</tr>");
          print("</table>");
        
        }
}

?>