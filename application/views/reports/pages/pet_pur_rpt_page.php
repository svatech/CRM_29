	   <?php
 	   print("<table width='100%' border='1' align='left' cellpadding='1' class='alt_row' cellspacing='1' margin='10px' style='border-collapse:collapse;margin-bottom:20px;'>");
       print("<tr bgcolor='#559999' id='hdr_row' style='background-color:#559999;color:white;border-right:1px solid white;'>");
       print("<td width='10%' align='center'><span class='txt1_color'>Voucher No<span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Delivery Date<span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Invoice No<span></td>");
       print("<td width='20%' align='center'><span class='txt1_color'>Invoice Date<span></td>");
       print("<td width='20%' align='center'><span class='txt1_color'>Party Name<span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Product Type<span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Litres<span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Amount(Rs)<span></td>");
       print("</tr>");
       
      	    $total=0;
      	    $t_ltrs=0;
      	    $tot_pet=0;
      	    $tot_pet_amt=0;
      	    $tot_die=0;
      	    $tot_die_amt=0;
            foreach($purchase_rpt as $openrow) {
        	 
			$CI =& get_instance();
			$CI->load->model('Reports_model');
			
			$result = $CI->Reports_model->get_pur_report_details($openrow["voucher_no"],$pdt_type);
			$ctr=1;
			$tot_ltrs=0;
			foreach ($result as $val) {
				//echo $val["voucher_no"];
				
			if($ctr==1){
			 print("<tr class='small'>");
			 print("<td width='10%' align='center'>".$openrow["voucher_no"]."</td>");
			 print("<td width='10%' align='center'>".($openrow["account_date"]!='0000-00-00' ? date('d-m-Y',strtotime($openrow["account_date"])) : '')."</td>");
             print("<td width='10%' align='center'>".$openrow["invoice_no"]."</td>");
             print("<td width='15%' align='center'>".($openrow["invoice_date"]!='0000-00-00' ? date('d-m-Y',strtotime($openrow["invoice_date"])) : '')."</td>");
             print("<td width='20%' align='center'>".$openrow["party_name"]."</td>");
             print("<td width='10%' align='center'>".$val["item_name"]."</td>");             
             print("<td width='10%' align='center'>".$val["quantity"]."</td>");             
             print("<td width='10%' align='center'>".$val["amount"]."</td>");
             $total+=$val["amount"];
             print("</tr>");
             $ctr++;
             $tot_ltrs+=$val["quantity"];
             $t_ltrs+=$val["quantity"];
             if($val['item_name']=='PETROL')
             {
             $tot_pet+=$val["quantity"];
             $tot_pet_amt+=$val["amount"];
             }
             else if($val['item_name']=='DIESEL'){
             	$tot_die+=$val["quantity"];
             	$tot_die_amt+=$val["amount"];
             }
             
			}
			else{
			 print("<tr class='small'>");
			 print("<td width='10%' align='center'></td>");
             print("<td width='10%' align='center'></td>");
             print("<td width='10%' align='center'></td>");
             print("<td width='20%' align='center'></td>");
             print("<td width='20%' align='center'></td>");
             print("<td width='10%' align='center'>".$val["item_name"]."</td>");             
             print("<td width='10%' align='center'>".$val["quantity"]."</td>");             
             print("<td width='10%' align='center'>".$val["amount"]."</td>");
             $total+=$val["amount"];
             print("</tr>");
             $tot_ltrs+=$val["quantity"];
             $t_ltrs+=$val["quantity"];
			if($val['item_name']=='PETROL')
             {
             $tot_pet+=$val["quantity"];
             $tot_pet_amt+=$val["amount"];
             }
             else if($val['item_name']=='DIESEL'){
             	$tot_die+=$val["quantity"];
             	$tot_die_amt+=$val["amount"];
             }
			}
			}
			if($pdt_type=='both'){
            print("<tr class='small'>");
            print("<td width='10%' align='right' colspan='6' >Total</td>");
            print("<td width='10%' align='center'>".$tot_ltrs."</td>");
            print("<td width='10%' align='center'>".$openrow["total"]."</td>");
            print("</tr>");
			}
                        }

      /* 	foreach($purchase_rpt as $openrow) {
       		print("<tr class='td_rows'>");
			 print("<td width='10%' align='center'><input type='text'  readonly='readonly' value='".$openrow["voucher_no"]."' size='10' class='plain_txt' /></td>");
             print("<td width='10%' align='center'><input type='text'  readonly='readonly' value='".$openrow["account_date"]."' size='10' class='plain_txt' /></td>");
             print("<td width='10%' align='center'><input type='text'  readonly='readonly' value='".$openrow["invoice_no"]."' size='8' class='plain_txt' /></td>");
             print("<td width='20%' align='center'><input type='text' readonly='True' value='".$openrow["invoice_date"]."' size='5' class='plain_txt'/></td>");
             print("<td width='20%' align='center'><input type='text' readonly='True' value='".$openrow["party_name"]."' size='20' class='plain_txt' /></td>");
             print("<td width='10%' align='center'><input type='text' readonly='True' value='' size='35' class='plain_txt' /></td>");             
             print("<td width='10%' align='center'><input type='text' readonly='True' value='' size='6' class='plain_txt' /></td>");             
             print("<td width='10%' align='center'><input type='text' readonly='readonly' value='' size='8' class='plain_txt' /></td>");
             print("</tr>");
       	}*/
       print("<tr style='color:#9900CC;font-weight:bold;'>");
	   print("<td width='10%' align='center'></td>");
	   print("<td width='30%' align='center'></td>");  
       print("<td width='15%' align='center'></td>");
       print("<td width='15%' align='center'></td>");
       print("<td width='15%' align='center'></td>");
       print("<td width='15%' align='center'>Total</td>");
	   print("<td width='20%' align='center'>".$t_ltrs."</td>");
       print("<td width='10%' align='center'>".$total."</td>");
     
       print("</tr>");
          print("</table>");
          if($pdt_type=='both'){
           print("<table  border='1' align='left' cellpadding='1' cellspacing='1' style='width:400px;overflow:scroll;margin-top:30px;border-collapse:collapse;'>");
       print("<tr bgcolor='#559999' id='hdr_row_5'  class='alt_row' style='color:Black;border-right:1px solid Black; '>");
       print("<td width='10%' align='center'><span class='txt1_color'>Product Type</span></td>");
        print("<td width='20%' align='center'><span class='txt1_color'>Total Quantity(Ltrs)</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Total Amount(Rs)</span></td>");
       print("</tr>");

	   print("<tr class='small' >");
	   print("<td width='10%' align='center'>PETROL</td>"); 
       print("<td width='10%' align='center'>".$tot_pet."</td>");
       print("<td width='15%' align='center'>".$tot_pet_amt."</td>");
       print("</tr>");
        print("<tr class='small' >");
       print("<td width='10%' align='center'>DIESEL</td>"); 
       print("<td width='10%' align='center'>".$tot_die."</td>");
       print("<td width='15%' align='center'>".$tot_die_amt."</td>");
       print("</tr>");
        print("<tr  style='color:#9900CC;font-weight:bold;' >");
       print("<td width='15%' align='center'>Total</td>");
	   print("<td width='20%' align='center'>".$t_ltrs."</td>");
       print("<td width='10%' align='center'>".$total."</td>");
       print("</tr>");
       print("</table>");
          }
          if(empty($purchase_rpt))
			{
			print("<div style='margin:150px 0px 0px 370px'>");	
			print("<font style='font-size:2em;color:#254117; font-family:'BebasNeueRegular', Arial, Helvetica, sans-serif; >Nothing to Display...!</font>");
			print("</div");	
			}
 