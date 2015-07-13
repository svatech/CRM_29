<?php 

class Cumulative_Sales_stmt_xl_rpt{

        public function Export($params,$data){
        	$form_data=explode("::", $params);
			$sdate=$form_data[0];
			$edate=$form_data[1];
			$category=$form_data[2];
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=Sales Statement from ".$sdate."-".$edate.".xls");
        print("<table  border='1' align='left' cellpadding='1' cellspacing='1'  style='border-collapse:collapse;margin-bottom:20px;'>");
       print("<tr  style='color:#006666'>");
        print("<td width='5%' align='center' colspan='8'>Cumulative Sales Statement from ".date('d-m-Y', strtotime($sdate))." to ".date('d-m-Y', strtotime($edate))."</td>");
        print("</tr>");
        print("<tr bgcolor='#559999'>");
       print("<td width='10%' align='center'>Date</td>");
       print("<td width='10%' align='center'>Product Category</td>");
       print("<td width='10%' align='center'>Indent Sales</td>");
       print("<td width='10%' align='center'>Credit Card Sales</td>");
       print("<td width='10%' align='center'>XtraReward Card Sales</td>");
       print("<td width='10%' align='center'>XtraPower Card Sales</td>");
       print("<td width='10%' align='center'>Easy Fuel Sales</td>");
       print("<td width='10%' align='center'>Cheque Sales</td>");
       print("<td width='10%' align='center'>Cash Sales</td>");
       print("<td width='10%' align='center'>Total Sales</td>");
       print("</tr>");
       $old_date='';
       $t_indent_sales=0;
       $t_credit_sales=0;
       $t_xreward_sales=0;
       $t_xpower_sales=0;
       $t_easy_sales=0;
       $t_cheque_sales=0;
       $t_cash_sales=0;
       $t_total_sales=0;
       
       $r_indent_sales=0;
       $r_credit_sales=0;
       $r_xreward_sales=0;
       $r_xpower_sales=0;
       $r_easy_sales=0;
       $r_cheque_sales=0;
       $r_cash_sales=0;
       $r_total_sales=0;
       
	   foreach($data as $openrow) {
        	
		   if($old_date!=$openrow["acct_date"]){
		   	
		   if($old_date!='' && $category=='all'){
	   	   print("<tr class='td_rows' style='color:#4C0000;font-weight:bold;' align='center'>");
	       print("<td></td><td>Total</td>");
	       print("<td>".round($r_indent_sales,3)."</td>");
	       print("<td>".round($r_credit_sales,3)."</td>");
	       print("<td>".round($r_xreward_sales,3)."</td>");
	       print("<td>".round($r_xpower_sales,3)."</td>");
	       print("<td>".round($r_easy_sales,3)."</td>");
	       print("<td>".round($r_cheque_sales,3)."</td>");
	       print("<td>".round($r_cash_sales,3)."</td>");
	       print("<td>".round($r_total_sales,3)."</td>");
	       print("</tr>");
	   	}
	   	
	   	$r_indent_sales=0;
       $r_credit_sales=0;
       $r_xreward_sales=0;
       $r_xpower_sales=0;
       $r_easy_sales=0;
       $r_cheque_sales=0;
       $r_cash_sales=0;
       $r_total_sales=0;
       
       
		   $old_date=$openrow["acct_date"];
		   print("<tr class='td_rows'>");
		   print("<td width='10%' align='center'>".date('d-m-Y', strtotime($openrow["acct_date"]))."</td>");
		   }
		   else{
		   	print("<tr class='td_rows'>");
		   	print("<td></td>");
		   }
               print("<td width='10%' align='center'>".$openrow["category"]."</td>");
			   $t_indent_sales+=round($openrow["Indent_sales"],3);
			   $r_indent_sales+=round($openrow["Indent_sales"],3);
			   print("<td width='10%' align='center'>".round($openrow["Indent_sales"],3)."</td>");
			   $t_credit_sales+=round($openrow["Credit_card_sales"],3);
			   $r_credit_sales+=round($openrow["Credit_card_sales"],3);
			   print("<td width='10%' align='center'>".round($openrow["Credit_card_sales"],3)."</td>");
			   $t_xreward_sales+=round($openrow["XtraReward_sales"],3);
			   $r_xreward_sales+=round($openrow["XtraReward_sales"],3);
			   print("<td width='10%' align='center'>".round($openrow["XtraReward_sales"],3)."</td>");
			   $t_xpower_sales+=round($openrow["XtraPower_sales"],3);
			   $r_xpower_sales+=round($openrow["XtraPower_sales"],3);
			   print("<td width='10%' align='center'>".round($openrow["XtraPower_sales"],3)."</td>");
			   $t_easy_sales+=round($openrow["Easy_fuel_sales"],3);
			   $r_easy_sales+=round($openrow["Easy_fuel_sales"],3);
			   print("<td width='10%' align='center'>".round($openrow["Easy_fuel_sales"],3)."</td>");
			   $t_cheque_sales+=round($openrow["Cheque_sales"],3);
			   $r_cheque_sales+=round($openrow["Cheque_sales"],3);
			   print("<td width='10%' align='center'>".round($openrow["Cheque_sales"],3)."</td>");
			   $t_cash_sales+=round($openrow["Cash_sales"],3);
			   $r_cash_sales+=round($openrow["Cash_sales"],3);
			   print("<td width='10%' align='center'>".round($openrow["Cash_sales"],3)."</td>");
			   $t_total_sales+=round($openrow["Total_sales"],3);
			   $r_total_sales+=round($openrow["Total_sales"],3);
			   print("<td width='10%' align='center'>".round($openrow["Total_sales"],3)."</td>");
               print("</tr>");
          }
         if($category=='all'){
       	   print("<tr class='td_rows' style='color:#4C0000;font-weight:bold;' align='center'>");
	       print("<td></td><td>Total</td>");
	       print("<td>".round($r_indent_sales,2)."</td>");
	       print("<td>".round($r_credit_sales,2)."</td>");
	       print("<td>".round($r_xreward_sales,2)."</td>");
	       print("<td>".round($r_xpower_sales,2)."</td>");
	       print("<td>".round($r_easy_sales,2)."</td>");
	       print("<td>".round($r_cheque_sales,2)."</td>");
	       print("<td>".round($r_cash_sales,2)."</td>");
	       print("<td>".round($r_total_sales,2)."</td>");
	       print("</tr>");
       }
         
          print("<tr class='td_rows' style='color:#000000;font-weight:bold;' align='center'>");
       print("<td></td><td>Total</td>");
       print("<td>".round($t_indent_sales,3)."</td>");
       print("<td>".round($t_credit_sales,3)."</td>");
       print("<td>".round($t_xreward_sales,3)."</td>");
       print("<td>".round($t_xpower_sales,3)."</td>");
       print("<td>".round($t_easy_sales,3)."</td>");
       print("<td>".round($t_cheque_sales,3)."</td>");
       print("<td>".round($t_cash_sales,3)."</td>");
       print("<td>".round($t_total_sales,3)."</td>");
       print("</tr>");
       
          print("</table>");
        
        }
}

?>