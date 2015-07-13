<?php
 print("<table  border='1' align='left' cellpadding='1' cellspacing='1' style='overflow:scroll;border-collapse:collapse;'>");
       print("<tr bgcolor='#559999' id='hdr_row' style='color:white;border-right:1px solid white; '>");
       print("<td width='10%' align='center'><span class='txt1_color'>Date</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Product Category</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Indent sales</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Credit Card Sales</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>XtraReward Card Sales</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>XtraPower Card Sales</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Easy Fuel Sales</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Cheque Sales</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Cash Sales</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Total Sales</span></td>");
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
       foreach ($sales_stmt as $openrow){
       
       
	    //try using j\<\s\u\p\>S\<\/\s\u\p\> also to give suffix superscript
	   if($old_date!=$openrow["acct_date"]){
	   
	   	if($old_date!='' && $category=='all'){
	   	   print("<tr class='small' style='color:#4C0000;font-weight:bold;' align='center'>");
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
	   $r_indent_sales=0;
       $r_credit_sales=0;
       $r_xreward_sales=0;
       $r_xpower_sales=0;
       $r_easy_sales=0;
       $r_cheque_sales=0;
       $r_cash_sales=0;
       $r_total_sales=0;
	   $old_date=$openrow["acct_date"];
	   print("<tr class='small'>");
	   print("<td width='10%' align='center'>".date('d-m-Y', strtotime($openrow["acct_date"]))."</td>");
	   
	   }
	   else{
	   	print("<tr class='small'>");
	   	print("<td></td>");
	   }
	   print("<td width='10%' align='center'>".$openrow["category"]."</td>");
	   $t_indent_sales+=round($openrow["Indent_sales"],2);
	   $r_indent_sales+=round($openrow["Indent_sales"],2);
	   print("<td width='10%' align='center'>".round($openrow["Indent_sales"],2)."</td>");
	   $t_credit_sales+=round($openrow["Credit_card_sales"],2);
	   $r_credit_sales+=round($openrow["Credit_card_sales"],2);
	   print("<td width='10%' align='center'>".round($openrow["Credit_card_sales"],2)."</td>");
	   $t_xreward_sales+=round($openrow["XtraReward_sales"],2);
	   $r_xreward_sales+=round($openrow["XtraReward_sales"],2);
	   print("<td width='10%' align='center'>".round($openrow["XtraReward_sales"],2)."</td>");
	   $t_xpower_sales+=round($openrow["XtraPower_sales"],2);
	   $r_xpower_sales+=round($openrow["XtraPower_sales"],2);
	   print("<td width='10%' align='center'>".round($openrow["XtraPower_sales"],2)."</td>");
	   $t_easy_sales+=round($openrow["Easy_fuel_sales"],2);
	   $r_easy_sales+=round($openrow["Easy_fuel_sales"],2);
	   print("<td width='10%' align='center'>".round($openrow["Easy_fuel_sales"],2)."</td>");
	   $t_cheque_sales+=round($openrow["Cheque_sales"],2);
	   $r_cheque_sales+=round($openrow["Cheque_sales"],2);
	   print("<td width='10%' align='center'>".round($openrow["Cheque_sales"],2)."</td>");
	   $t_cash_sales+=round($openrow["Cash_sales"],2);
	   $r_cash_sales+=round($openrow["Cash_sales"],2);
	   print("<td width='10%' align='center'>".round($openrow["Cash_sales"],2)."</td>");
	   $t_total_sales+=round($openrow["Total_sales"],2);
	   $r_total_sales+=round($openrow["Total_sales"],2);
	   print("<td width='10%' align='center'>".round($openrow["Total_sales"],2)."</td>");
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
       print("<td></td><td> Grand Total</td>");
       print("<td>".round($t_indent_sales,2)."</td>");
       print("<td>".round($t_credit_sales,2)."</td>");
       print("<td>".round($t_xreward_sales,2)."</td>");
       print("<td>".round($t_xpower_sales,2)."</td>");
       print("<td>".round($t_easy_sales,2)."</td>");
       print("<td>".round($t_cheque_sales,2)."</td>");
       print("<td>".round($t_cash_sales,2)."</td>");
       print("<td>".round($t_total_sales,2)."</td>");
       print("</tr>");
       print("</table>");
       
       if(empty($sales_stmt))
			{
			print("<div style='padding:150px 0px 0px 370px'>");	
			print("<font style='font-size:2em;color:#254117; font-family:'BebasNeueRegular', Arial, Helvetica, sans-serif; >Nothing to Display...!</font>");
			print("</div");	
			}