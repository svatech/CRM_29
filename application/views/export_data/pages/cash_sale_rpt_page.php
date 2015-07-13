<?php
 	   print("<table width='100%' border='1' align='left' cellpadding='1' class='alt_row' cellspacing='1' margin='10px' style='border-collapse:collapse;margin-bottom:20px;'>");
 	   print("<tr bgcolor='#559999' id='hdr_row' style='background-color:#559999;color:white;border-right:1px solid white;'>");
 	   print("<td width='5%' align='center'><span class='txt1_color'>Sale Date<span></td>");
       print("<td width='5%' align='center'><span class='txt1_color'>Month<span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Reference<span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>SAP ICICI Bank Code<span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Amount<span></td>");
	   print("<td width='5%' align='center'><span class='txt1_color'>Sale Date<span></td>");
	   print("<td width='5%' align='center'><span class='txt1_color'>Sale Date<span></td>");
	   print("<td width='10%' align='center'><span class='txt1_color'>Assignment<span></td>");
	   print("<td width='16%' align='center'><span class='txt1_color'>Party Details<span></td>");
	   print("<td width='6%' align='center'><span class='txt1_color'>Customer Code<span></td>");
	   print("<td width='5%' align='center'><span class='txt1_color'>Bus.area<span></td>"); 
	   print("<td width='5%' align='center'><span class='txt1_color'>Profit Center<span></td>");
	   print("<td width='8%' align='center'><span class='txt1_color'>Section Code<span></td>");
	   print("</tr>");
       $sec_code='';
       $ref='';
       $bus_area='';
       $sap_sale='';
       $cost_cen='';
       $profit_cen='';
       $sale_code1='';
   	   $counter=0;
    foreach($indent_stmt1 as $row) {
    $sec_code=$row["section_code"];
    $ref=$row["cash_sales_rpt_ref"];
    $bus_area=$row["business_area"];
    $sap_sale=$row["sap_sale_code"];
    $cost_cen=$row["cost_center"];
    $profit_cen=$row["profit_center"];
    }
    foreach($sale_code as $row) {
    $sale_code1=$row["reference_no"];
    
    }
  foreach($cash_rpt as $row) {
   		
     	print("<tr class='td_rows'>");
        $date =$row["payment_date"];
     	$time  = strtotime($date);
		$day   = date('d',$time);
		$month = date('m',$time);
		$year  = date('Y',$time);
		if($month<=3)
		{
			$month=$month+12;
		}
		else 
		{
			$month=$month;
		}	
    	print("<td width='5%' align='center'>".($row["payment_date"]!='0000-00-00' ? date('d-m-Y',strtotime($row["payment_date"])) : '')."</td>");
    	print("<td width='5%' align='center'>".($month-3)."</td>");  
    	print("<td width='10%' align='center'>".$ref."</td>");
    	print("<td width='10%' align='center'>".$sale_code1."</td>");
    	print("<td width='10%' align='center'>".round($row["amount"],2)."</td>");
    	print("<td width='5%' align='center'>".($row["payment_date"]!='0000-00-00' ? date('d-m-Y',strtotime($row["payment_date"])) : '')."</td>");
    	print("<td width='5%' align='center'>".($row["payment_date"]!='0000-00-00' ? date('d-m-Y',strtotime($row["payment_date"])) : '')."</td>");
		print("<td width='10%' align='center'>".$row["customer_name"]."</td>");
		print("<td width='16%' align='center'> ".$row["bill_no"]." " .$row["customer_name"]." " .$ref."</td>");
    	print("<td width='6%' align='center'>".$row["tin"]."</td>");
    	print("<td width='5%' align='center'>".$bus_area."</td>");
    	print("<td width='5%' align='center'>".$profit_cen."</td>");
    	print("<td width='10%' align='center'>".$sec_code."</td>");
    	print("</tr>");    	
		 }
print("</table>");  
?>
