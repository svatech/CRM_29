<?php 

class Oth_sal_xl_rpt{

        public function Export($data){
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=".date('dmY')."_Other_sale_report.xls");
        print("<tr>");
        print("<p align='center' style='margin-top:10px;color:#006666;font-size:15pt;font-weight:bold;'>Other Sales Report</p>"); 
        print("</tr>");
        print("<table  border='1' align='left' cellpadding='1' cellspacing='1'  style='border-collapse:collapse;margin-bottom:20px;'>");
       print("<tr bgcolor='#559999'>");
       print("<td width='15%' align='center'>Date</td>");
       print("<td width='15%' align='center'>Shift</td>");
       print("<td width='30%' align='center'>Item Name</td>");
       print("<td width='10%' align='center'>Quantity(Ltrs)</td>");
       print("<td width='15%' align='center'>Rate(Rs)</td>");
       print("<td width='15%' align='center'>Amount(Rs)</td>");
       print("</tr>");
        $total=0;
 foreach($data as $openrow) {
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
        
        }
}

?>