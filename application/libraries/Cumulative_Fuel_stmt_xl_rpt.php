<?php
class Cumulative_Fuel_stmt_xl_rpt{

        public function Export($start_date,$end_date){
        
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=Cumulative_Fuel_Statement_from_".date('d-m-Y', strtotime($start_date))."to".date('d-m-Y', strtotime($end_date)).".xls");
        print("<table  border='1' align='left' cellpadding='1' cellspacing='1'  style='border-collapse:collapse;margin-bottom:20px;'>");
        print("<tr  style='color:#006666'>");
        print("<td width='5%' align='center' colspan='13'>Cumulative Fuel Statement from ".date('d-m-Y', strtotime($start_date))." to ".date('d-m-Y', strtotime($end_date))."</td>");
        print("</tr>");
		print("<tr style='color:#4c0000;font-size:18px;font-weight:bold;margin:20px 0px 2px 20px;' align='center'><td colspan='17'>Pumpwise Petrol and Diesel Sales</td></tr>");
       print("<tr bgcolor='#559999' id='hdr_row_1' style='color:Black;border-right:1px solid Black; '>");
       print("<td width='5%' align='center'>Pump No</td>");
       print("<td width='7%' align='center'>Product Name</td>");
       print("<td width='7%' align='center'>Opening Reading</td>");
       print("<td width='7%' align='center'>Closing Reading</td>");
       print("<td width='7%' align='center'>Difference Qty</td>");
       print("<td width='5%' align='center'>Test Ltrs</td>");
       print("<td width='5%' align='center'>Saled Qty</td>");
       print("<td width='6%' align='center'>Total Sales (Rs)</td>");
       print("<td width='6%' align='center'>Indent Sales (Ltr)</td>");
       print("<td width='6%' align='center'>Credit Card Sales (Ltr)</td>");
       print("<td width='5%' align='center'>XP Sales (Ltr)</td>");
       print("<td width='5%' align='center'>XR Sales (Ltr)</td>");
       print("<td width='5%' align='center'>EF Sales (Ltr)</td>");
       print("<td width='5%' align='center'>Cheque Sales (Ltr)</td>");
       print("<td width='7%' align='center'>Billed Cash Sales (Ltr)</td>");
       print("<td width='7%' align='center'>Total Cash Sales (Ltr)</td>");
       print("<td width='7%' align='center'>Cash Sales (Rs)</td>");
       print("</tr>");
       $p_diff_qty=0;
       $p_test_ltrs=0;
       $p_saled_qty=0;
       $p_saled_rs=0;
       $p_is_qty=0;
       $p_is_rs=0;
       $p_cs_qty=0;
       $p_cs_rs=0;
       $p_fs_qty=0;
       $p_fs_rs=0;
       $p_xr_qty=0;
       $p_xr_rs=0;
       $p_ef_qty=0;
       $p_ef_rs=0;
       $p_ch_qty=0;
       $p_ch_rs=0;
       $p_bill_cash_qty=0;
       $p_bill_cash_rs=0;
       $p_tot_cash_qty=0;
       $p_tot_cash_rs=0;
       
       
       $d_diff_qty=0;
       $d_test_ltrs=0;
       $d_saled_qty=0;
       $d_saled_rs=0;
       $d_is_qty=0;
       $d_is_rs=0;
       $d_cs_qty=0;
       $d_cs_rs=0;
       $d_fs_qty=0;
       $d_fs_rs=0;
       $d_xr_qty=0;
       $d_xr_rs=0;
       $d_ef_qty=0;
       $d_ef_rs=0;
       $d_ch_qty=0;
       $d_ch_rs=0;
       $d_bill_cash_qty=0;
       $d_bill_cash_rs=0;
       $d_tot_cash_qty=0;
       $d_tot_cash_rs=0;
       
        print("<input type='hidden' name='start_date' id='start_date' value='$start_date' />");
        print("<input type='hidden' name='end_date' id='end_date' value='$end_date' />");
       $CI =& get_instance();
	   $CI->load->model('Statements_model');
	   $result = $CI->Statements_model->cumulative_pumpwise_total($start_date,$end_date);
       if(!empty($result)){
       foreach ($result as $openrow){
	   print("<tr class='small'>");
	   
       print("<td width='5%' align='center'>".$openrow["pump_no"]."</td>");
       
       $pdt=$openrow["product_name"];
       
       print("<td width='7%' align='center'>".$openrow["product_name"]."</td>");
       
       print("<td width='7%' align='center'>".$openrow["open_reading"]."</td>");
       
       print("<td width='7%' align='center'>".$openrow["close_reading"]."</td>");
       
       if($pdt=='PETROL'){
       	
       
      	$p_diff_qty+=round($openrow["sales_litres"],3);
      	print("<td width='7%' align='center'>".round($openrow["sales_litres"],3)."</td>");
       
	   $p_test_ltrs+=round($openrow["test_litres"],3);
       print("<td width='5%' align='center'>".round($openrow["test_litres"],3)."</td>");
       
       $p_saled_qty+=round($openrow["net_sales"],3);
       print("<td width='5%' align='center'>".round($openrow["net_sales"],3)."</td>");
       
       $p_saled_rs+=round($openrow["amount"],3);
       print("<td width='6%' align='center'>".round($openrow["amount"],3)."</td>");
       
       if($openrow["Indent_sales"]==''){
       		$indent_sales=0;
       }else{
       		$indent_sales=$openrow["Indent_sales"];
       } 
        $p_is_qty+=$indent_sales;
        $temp_is_rs=$openrow["Indent_sales_rs"];
        $p_is_rs+=$temp_is_rs;
       print("<td width='6%' align='center'>".round($indent_sales,3)."</td>");
       
       
		if($openrow["Credit_card_sales"]==''){
       $credit_sales=0;
       }else{
       	 $credit_sales=$openrow["Credit_card_sales"];
       }
       $p_cs_qty+=$credit_sales;
       $temp_cs_rs=$openrow["Credit_card_sales_rs"];
       $p_cs_rs+=$temp_cs_rs;
       print("<td width='6%' align='center'>".round($credit_sales,3)."</td>");
       
       
	   if($openrow["Fleet_sales"]==''){
       $fleet_sales=0;
       }else{
       	 $fleet_sales=$openrow["Fleet_sales"];
       }
       $p_fs_qty+=$fleet_sales;
       $temp_fs_rs=$openrow["Fleet_sales_rs"];
       $p_fs_rs+=$temp_fs_rs;
       print("<td width='5%' align='center'>".round($fleet_sales,3)."</td>");
       
       
		if($openrow["XR_sales"]==''){
       $xr_sales=0;
       }else{
       	 $xr_sales=$openrow["XR_sales"];
       }
       $p_xr_qty+=$xr_sales;
       $temp_xr_rs=$openrow["XR_sales_rs"];
       $p_xr_rs+=$temp_xr_rs;
       print("<td width='5%' align='center'>".round($xr_sales,3)."</td>");
       
       if($openrow["EF_sales"]==''){
       $ef_sales=0;
       }else{
       	 $ef_sales=$openrow["EF_sales"];
       }
       $p_ef_qty+=$ef_sales;
       $temp_ef_rs=$openrow["EF_sales_rs"];
       $p_ef_rs+=$temp_ef_rs;
       print("<td width='5%' align='center'>".round($ef_sales,3)."</td>");
       
       if($openrow["CH_sales"]==''){
       $ch_sales=0;
       }else{
       	 $ch_sales=$openrow["CH_sales"];
       }
       $p_ch_qty+=$ch_sales;
       $temp_ch_rs=$openrow["CH_sales_rs"];
       $p_ch_rs+=$temp_ch_rs;
       print("<td width='5%' align='center'>".round($ch_sales,3)."</td>");
       
       
		if($openrow["Cash_sales"]==''){
       $cash_sales=0;
       }else{
       	 $cash_sales=$openrow["Cash_sales"];
       }
       $p_bill_cash_qty+=$cash_sales;
       $temp_bill_cs_rs=$openrow["Cash_sales_rs"];
       $p_bill_cash_rs+=$temp_bill_cs_rs;
       print("<td width='7%' align='center'>".round($cash_sales,3)."</td>");
       
       $tot_cash_sales=$openrow["net_sales"]-$indent_sales-$credit_sales-$fleet_sales-$xr_sales-$ef_sales-$ch_sales;
       $p_tot_cash_qty+=$tot_cash_sales;
       $temp_tot_cash_rs=$openrow["amount"]-$openrow["Indent_sales_rs"]-$openrow["Credit_card_sales_rs"]-$openrow["Fleet_sales_rs"]-$openrow["XR_sales_rs"]-$openrow["EF_sales_rs"]-$openrow["CH_sales_rs"];
       $p_tot_cash_rs+=$temp_tot_cash_rs;
       print("<td width='7%' align='center'>".round($tot_cash_sales,3)."</td>");
       
       print("<td width='7%' align='center'>".round($temp_tot_cash_rs,3)."</td>");
       print("</tr>");
      
			}
	   if($pdt=='DIESEL'){
       	
       
      	$d_diff_qty+=round($openrow["sales_litres"],3);
      	print("<td width='7%' align='center'>".round($openrow["sales_litres"],3)."</td>");
       
	   $d_test_ltrs+=round($openrow["test_litres"],3);
       print("<td width='5%' align='center'>".round($openrow["test_litres"],3)."</td>");
       
       $d_saled_qty+=round($openrow["net_sales"],3);
       print("<td width='5%' align='center'>".round($openrow["net_sales"],3)."</td>");
       
       $d_saled_rs+=round($openrow["amount"],3);
       print("<td width='6%' align='center'>".round($openrow["amount"],3)."</td>");
       
       if($openrow["Indent_sales"]==''){
       		$indent_sales=0;
       }else{
       		$indent_sales=$openrow["Indent_sales"];
       } 
        $d_is_qty+=$indent_sales;
        $temp_is_rs=$openrow["Indent_sales_rs"];
        $d_is_rs+=$temp_is_rs;
       print("<td width='6%' align='center'>".round($indent_sales,3)."</td>");
       
       
		if($openrow["Credit_card_sales"]==''){
       $credit_sales=0;
       }else{
       	 $credit_sales=$openrow["Credit_card_sales"];
       }
       $d_cs_qty+=$credit_sales;
       $temp_cs_rs=$openrow["Credit_card_sales_rs"];
       $d_cs_rs+=$temp_cs_rs;
       print("<td width='6%' align='center'>".round($credit_sales,3)."</td>");
       
       
	   if($openrow["Fleet_sales"]==''){
       $fleet_sales=0;
       }else{
       	 $fleet_sales=$openrow["Fleet_sales"];
       }
       $d_fs_qty+=$fleet_sales;
       $temp_fs_rs=$openrow["Fleet_sales_rs"];
       $d_fs_rs+=$temp_fs_rs;
       print("<td width='5%' align='center'>".round($fleet_sales,3)."</td>");
       
       
		if($openrow["XR_sales"]==''){
       $xr_sales=0;
       }else{
       	 $xr_sales=$openrow["XR_sales"];
       }
       $d_xr_qty+=$xr_sales;
       $temp_xr_rs=$openrow["XR_sales_rs"];
       $d_xr_rs+=$temp_xr_rs;
       print("<td width='5%' align='center'>".round($xr_sales,3)."</td>");
       
       if($openrow["EF_sales"]==''){
       $ef_sales=0;
       }else{
       	 $ef_sales=$openrow["EF_sales"];
       }
       $d_ef_qty+=$ef_sales;
       $temp_ef_rs=$openrow["EF_sales_rs"];
       $d_ef_rs+=$temp_ef_rs;
       print("<td width='5%' align='center'>".round($ef_sales,3)."</td>");
       
       
       if($openrow["CH_sales"]==''){
       $ch_sales=0;
       }else{
       	 $ch_sales=$openrow["CH_sales"];
       }
       $d_ch_qty+=$ch_sales;
       $temp_ch_rs=$openrow["CH_sales_rs"];
       $d_ch_rs+=$temp_ch_rs;
       print("<td width='5%' align='center'>".round($ch_sales,3)."</td>");
       
		if($openrow["Cash_sales"]==''){
       $cash_sales=0;
       }else{
       	 $cash_sales=$openrow["Cash_sales"];
       }
       $d_bill_cash_qty+=$cash_sales;
       $temp_bill_cs_rs=$openrow["Cash_sales_rs"];
       $d_bill_cash_rs+=$temp_bill_cs_rs;
       print("<td width='7%' align='center'>".round($cash_sales,3)."</td>");
       
       $tot_cash_sales=$openrow["net_sales"]-$indent_sales-$credit_sales-$fleet_sales-$xr_sales-$ef_sales-$ch_sales;
       $d_tot_cash_qty+=$tot_cash_sales;
       $temp_tot_cash_rs=$openrow["amount"]-$openrow["Indent_sales_rs"]-$openrow["Credit_card_sales_rs"]-$openrow["Fleet_sales_rs"]-$openrow["XR_sales_rs"]-$openrow["EF_sales_rs"]-$openrow["CH_sales_rs"];
       $d_tot_cash_rs+=$temp_tot_cash_rs;
       print("<td width='7%' align='center'>".round($tot_cash_sales,3)."</td>");
       
       print("<td width='7%' align='center'>".round($temp_tot_cash_rs,3)."</td>");
       print("</tr>");
      
			}
			
			
       }
       }
      $pd_diff_qty=$p_diff_qty+$d_diff_qty;
       $pd_test_ltrs=$p_test_ltrs+$d_test_ltrs;
       $pd_saled_qty=$p_saled_qty+$d_saled_qty;
       $pd_saled_rs=$p_saled_rs+$d_saled_rs;
       $pd_is_qty=$p_is_qty+$d_is_qty;
       $pd_is_rs=$p_is_rs+$d_is_rs;
       $pd_cs_qty=$p_cs_qty+$d_cs_qty;
       $pd_cs_rs=$p_cs_rs+$d_cs_rs;
       $pd_fs_qty=$p_fs_qty+$d_fs_qty;
       $pd_fs_rs=$p_fs_rs+$d_fs_rs;
       $pd_xr_qty=$p_xr_qty+$d_xr_qty;
       $pd_xr_rs=$p_xr_rs+$d_xr_rs;
       $pd_ef_qty=$p_ef_qty+$d_ef_qty;
       $pd_ef_rs=$p_ef_rs+$d_ef_rs;
       $pd_ch_qty=$p_ch_qty+$d_ch_qty;
       $pd_ch_rs=$p_ch_rs+$d_ch_rs;
       $pd_bill_cash_qty=$p_bill_cash_qty+$d_bill_cash_qty;
       $pd_tot_cash_qty=$p_tot_cash_qty+$d_tot_cash_qty;
       $pd_tot_cash_rs=$p_tot_cash_rs+$d_tot_cash_rs;
       
	   print("<tr style='color:#4C0000;font-weight:bold;'>");
	   print("<td width='5%' align='center'></td>");
       print("<td width='7%' align='center'>Total</td>");
       print("<td width='7%' align='center'></td>");
       print("<td width='7%' align='center'></td>");
       print("<td width='7%' align='center'>".round($pd_diff_qty,3)."</td>");
       print("<td width='5%' align='center'>".round($pd_test_ltrs,3)."</td>");
       print("<td width='5%' align='center'>".round($pd_saled_qty,3)."</td>");
       print("<td width='6%' align='center'>".round($pd_saled_rs,3)."</td>");
       print("<td width='6%' align='center'>".round($pd_is_qty,3)."</td>");
       print("<td width='6%' align='center'>".round($pd_cs_qty,3)."</td>");
       print("<td width='5%' align='center'>".round($pd_fs_qty,3)."</td>");
       print("<td width='5%' align='center'>".round($pd_xr_qty,3)."</td>");
       print("<td width='5%' align='center'>".round($pd_ef_qty,3)."</td>");
       print("<td width='5%' align='center'>".round($pd_ch_qty,3)."</td>");
       print("<td width='7%' align='center'>".round($pd_bill_cash_qty,3)."</td>");
       print("<td width='7%' align='center'>".round($pd_tot_cash_qty,3)."</td>");
       print("<td width='7%' align='center'>".round($pd_tot_cash_rs,3)."</td>");
       print("</tr>");
       print("</table>");
       
       $lo_diff_qty=0;
       $lo_test_ltrs=0;
       $lo_saled_qty=0;
       $lo_saled_rs=0;
       $lo_is_qty=0;
       $lo_is_rs=0;
       $lo_cs_qty=0;
       $lo_cs_rs=0;
       $lo_fs_qty=0;
       $lo_fs_rs=0;
       $lo_xr_qty=0;
       $lo_xr_rs=0;
       $lo_ef_qty=0;
       $lo_ef_rs=0;
       $lo_ch_qty=0;
       $lo_ch_rs=0;
       $lo_bill_cash_qty=0;
       $lo_bill_cash_rs=0;
       $lo_tot_cash_qty=0;
       $lo_tot_cash_rs=0;
       $CI =& get_instance();
	   $CI->load->model('Statements_model');
	   $result = $CI->Statements_model->cumulative_loose_oil_total($start_date,$end_date);
	   
	   if(!empty($result)){
       print("<table width='1500px' border='1' align='left' cellpadding='1' cellspacing='1' style='width:1100px;overflow:scroll;margin-top:30px;border-collapse:collapse;'>");
       print("<tr style='color:#4c0000;font-size:18px;font-weight:bold;margin:20px 0px 2px 20px;' align='center'><td colspan='17'>2T Loose Oil Sales</td></tr>");
       print("<tr bgcolor='#559999' id='hdr_row_2' style='color:Black;border-right:1px solid Black; '>");
       print("<td width='5%' align='center'>Pump No</td>");
       print("<td width='7%' align='center'>Product Name</td>");
       print("<td width='7%' align='center'>Opening Reading</td>");
       print("<td width='7%' align='center'>Closing Reading</td>");
       print("<td width='7%' align='center'>Difference Qty</td>");
       print("<td width='5%' align='center'>Test Ltrs</td>");
       print("<td width='5%' align='center'>Saled Qty</td>");
       print("<td width='6%' align='center'>Total Sales (Rs)</td>");
       print("<td width='6%' align='center'>Indent Sales (Ltr)</td>");
       print("<td width='6%' align='center'>Credit Card Sales (Ltr)</td>");
       print("<td width='5%' align='center'>XP Sales (Ltr)</td>");
       print("<td width='5%' align='center'>XR Sales (Ltr)</td>");
       print("<td width='5%' align='center'>EF Sales (Ltr)</td>");
       print("<td width='5%' align='center'>Cheque Sales (Ltr)</td>");
       print("<td width='7%' align='center'>Billed Cash Sales (Ltr)</td>");
       print("<td width='7%' align='center'>Total Cash Sales (Ltr)</td>");
       print("<td width='7%' align='center'>Cash Sales (Rs)</td>");
       print("</tr>");
	   foreach ($result as $openrow){
	   print("<tr class='small'>");
	   
       print("<td width='5%' align='center'>".$openrow["pump_no"]."</td>");
       
       $pdt=$openrow["product_name"];
       
       print("<td width='7%' align='center'>".$openrow["product_name"]."</td>");
       
       print("<td width='7%' align='center'>".$openrow["open_reading"]."</td>");
       
       print("<td width='7%' align='center'>".$openrow["close_reading"]."</td>");
       
           
      	$lo_diff_qty+=round($openrow["sales_litres"],3);
      	print("<td width='7%' align='center'>".round($openrow["sales_litres"],3)."</td>");
       
	   $lo_test_ltrs+=round($openrow["test_litres"],3);
       print("<td width='5%' align='center'>".round($openrow["test_litres"],3)."</td>");
       
       $lo_saled_qty+=round($openrow["net_sales"],3);
       print("<td width='5%' align='center'>".round($openrow["net_sales"],3)."</td>");
       
       $lo_saled_rs+=round($openrow["amount"],3);
       print("<td width='6%' align='center'>".round($openrow["amount"],3)."</td>");
       
       if($openrow["Indent_sales"]==''){
       		$indent_sales=0;
       }else{
       		$indent_sales=$openrow["Indent_sales"];
       } 
        $lo_is_qty+=$indent_sales;
        $temp_is_rs=$openrow["Indent_sales_rs"];
        $lo_is_rs+=$temp_is_rs;
       print("<td width='6%' align='center'>".round($indent_sales,3)."</td>");
       
       
		if($openrow["Credit_card_sales"]==''){
       $credit_sales=0;
       }else{
       	 $credit_sales=$openrow["Credit_card_sales"];
       }
       $lo_cs_qty+=$credit_sales;
       $temp_cs_rs=$openrow["Credit_card_sales_rs"];
       $lo_cs_rs+=$temp_cs_rs;
       print("<td width='6%' align='center'>".round($credit_sales,3)."</td>");
       
       
	   if($openrow["Fleet_sales"]==''){
       $fleet_sales=0;
       }else{
       	 $fleet_sales=$openrow["Fleet_sales"];
       }
       $lo_fs_qty+=$fleet_sales;
       $temp_fs_rs=$openrow["Fleet_sales_rs"];
       $lo_fs_rs+=$temp_fs_rs;
       print("<td width='5%' align='center'>".round($fleet_sales,3)."</td>");
       
       
		if($openrow["XR_sales"]==''){
       $xr_sales=0;
       }else{
       	 $xr_sales=$openrow["XR_sales"];
       }
       $lo_xr_qty+=$xr_sales;
       $temp_xr_rs=$openrow["XR_sales_rs"];
       $lo_xr_rs+=$temp_xr_rs;
       print("<td width='5%' align='center'>".round($xr_sales,3)."</td>");
       
       if($openrow["EF_sales"]==''){
       $ef_sales=0;
       }else{
       	 $ef_sales=$openrow["EF_sales"];
       }
       $lo_ef_qty+=$ef_sales;
       $temp_ef_rs=$openrow["EF_sales_rs"];
       $lo_ef_rs+=$temp_ef_rs;
       print("<td width='5%' align='center'>".round($ef_sales,3)."</td>");
       
       if($openrow["CH_sales"]==''){
       $ch_sales=0;
       }else{
       	 $ch_sales=$openrow["CH_sales"];
       }
       $lo_ch_qty+=$ch_sales;
       $temp_ch_rs=$openrow["CH_sales_rs"];
       $lo_ch_rs+=$temp_ch_rs;
       print("<td width='5%' align='center'>".round($ch_sales,3)."</td>");
       
		if($openrow["Cash_sales"]==''){
       $cash_sales=0;
       }else{
       	 $cash_sales=$openrow["Cash_sales"];
       }
       $lo_bill_cash_qty+=$cash_sales;
       $temp_bill_cs_rs=$openrow["Cash_sales_rs"];
       $lo_bill_cash_rs+=$temp_bill_cs_rs;
       print("<td width='7%' align='center'>".round($cash_sales,3)."</td>");
       
       $tot_cash_sales=$openrow["net_sales"]-$indent_sales-$credit_sales-$fleet_sales-$xr_sales-$ef_sales-$ch_sales;
       $lo_tot_cash_qty+=$tot_cash_sales;
       $temp_tot_cash_rs=$openrow["amount"]-$openrow["Indent_sales_rs"]-$openrow["Credit_card_sales_rs"]-$openrow["Fleet_sales_rs"]-$openrow["XR_sales_rs"]-$openrow["EF_sales_rs"]-$openrow["CH_sales_rs"];
       $lo_tot_cash_rs+=$temp_tot_cash_rs;
       print("<td width='7%' align='center'>".round($tot_cash_sales,3)."</td>");
       
       print("<td width='7%' align='center'>".round($temp_tot_cash_rs,3)."</td>");
       print("</tr>");
         }
       
	   print("<tr style='color:#4C0000;font-weight:bold;'>");
	   print("<td width='5%' align='center'></td>");
       print("<td width='7%' align='center'>Total</td>");
       print("<td width='7%' align='center'></td>");
       print("<td width='7%' align='center'></td>");
       print("<td width='7%' align='center'>".round($lo_diff_qty,3)."</td>");
       print("<td width='5%' align='center'>".round($lo_test_ltrs,3)."</td>");
       print("<td width='5%' align='center'>".round($lo_saled_qty,3)."</td>");
       print("<td width='6%' align='center'>".round($lo_saled_rs,3)."</td>");
       print("<td width='6%' align='center'>".round($lo_is_qty,3)."</td>");
       print("<td width='6%' align='center'>".round($lo_cs_qty,3)."</td>");
       print("<td width='5%' align='center'>".round($lo_fs_qty,3)."</td>");
       print("<td width='5%' align='center'>".round($lo_xr_qty,3)."</td>");
       print("<td width='5%' align='center'>".round($lo_ef_qty,3)."</td>");
       print("<td width='5%' align='center'>".round($lo_ch_qty,3)."</td>");
       print("<td width='7%' align='center'>".round($lo_bill_cash_qty,3)."</td>");
       print("<td width='7%' align='center'>".round($lo_tot_cash_qty,3)."</td>");
       print("<td width='7%' align='center'>".round($lo_tot_cash_rs,3)."</td>");
       print("</tr>");
       print("</table>");
	   }
	   
	   $o_bill_cash_qty=0;
       $o_bill_cash_rs=0;
       $o_tot_sal_qty=0;
       $o_tot_sal_rs=0;
       $o_is_qty=0;
       $o_is_rs=0;
       $o_cs_qty=0;
       $o_cs_rs=0;
       $o_fs_qty=0;
       $o_fs_rs=0;
       $o_xr_qty=0;
       $o_xr_rs=0;
       $o_ef_qty=0;
       $o_ef_rs=0;
       $o_ch_qty=0;
       $o_ch_rs=0;
       
       
        $CI =& get_instance();
	   $CI->load->model('Statements_model');
	   $result = $CI->Statements_model->cumulative_other_pdt_tot($start_date,$end_date);
       if(!empty($result)){
       	
       
       print("<table width='1500px' border='1' align='left' cellpadding='1' cellspacing='1' style='width:1100px;overflow:scroll;margin-top:30px;border-collapse:collapse;'>");
       print("<tr style='color:#4c0000;font-size:18px;font-weight:bold;margin:20px 0px 2px 20px;' align='center'><td colspan='17'>Other Products Sales</td></tr>");
       print("<tr bgcolor='#559999' id='hdr_row_3' style='color:Black;border-right:1px solid Black; '>");
       print("<td width='10%' align='center' rowspan='2' valign='center'>Product Name</td>");
       print("<td width='10%' align='center' rowspan='1' colspan='2' valign='center'>Total Sales</td>");
       print("<td width='10%' align='center' rowspan='1' colspan='2' valign='center'>Cash Sales</td>");
       print("<td width='10%' align='center' rowspan='1' colspan='2' valign='center'>Indent Sales</td>");
       print("<td width='10%' align='center' rowspan='1' colspan='2' valign='center'>Credit Card Sales</td>");
       print("<td width='10%' align='center' rowspan='1' colspan='2' valign='center'>XtraPower Card Sales</td>");
       print("<td width='10%' align='center' rowspan='1' colspan='2' valign='center'>XtraReward Card Sales</td>");
       print("<td width='10%' align='center' rowspan='1' colspan='2' valign='center'>Easy Fuel Sales</td>");
       print("<td width='10%' align='center' rowspan='1' colspan='2' valign='center'>Cheque Sales</td>");
       print("</tr>");
       print("<tr bgcolor='#559999' id='hdr_row_4' style='color:Black;border-right:1px solid Black;border-top:1px solid Black; '>");
       print("<td width='5%' align='center' rowspan='1' colspan='1' valign='center'>Ltr</td>");
       print("<td width='5%' align='center' rowspan='1' colspan='1' valign='center'>Value (Rs)</td>");
	   print("<td width='5%' align='center' rowspan='1' colspan='1' valign='center'>Ltr</td>");
       print("<td width='5%' align='center' rowspan='1' colspan='1' valign='center'>Value (Rs)</td>"); 
       print("<td width='5%' align='center' rowspan='1' colspan='1' valign='center'>Ltr</td>");
       print("<td width='5%' align='center' rowspan='1' colspan='1' valign='center'>Value (Rs)</td>"); 
       print("<td width='5%' align='center' rowspan='1' colspan='1' valign='center'>Ltr</td>");
       print("<td width='5%' align='center' rowspan='1' colspan='1' valign='center'>Value (Rs)</td>"); 
       print("<td width='5%' align='center' rowspan='1' colspan='1' valign='center'>Ltr</td>");
       print("<td width='5%' align='center' rowspan='1' colspan='1' valign='center'>Value (Rs)</td>");
       print("<td width='5%' align='center' rowspan='1' colspan='1' valign='center'>Ltr</td>");
       print("<td width='5%' align='center' rowspan='1' colspan='1' valign='center'>Value (Rs)</td>");
       print("<td width='5%' align='center' rowspan='1' colspan='1' valign='center'>Ltr</td>");
       print("<td width='5%' align='center' rowspan='1' colspan='1' valign='center'>Value (Rs)</td>");
       print("<td width='5%' align='center' rowspan='1' colspan='1' valign='center'>Ltr</td>");
       print("<td width='5%' align='center' rowspan='1' colspan='1' valign='center'>Value (Rs)</td>");
       print("</tr>");
       foreach ($result as $openrow){
       print("<tr class='small'>");
       print("<td width='10%' align='center'>".$openrow["product"]."</td>");
       $o_tot_sal_qty+=round($openrow["qty"],3);
       print("<td width='5%' align='center'>".round($openrow["qty"],3)."</td>");
       $o_tot_sal_rs+=round($openrow["amt"],3);
       print("<td width='5%' align='center'>".round($openrow["amt"],3)."</td>");
       $o_bill_cash_qty+=round($openrow["bcs_qty"],3);
       print("<td width='5%' align='center'>".round($openrow["bcs_qty"],3)."</td>");
       $o_bill_cash_rs+=round($openrow["bcs_rs"],3);
       print("<td width='5%' align='center'>".round($openrow["bcs_rs"],3)."</td>");
       $o_is_qty+=round($openrow["is_qty"],3);
       print("<td width='5%' align='center'>".round($openrow["is_qty"],3)."</td>");
       $o_is_rs+=round($openrow["is_rs"],3);
       print("<td width='5%' align='center'>".round($openrow["is_rs"],3)."</td>");
       
       $o_cs_qty+=round($openrow["cs_qty"],3);
       print("<td width='5%' align='center'>".round($openrow["cs_qty"],3)."</td>");
       $o_cs_rs+=round($openrow["cs_rs"],3);
       print("<td width='5%' align='center'>".round($openrow["cs_rs"],3)."</td>");
       $o_fs_qty+=round($openrow["fs_qty"],3);
       print("<td width='5%' align='center'>".round($openrow["fs_qty"],3)."</td>");
       $o_fs_rs+=round($openrow["fs_rs"],3);
       print("<td width='5%' align='center'>".round($openrow["fs_rs"],3)."</td>");
       $o_xr_qty+=round($openrow["xr_qty"],3);
       print("<td width='5%' align='center'>".round($openrow["xr_qty"],3)."</td>");
       $o_xr_rs+=round($openrow["xr_rs"],3);
       print("<td width='5%' align='center'>".round($openrow["xr_rs"],3)."</td>");
       $o_ef_qty+=round($openrow["ef_qty"],3);
       print("<td width='5%' align='center'>".round($openrow["ef_qty"],3)."</td>");
       $o_ef_rs+=round($openrow["ef_rs"],3);
       print("<td width='5%' align='center'>".round($openrow["ef_rs"],3)."</td>");
       $o_ch_qty+=round($openrow["ch_qty"],3);
       print("<td width='5%' align='center'>".round($openrow["ch_qty"],3)."</td>");
       $o_ch_rs+=round($openrow["ch_rs"],3);
       print("<td width='5%' align='center'>".round($openrow["ch_rs"],3)."</td>");
       
       }
       print("<tr style='color:#4C0000;font-weight:bold;'>");
       print("<td width='10%' align='center'>Total</td>");
       
       print("<td width='5%' align='center'>".round($o_tot_sal_qty,3)."</td>");
       
       print("<td width='5%' align='center'>".round($o_tot_sal_rs,3)."</td>");
       
       print("<td width='5%' align='center'>".round($o_bill_cash_qty,3)."</td>");
       
       print("<td width='5%' align='center'>".round($o_bill_cash_rs,3)."</td>");
       
       print("<td width='5%' align='center'>".round($o_is_qty,3)."</td>");
       
       print("<td width='5%' align='center'>".round($o_is_rs,3)."</td>");
       
       
       print("<td width='5%' align='center'>".round($o_cs_qty,3)."</td>");
       
       print("<td width='5%' align='center'>".round($o_cs_rs,3)."</td>");
       
       print("<td width='5%' align='center'>".round($o_fs_qty,3)."</td>");
       
       print("<td width='5%' align='center'>".round($o_fs_rs,3)."</td>");
       
       print("<td width='5%' align='center'>".round($o_xr_qty,3)."</td>");
       
       print("<td width='5%' align='center'>".round($o_xr_rs,3)."</td>");
       
       print("<td width='5%' align='center'>".round($o_ef_qty,3)."</td>");
       
       print("<td width='5%' align='center'>".round($o_ef_rs,3)."</td>");
       
       print("<td width='5%' align='center'>".round($o_ch_qty,3)."</td>");
       
       print("<td width='5%' align='center'>".round($o_ch_rs,3)."</td>");
       
       print("</table>");
       }
       
       print("<table width='1500px' border='1' align='left' cellpadding='1' cellspacing='1' style='width:1100px;overflow:scroll;margin-top:30px;border-collapse:collapse;'>");
       print("<tr style='color:#4c0000;font-size:18px;font-weight:bold;margin:20px 0px 2px 20px;' align='center'><td colspan='18'>Cumulative Petrol and Diesel Sales</td></tr>");
       print("<tr bgcolor='#559999' id='hdr_row_5' style='color:Black;border-right:1px solid Black; '>");
       print("<td width='10%' align='center' rowspan='2' valign='center'>Product Name</td>");
       print("<td width='10%' align='center' rowspan='1' colspan='2' valign='center'>Total Sales</td>");
       print("<td width='10%' align='center' rowspan='1' colspan='1' valign='center'>Test Litres</td>");
       print("<td width='10%' align='center' rowspan='1' colspan='2' valign='center'>Indent Sales</td>");
       print("<td width='10%' align='center' rowspan='1' colspan='2' valign='center'>Credit Card Sales</td>");
       print("<td width='10%' align='center' rowspan='1' colspan='2' valign='center'>XtraPower Card Sales</td>");
       print("<td width='10%' align='center' rowspan='1' colspan='2' valign='center'>XtraReward Card Sales</td>");
       print("<td width='10%' align='center' rowspan='1' colspan='2' valign='center'>Easy Fuel Sales</td>");
       print("<td width='10%' align='center' rowspan='1' colspan='2' valign='center'>Cheque Sales</td>");
       print("<td width='10%' align='center' rowspan='1' colspan='2' valign='center'>Cash Sales</td>");
       print("</tr>");
       print("<tr bgcolor='#559999' id='hdr_row_6' style='color:Black;border-right:1px solid Black;border-top:1px solid Black; '>");
       print("<td width='5%' align='center' rowspan='1' colspan='1' valign='center'>Ltr</td>");
       print("<td width='5%' align='center' rowspan='1' colspan='1' valign='center'>Value (Rs)</td>");
       print("<td width='10%' align='center' rowspan='1' colspan='1' valign='center'>Ltr</td>");
	   print("<td width='5%' align='center' rowspan='1' colspan='1' valign='center'>Ltr</td>");
       print("<td width='5%' align='center' rowspan='1' colspan='1' valign='center'>Value (Rs)</td>"); 
       print("<td width='5%' align='center' rowspan='1' colspan='1' valign='center'>Ltr</td>");
       print("<td width='5%' align='center' rowspan='1' colspan='1' valign='center'>Value (Rs)</td>"); 
       print("<td width='5%' align='center' rowspan='1' colspan='1' valign='center'>Ltr</td>");
       print("<td width='5%' align='center' rowspan='1' colspan='1' valign='center'>Value (Rs)</td>"); 
       print("<td width='5%' align='center' rowspan='1' colspan='1' valign='center'>Ltr</td>");
       print("<td width='5%' align='center' rowspan='1' colspan='1' valign='center'>Value (Rs)</td>");
       print("<td width='5%' align='center' rowspan='1' colspan='1' valign='center'>Ltr</td>");
       print("<td width='5%' align='center' rowspan='1' colspan='1' valign='center'>Value (Rs)</td>");
       print("<td width='5%' align='center' rowspan='1' colspan='1' valign='center'>Ltr</td>");
       print("<td width='5%' align='center' rowspan='1' colspan='1' valign='center'>Value (Rs)</td>");
       print("<td width='5%' align='center' rowspan='1' colspan='1' valign='center'>Ltr</td>");
       print("<td width='5%' align='center' rowspan='1' colspan='1' valign='center'>Value (Rs)</td>");
       print("</tr>");
       print("<tr class='small'>");
       print("<td width='10%' align='center'>Petrol</td>");
       
       print("<td width='5%' align='center'>".round($p_saled_qty,3)."</td>");
       
       print("<td width='5%' align='center'>".round($p_saled_rs,3)."</td>");
       
       print("<td width='10%' align='center'>".round($p_test_ltrs,3)."</td>");
       
       print("<td width='5%' align='center'>".round($p_is_qty,3)."</td>");
       
       print("<td width='5%' align='center'>".round($p_is_rs,3)."</td>");
              
       print("<td width='5%' align='center'>".round($p_cs_qty,3)."</td>");
       
       print("<td width='5%' align='center'>".round($p_cs_rs,3)."</td>");
       
       print("<td width='5%' align='center'>".round($p_fs_qty,3)."</td>");
       
       print("<td width='5%' align='center'>".round($p_fs_rs,3)."</td>");
       
       print("<td width='5%' align='center'>".round($p_xr_qty,3)."</td>");
       
       print("<td width='5%' align='center'>".round($p_xr_rs,3)."</td>");
       
       print("<td width='5%' align='center'>".round($p_ef_qty,3)."</td>");
       
       print("<td width='5%' align='center'>".round($p_ef_rs,3)."</td>");
       
       print("<td width='5%' align='center'>".round($p_ch_qty,3)."</td>");
       
       print("<td width='5%' align='center'>".round($p_ch_rs,3)."</td>");
       
       print("<td width='5%' align='center'>".round($p_tot_cash_qty,3)."</td>");
       
       print("<td width='5%' align='center'>".round($p_tot_cash_rs,3)."</td>");
       print("</tr>");
       print("<tr class='small'>");
       print("<td width='10%' align='center'>Diesel</td>");
       
       print("<td width='5%' align='center'>".round($d_saled_qty,3)."</td>");
       
       print("<td width='5%' align='center'>".round($d_saled_rs,3)."</td>");
       
       print("<td width='10%' align='center' >".round($d_test_ltrs,3)."</td>");
       
       print("<td width='5%' align='center'>".round($d_is_qty,3)."</td>");
       
       print("<td width='5%' align='center'>".round($d_is_rs,3)."</td>");
       
       
       print("<td width='5%' align='center'>".round($d_cs_qty,3)."</td>");
       
       print("<td width='5%' align='center'>".round($d_cs_rs,3)."</td>");
       
       print("<td width='5%' align='center'>".round($d_fs_qty,3)."</td>");
       
       print("<td width='5%' align='center'>".round($d_fs_rs,3)."</td>");
       
       print("<td width='5%' align='center'>".round($d_xr_qty,3)."</td>");
       
       print("<td width='5%' align='center'>".round($d_xr_rs,3)."</td>");
       
       print("<td width='5%' align='center'>".round($d_ef_qty,3)."</td>");
       
       print("<td width='5%' align='center'>".round($d_ef_rs,3)."</td>");
       
       print("<td width='5%' align='center'>".round($d_ch_qty,3)."</td>");
       
       print("<td width='5%' align='center'>".round($d_ch_rs,3)."</td>");
       
       print("<td width='5%' align='center'>".round($d_tot_cash_qty,3)."</td>");
       
       print("<td width='5%' align='center'>".round($d_tot_cash_rs,3)."</td>");
       
       print("</tr>");
       print("<tr style='color:#4C0000;font-weight:bold;'>");
       print("<td width='10%' align='center'>Total</td>");
       
       print("<td width='5%' align='center'>".round($pd_saled_qty,3)."</td>");
       
       print("<td width='5%' align='center'>".round($pd_saled_rs,3)."</td>");
       
       print("<td width='10%' align='center' >".round($pd_test_ltrs,3)."</td>");
       
       print("<td width='5%' align='center'>".round($pd_is_qty,3)."</td>");
       
       print("<td width='5%' align='center'>".round($pd_is_rs,3)."</td>");
       
       
       print("<td width='5%' align='center'>".round($pd_cs_qty,3)."</td>");
       
       print("<td width='5%' align='center'>".round($pd_cs_rs,3)."</td>");
       
       print("<td width='5%' align='center'>".round($pd_fs_qty,3)."</td>");
       
       print("<td width='5%' align='center'>".round($pd_fs_rs,3)."</td>");
       
       print("<td width='5%' align='center'>".round($pd_xr_qty,3)."</td>");
       
       print("<td width='5%' align='center'>".round($pd_xr_rs,3)."</td>");
       
       print("<td width='5%' align='center'>".round($pd_ef_qty,3)."</td>");
       
       print("<td width='5%' align='center'>".round($pd_ef_rs,3)."</td>");
       
       print("<td width='5%' align='center'>".round($pd_ch_qty,3)."</td>");
       
       print("<td width='5%' align='center'>".round($pd_ch_rs,3)."</td>");
       
       print("<td width='5%' align='center'>".round($pd_tot_cash_qty,3)."</td>");
       
       print("<td width='5%' align='center'>".round($pd_tot_cash_rs,3)."</td>");
       
       print("</tr>");
       print("</table>");
       print("<table  border='1' align='left' cellpadding='1' cellspacing='1' style='width:400px;overflow:scroll;margin-top:30px;border-collapse:collapse;'>");
       print("<tr bgcolor='#559999' id='hdr_row_7' style='color:Black;border-right:1px solid Black; '>");
       print("<td width='50%' align='center'>Sales Type</td>");
       print("<td width='50%' align='center'>Total Amount</td>");
       print("</tr>");
       $t_tot_cash_rs=$pd_tot_cash_rs+$lo_tot_cash_rs+$o_bill_cash_rs;
       print("<tr class='small'>");
       print("<td width='50%' align='center'>Cash Sales</td>");
       print("<td width='50%' align='center'>".round($t_tot_cash_rs,3)."</td>");
       print("</tr>");
       $t_is_rs=$pd_is_rs+$lo_is_rs+$o_is_rs;
       print("<tr class='small'>");
       print("<td width='50%' align='center'>Indent Sales</td>");
       print("<td width='50%' align='center'>".round($t_is_rs,3)."</td>");
       print("</tr>");
       $t_cs_rs=$pd_cs_rs+$lo_cs_rs+$o_cs_rs;
       print("<tr class='small'>");
       print("<td width='50%' align='center'>Credit Card Sales</td>");
       print("<td width='50%' align='center'>".round($t_cs_rs,3)."</td>");
       print("</tr>");
       $t_fs_rs=$pd_fs_rs+$lo_fs_rs+$o_fs_rs;
       print("<tr class='small'>");
       print("<td width='50%' align='center'>XtraPower Card Sales</td>");
       print("<td width='50%' align='center'>".round($t_fs_rs,3)."</td>");
       print("</tr>");
       $t_xr_rs=$pd_xr_rs+$lo_xr_rs+$o_xr_rs;
       print("<tr class='small'>");
       print("<td width='50%' align='center'>XtraReward Card Sales</td>");
       print("<td width='50%' align='center'>".round($t_xr_rs,3)."</td>");
       print("</tr>");
       $t_ef_rs=$pd_ef_rs+$lo_ef_rs+$o_ef_rs;
       print("<tr class='small'>");
       print("<td width='50%' align='center'>Easy Fuel Sales</td>");
       print("<td width='50%' align='center'>".round($t_ef_rs,3)."</td>");
       print("</tr>");
       $t_ch_rs=$pd_ch_rs+$lo_ch_rs+$o_ch_rs;
       print("<tr class='small'>");
       print("<td width='50%' align='center'>Cheque Sales</td>");
       print("<td width='50%' align='center'>".round($t_ch_rs,3)."</td>");
       print("</tr>");
       $total_sales=$t_tot_cash_rs+$t_is_rs+$t_cs_rs+$t_fs_rs+$t_xr_rs+$t_ef_rs+$t_ch_rs;
       print("<tr style='color:#4C0000;font-weight:bold;'>");
       print("<td width='50%' align='center'>Total Sales</td>");
       print("<td width='50%' align='center'>".round($total_sales,3)."</td>");
       print("</tr>");
       print("</table>");
        }
}