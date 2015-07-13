<?php 

class Pet_reg_xl_rpt{

        public function Export($data,$filter){
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=".date('dmY')."_Petrol_Diesel_Bill_register.xls");
		 print("<tr>");
        print("<p align='center' style='margin-top:10px;color:#006666;font-size:15pt;font-weight:bold;'>Petrol Diesel Bill Register report</p>"); 
        print("</tr>");
        print("<table  border='1' align='left' cellpadding='1' cellspacing='1'  style='border-collapse:collapse;margin-bottom:20px;'>");
       print("<tr bgcolor='#559999'>");
       print("<td width='8%' align='center'>Bill No</td>");
       if($filter =='Indent_sales' || $filter =='all'){
       			print("<td width='10%' align='center'>Indent No</td>");
       }
       print("<td width='10%' align='center'>Acct Date</td>");
       print("<td width='15%' align='center'>Customer Name</td>");
       print("<td width='9%' align='center'>Vehicle No</td>");
       print("<td width='5%' align='center'>Counter</td>");
       print("<td width='5%' align='center'>Shift</td>");
       print("<td width='5%' align='center'>Pump</td>");
       print("<td width='15%' align='center'>Sale mode</td>");
       print("<td width='10%' align='center'>Product Type</td>");
       print("<td width='10%' align='center'>Litres</td>");
       print("<td width='10%' align='center'>Amount(Rs)</td>");
       print("</tr>");
        $total=0;
 		foreach($data as $openrow) {
 			$CI =& get_instance();
			$CI->load->model('Reports_model');
			
			$result = $CI->Reports_model->get_pet_bill_details($openrow["bill_number"]);
			$ctr=1;
			$tot_ltrs=0;
			foreach ($result as $val) {
				//echo $val["voucher_no"];
				
			if($ctr==1){
			 print("<tr class='small'>");
			 print("<td width='8%' align='center'>".$openrow["bill_number"]."</td>");
			if($filter =='Indent_sales' || $filter =='all'){
       			print("<td width='10%' align='center'>".$openrow["indent_no"]."</td>");
       		}
             print("<td width='10%' align='center'>".($openrow["acct_date"]!='0000-00-00' ? date('d-m-Y',strtotime($openrow["acct_date"])) : '')."</td>");
             print("<td width='15%' align='center'>".$openrow["customer_name"]."</td>");
             print("<td width='9%' align='center'>".$openrow["vehicle_number"]."</td>");
              print("<td width='5%' align='center'>".$openrow["counter"]."</td>");
      		 print("<td width='5%' align='center'>".$openrow["shift"]."</td>");
       		print("<td width='5%' align='center'>".$openrow["pump_number"]."</td>");
      		print("<td width='15%' align='center'>".$openrow["sale_mode"]."</td>");
             
             print("<td width='10%' align='center'>".$val["product"]."</td>");             
             print("<td width='10%' align='center'>".$val["quantity"]."</td>");             
             print("<td width='10%' align='center'>".$val["value"]."</td>");
             print("</tr>");
             $ctr++;
             $tot_ltrs+=$val["quantity"];
			}
			else{
			 print("<tr class='small'>");
			 print("<td width='8%' align='center'></td>");
			if($filter =='Indent_sales' || $filter =='all'){
       		print("<td width='10%' align='center'></td>");
       		}
             print("<td width='8%' align='center'></td>");
             print("<td width='15%' align='center'></td>");
             print("<td width='9%' align='center'></td>");
              print("<td width='5%' align='center'></td>");
              print("<td width='5%' align='center'></td>");
              print("<td width='5%' align='center'></td>");
              print("<td width='15%' align='center'></td>");
             
             print("<td width='10%' align='center'>".$val["product"]."</td>");             
             print("<td width='10%' align='center'>".$val["quantity"]."</td>");             
             print("<td width='10%' align='center'>".$val["value"]."</td>");
             print("</tr>");
             $tot_ltrs+=$val["quantity"];
			}
			}
			
            print("<tr class='small'>");
 			if($filter =='Indent_sales' || $filter =='all'){
       			print("<td width='10%' align='center'></td>");
       		}
            print("<td width='10%' align='right' colspan='9' >Total</td>");
            print("<td width='10%' align='center'>".$tot_ltrs."</td>");
            print("<td width='10%' align='center'>".$openrow["total_amount"]."</td>");
              $total+=$openrow["total_amount"];
            print("</tr>");
 		}
 		 print("<tr style='color:#9900CC;font-weight:bold;'>");
       print("<td width='30%' align='center'></td>");  
       if($filter =='Indent_sales' || $filter =='all'){
       		print("<td width='10%' align='center'></td>");
       }
       print("<td width='15%' align='center'></td>");
       print("<td width='15%' align='center'></td>");
       print("<td width='15%' align='center'></td>");
       print("<td width='15%' align='center'></td>");
	   print("<td width='10%' align='center'></td>");
       print("<td width='30%' align='center'></td>");  
       print("<td width='15%' align='center'></td>");
       print("<td width='15%' align='center'></td>");
        print("<td width='20%' align='center'>Grand Total</td>");
       print("<td width='10%' align='center'>".$total."</td>");
       print("</tr>");
          print("</table>");
        
        }
}

?>