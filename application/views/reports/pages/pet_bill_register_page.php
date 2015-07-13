	   <?php
 	   print("<table width='100%' border='1' align='left' cellpadding='1' class='alt_row' cellspacing='1' margin='10px' style='border-collapse:collapse;margin-bottom:20px;'>");
       print("<tr bgcolor='#559999' id='hdr_row' style='background-color:#559999;color:white;border-right:1px solid white;'>");
       print("<td width='8%' align='center'><span class='txt1_color'>Bill No</span></td>");
       if($filter =='Indent_sales' || $filter =='all'){
       		print("<td width='10%' align='center'><span class='txt1_color'>Indent No</span></td>");
       }
       print("<td width='10%' align='center'><span class='txt1_color'>Acct Date</span></td>");
       print("<td width='15%' align='center'><span class='txt1_color'>Customer Name</span></td>");
       print("<td width='9%' align='center'><span class='txt1_color'>Vehicle No</span></td>");
       print("<td width='5%' align='center'><span class='txt1_color'>Counter</span></td>");
       print("<td width='5%' align='center'><span class='txt1_color'>Shift</span></td>");
       print("<td width='5%' align='center'><span class='txt1_color'>Pump</span></td>");
       print("<td width='15%' align='center'><span class='txt1_color'>Sale mode</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Product Type</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Litres</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Amount(Rs)</span></td>");
       print("</tr>");
       
      	    $total=0;
            foreach($pet_bills as $openrow) {
        	 
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
              print("<td width='5%' align='center'>".ucfirst($openrow["counter"])."</td>");
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
             print("<td width='10%' align='center'></td>");
             print("<td width='15%' align='center'></td>");
             print("<td width='9%' align='center'></td>");
              print("<td width='5%' align='center'>");
              print("<td width='5%' align='center'>");
              print("<td width='5%' align='center'>");
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
  			if(empty($pet_bills))
			{
			print("<div style='margin:150px 0px 0px 370px'>");	
			print("<font style='font-size:2em;color:#254117; font-family:'BebasNeueRegular', Arial, Helvetica, sans-serif; >Nothing to Display...!</font>");
			print("</div");	
			}