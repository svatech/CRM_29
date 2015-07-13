<?php
class Indent_statement_payment_xl_rpt{
	

 public function Export($data,$data1,$data2){
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=".date('dmY')."_Indent_payment_Report.xls");
        print("<tr>");
        print("<p align='center' style='margin-top:10px;color:#006666;font-size:15pt;font-weight:bold;'>Indent Statement Payment Report</p>"); 
        print("</tr>");
        
         print("<table width='100%' border='1' align='left' cellpadding='1' class='alt_row' cellspacing='1' margin='10px' style='border-collapse:collapse;margin-bottom:20px;'>");
 	   print("<tr bgcolor='#559999' id='hdr_row' style='background-color:#559999;color:white;border-right:1px solid white;'>");
 	   print("<td width='5%' align='center'><span class='txt1_color'>Bank CLG Date<span></td>");
       print("<td width='5%' align='center'><span class='txt1_color'>Period<span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Reference<span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>SAP ICICI Bank Code<span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Amount<span></td>");
	   print("<td width='5%' align='center'><span class='txt1_color'>Bank CLG Date<span></td>");
	   print("<td width='5%' align='center'><span class='txt1_color'>Bank CLG Date<span></td>");
	   print("<td width='10%' align='center'><span class='txt1_color'>Assignment<span></td>");
	   print("<td width='20%' align='center'><span class='txt1_color'>Text<span></td>");
	   print("<td width='5%' align='center'><span class='txt1_color'>Customer Code<span></td>");
	   print("<td width='5%' align='center'><span class='txt1_color'>Business Area<span></td>"); 
	   print("<td width='5%' align='center'><span class='txt1_color'>Profit Center<span></td>");
	   print("<td width='8%' align='center'><span class='txt1_color'>Section Code<span></td>");
	   print("</tr>");
       $sec_code='';
       $ref='';
       $bus_area='';
       $sap_sale='';
       $cost_cen='';
       $profit_cen='';
   	   $counter=0;
    foreach($data1 as $row) {
    $sec_code=$row["section_code"];
    $ref=$row["indent_pmt_rpt_ref"];
    $bus_area=$row["business_area"];
    $sap_sale=$row["sap_sale_code"];
    $cost_cen=$row["cost_center"];
    $profit_cen=$row["profit_center"];
    }
     foreach($data2 as $row) {
    $sale_code1=$row["reference_no"];
    
    }
  foreach($data as $row) {
   		
     	print("<tr class='td_rows'>");
        $date =$row["clearance_date"];
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
    	print("<td width='5%' align='center'>".($row["clearance_date"]!='0000-00-00' ? date('d-m-Y',strtotime($row["clearance_date"])) : '')."</td>");
    	print("<td width='5%' align='center'>".($month-3)."</td>"); 
    	print("<td width='10%' align='center'>".$ref."</td>");
    	print("<td width='10%' align='center'>".$sale_code1."</td>");
    	print("<td width='10%' align='center'>".$row["amount"]."</td>");
    	print("<td width='5%' align='center'>".($row["clearance_date"]!='0000-00-00' ? date('d-m-Y',strtotime($row["clearance_date"])) : '')."</td>");
    	print("<td width='5%' align='center'>".($row["clearance_date"]!='0000-00-00' ? date('d-m-Y',strtotime($row["clearance_date"])) : '')."</td>");
		print("<td width='10%' align='center'>".$row["customer_name"]."</td>");
		print("<td width='20%' align='center'>".$row["bill_no"]." ".$row["bank_name"]."  ".$row["cheque_no"]." ".$row["customer_name"]."</td>");
		print("<td width='5%' align='center'>".$row["tin"]."</td>");
    	print("<td width='5%' align='center'>".$bus_area."</td>");
    	print("<td width='8%' align='center'>".$profit_cen."</td>");
    	print("<td width='5%' align='center'>".$sec_code."</td>");
		print("</tr>");    	
		 }
print("</table>");  
 if(empty($data))
			{
			print("<div style='margin:150px 0px 0px 370px'>");	
			print("<font style='font-size:2em;color:#254117; font-family:'BebasNeueRegular', Arial, Helvetica, sans-serif; >Nothing to Display...!</font>");
			print("</div");	
			}
     }
}
 ?>
