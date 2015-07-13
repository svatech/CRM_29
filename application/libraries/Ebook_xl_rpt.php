<?php 

class ebook_xl_rpt{

        public function Export($data,$param){
        $form_data=explode("::", $param);
		$tank=$form_data[0];
		$month=$form_data[1];
		$year=$form_data[2];
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=EBOOK_FOR_".$month."-".$year.".xls");
        print("<table  border='1' align='left' cellpadding='1' cellspacing='1'  style='border-collapse:collapse;margin-bottom:20px;'>");
        print("<tr bgcolor='#518C9C'>");
        print("<td width='5%' align='center' colspan='13'>E-BOOK OF TANK ".$tank." FOR THE MONTH OF ".date('F-Y', strtotime("$year-$month-01"))."</td>");
        print("</tr>");
       print("<tr bgcolor='#518C9C'>");
       print("<td width='5%' align='center'>Date</td>");
       print("<td width='7%' align='center'>Opening Volume as per Tank</td>");
       print("<td width='7%' align='center'>Opening Balance</td>");
       print("<td width='7%' align='center'>Quantity Received</td>");
       print("<td width='7%' align='center'>Total Stock Qty</td>");
       print("<td width='7%' align='center'>Quantity Sold</td>");
       print("<td width='7%' align='center'>Quantity Tested</td>");
       print("<td width='7%' align='center'>Cumulative Sales</td>");
       print("<td width='7%' align='center'>Closing Balance</td>");
       print("<td width='7%' align='center'>Loss/Gain</td>");
       print("<td width='7%' align='center'>EL</td>");
       print("<td width='7%' align='center'>Tank Loss(4%)</td>");
       print("<td width='7%' align='center'>EL+TL</td>");
       print("</tr>");
         $next_day_open=0;
       $total_stock=0;
       $direct_sales=0;
       $total_sales=0;
       $cumm_sales=0;
       $open_bal=0;
       $closing_bal=0;
       $loss_gain=0;
       $el=0;
       $total_loss=0;
       foreach ($data as $openrow){
	   print("<tr class='td_rows'>"); //try using j\<\s\u\p\>S\<\/\s\u\p\> also to give suffix superscript
	   print("<td width='5%' align='center'>".date('jS M', strtotime($openrow["Date"]))."</td>");
	   print("<td width='7%' align='center'>".$openrow["volume"]."</td>");
	   if($next_day_open==0){
	   	$open_bal=$openrow["volume"];
	   }
	   else{
	   	$open_bal=$next_day_open;
	   }
	   print("<td width='7%' align='center'>".$open_bal."</td>");
	   print("<td width='7%' align='center'>".$openrow["received"]."</td>");
	   $total_stock=$open_bal+$openrow["received"];
	   print("<td width='7%' align='center'>".$total_stock."</td>");
	   $direct_sales=round($openrow["sold"],3);
	   print("<td width='7%' align='center'>".$direct_sales."</td>");
	   print("<td width='7%' align='center'>".$openrow["test"]."</td>");
	   $cumm_sales+=$direct_sales;
	   print("<td width='7%' align='center'>".round($cumm_sales,3)."</td>");
	   $closing_bal=$total_stock-$direct_sales;
	   $next_day_open=$closing_bal;
	   print("<td width='7%' align='center'>".round($closing_bal,3)."</td>");
	   $loss_gain=$openrow["volume"]-$open_bal;
	   print("<td width='7%' align='center'>".round($loss_gain,3)."</td>");
	   $el=$direct_sales*0.006;
	   print("<td width='7%' align='center'>".round($el,3)."</td>");
	   $tl=$openrow["volume"]*.04;
	   print("<td width='7%' align='center'>".round($tl,3)."</td>");
	   $total_loss=$tl+$el;
	    print("<td width='7%' align='center'>".round($total_loss,3)."</td>");
	   print("</tr>");
       }
                 print("</table>");
        
        }
}

?>