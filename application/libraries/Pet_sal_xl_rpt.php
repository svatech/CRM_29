<?php 

class Pet_sal_xl_rpt{

        public function Export($data){
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=".date('dmY')."_Petrol_Diesel_sales_report.xls");
        print("<tr>");
        print("<p align='center' style='margin-top:10px;color:#006666;font-size:15pt;font-weight:bold;'>Petrol/Diesel Sales Report</p>"); 
        print("</tr>");
        print("<table  border='1' align='left' cellpadding='1' cellspacing='1'  style='border-collapse:collapse;margin-bottom:20px;'>");
       print("<tr bgcolor='#559999'>");
       print("<td width='12%' align='center'>Date</td>");
       print("<td width='8%' align='center'>Shift</td>");
       print("<td width='8%' align='center'>Pump No</td>");
       print("<td width='16%' align='center'>Close Reading</td>");
       print("<td width='16%' align='center'>Open Reading</td>");
       print("<td width='10%' align='center'>Sale Ltrs</td>");
       print("<td width='10%' align='center'>Test Ltrs</td>");
       print("<td width='10%' align='center'>Rate</td>");
       print("<td width='10%' align='center'>Amount</td>");
       print("</tr>");
       $total=0;
       $total_sal=0;
       $total_sal_ltr=0;
 foreach($data as $openrow) {
        	    print("<tr class='small'>");
            print("<td width='12%' align='center'>".($openrow["acct_dates"]!='0000-00-00' ? date('d-m-Y',strtotime($openrow["acct_dates"])) : '')."</td>");
             print("<td width='8%' align='center'>".$openrow["shift"]."</td>");
             print("<td width='8%' align='center'>".$openrow["pump_no"]."</td>");
             print("<td width='16%' align='center'>".$openrow["close_reading"]."</td>");
             print("<td width='16%' align='center'>".$openrow["open_reading"]."</td>");
             print("<td width='10%' align='center'>".round($openrow["net_sales"],3)."</td>");             
             print("<td width='10%' align='center'>".round($openrow["test_litres"],3)."</td>");             
             print("<td width='10%' align='center'>".$openrow["rate"]."</td>");             
			 $total+=$openrow["test_litres"]; 
               $total_sal+=$openrow["amount"];
               $total_sal_ltr+=$openrow["net_sales"];
             print("<td width='10%' align='center'>".round($openrow["amount"],3)."</td>");
             print("</tr>");
          }
           print("<tr style='color:#9900CC;font-weight:bold;'>");
	   print("<td width='5%' align='center'></td>");
       print("<td width='7%' align='center'></td>");
       print("<td width='7%' align='center'></td>");
       print("<td width='7%' align='center'>Total</td>");
       print("<td width='7%' align='center'></td>");
       print("<td width='7%' align='center'>".$total_sal_ltr."</td>");
       print("<td width='7%' align='center'>".$total."</td>");
       print("<td width='7%' align='center'></td>");
       print("<td width='7%' align='center'>".$total_sal."</td>");
       print("</tr>");
          print("</table>");
        
        }
}

?>