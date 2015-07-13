<?php 

class Ind_sal_xl_rpt{

        public function Export($data,$param){
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=".date('dmY')."_Indent_sales_report.xls");
        print("<tr>");
        print("<p align='center' style='margin-top:10px;color:#006666;font-size:15pt;font-weight:bold;'>Indent Sales Report</p>"); 
        print("</tr>");
        print("<table  border='1' align='left' cellpadding='1' cellspacing='1'  style='border-collapse:collapse;margin-bottom:20px;'>");
       print("<tr bgcolor='#559999' id='hdr_row' style='background-color:#559999;color:white;border-right:1px solid white; '>");
       print("<td width='10%' align='center'>Acct Date</td>");
       print("<td width='10%' align='center'>Bill No</td>");
       print("<td width='10%' align='center'>Indent No</td>");
       print("<td width='10%' align='center'>Shift</td>");
       print("<td width='20%' align='center'>Party Name</td>");
       print("<td width='10%' align='center'>Vehicle</td>");
       print("<td width='10%' align='center'>Product</td>");
       print("<td width='10%' align='center'>Litres</td>");
       print("<td width='10%' align='center'>Amount(Rs)</td>");
       print("</tr>");
        $total=0;
 foreach($data as $openrow) {
 	$CI =& get_instance();
			$CI->load->model('Reports_model');
			$result = $CI->Reports_model->ind_sal_report_details($openrow["bill_number"]);
			$ctr=1;
			$tot_ltrs=0;
 		foreach ($result as $val) {
			if($ctr==1){
			 print("<tr class='small'>");
			 print("<td width='9%' align='center'>".($openrow["bill_date"]!='0000-00-00' ? date('d-m-Y',strtotime($openrow["bill_date"])) : '')."</td>");
             print("<td width='10%' align='center'>".$openrow["bill_number"]."</td>");
             print("<td width='10%' align='center'>".$openrow["indent_no"]."</td>");
             print("<td width='10%' align='center'>".$openrow["shift"]."</td>");
             print("<td width='20%' align='center'>".$openrow["customer_name"]."</td>");
             print("<td width='10%' align='center'>".$openrow["vehicle_number"]."</td>");             
             print("<td width='10%' align='center'>".$val["product"]."</td>");             
             print("<td width='10%' align='center'>".$val["quantity"]."</td>");
             print("<td width='10%' align='center'>".$val["value"]."</td>");
			$total+=$val["value"];
             print("</tr>");
             $ctr++;
             $tot_ltrs+=$val["quantity"];
			}
			else{
			 print("<tr class='small'>");
			 print("<td width='10%' align='center'></td>");
             print("<td width='10%' align='center'></td>");
             print("<td width='10%' align='center'></td>");
             print("<td width='10%' align='center'></td>");
             print("<td width='10%' align='center'></td>");
             print("<td width='20%' align='center'></td>");
             print("<td width='10%' align='center'>".$val["product"]."</td>");             
             print("<td width='10%' align='center'>".$val["quantity"]."</td>");             
             print("<td width='10%' align='center'>".$val["value"]."</td>");
             print("</tr>");
             $total+=$val["value"];
             $tot_ltrs+=$val["quantity"];
			}
          }
 }
  print("<tr style='color:#9900CC;font-weight:bold;'>");
          print("<td width='10%' align='center'></td>");
       print("<td width='10%' align='center'></td>");
       print("<td width='10%' align='center'></td>");
       print("<td width='10%' align='center'></td>");
       print("<td width='10%' align='center'></td>");
       print("<td width='20%' align='center'></td>");
       print("<td width='10%' align='center'></td>");
       print("<td width='10%' align='center'>Total</td>");
       print("<td width='10%' align='center'>".$total."</td>");
       print("</tr>");
          print("</table>");
        
        }
}

?>