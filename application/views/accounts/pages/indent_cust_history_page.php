<?php print("<p align='center' style='font-size:15pt;font-weight:bold;color:#4c0000'>Indent Customers Account History </p>"); ?>
<?php
		$count=0;
			foreach($adv_paymts as $row){
				$count++;
				$adv_paymt=$row["ADVANCE_PAYMENTS"];
			}
		foreach($bal_amt as $row){
				$count++;
				$bal_amt=round($row["bal_paymt"],2);
			}
			
 	   foreach($cust_info as $row){
 	   	print("<div style='width=100%;'>");
 	   	print("<div style='float:left;margin-top:20px;margin-left:10px;width:40%;'  >");
		print("<table  border='0' align='left'  style='border-collapse:collapse;margin-bottom:20px;margin-left:10px;float: left;font-size:10pt;' > ");
		print("<tr style='font-weight:bold;'><td>Customer Name :</td><td>".$row["customer_name"]."</td></tr>");
		print("<tr style='font-weight:bold;'><td>Address:</td><td>".$row["address"]."</td></tr>");
		print("</table>");
		print("</div>");
		print("<div style='float:right;margin-top:20px;width:40%;'>");
		print("<table  border='0'    style='border-collapse:collapse;float: left;' > ");
		print("<tr style='font-weight:bold;'><td>Initial Deposit: ".$row["initial_deposit"]."</td></tr>");
		print("<tr style='font-weight:bold;'><td>Advance Payments Amount: ".$adv_paymt."</td></tr>");
		print("<tr style='font-weight:bold;'><td>Amount To be Paid(Excluding Advance Payments): ".$bal_amt."</td></tr>");
		print("</table>");
		print("</div>");
		
		print("<input type='button' id='make_payment' value='Make Payment' style='float:right;margin-right:50px;padding:5px;margin-bottom:10px;' onclick='make_cust_payment(\"".$row["customer_id"]."\")' />");
		print("</div>");
 	   }
	   print("<table width='100%' border='1' align='left' cellpadding='1' class='alt_row' cellspacing='1' margin='10px' style='border-collapse:collapse;margin-bottom:20px;'>");
       print("<tr bgcolor='#559999' id='hdr_row' style='background-color:#559999;color:white;border-right:1px solid white;'>");
       print("<td width='' align='center'><span class='txt1_color'>Date</span></td>");
       print("<td width='' align='center'><span class='txt1_color'>Stmt No</span></td>");
       print("<td width='' align='center'><span class='txt1_color'>Period</span></td>");
       print("<td width='' align='center'><span class='txt1_color'>Total Amount</span></td>");
       print("<td width='' align='center'><span class='txt1_color'>Payment Mode</span></td>");
       print("<td width='' align='center'><span class='txt1_color'>Paid Amount</span></td>");
       print("<td width='' align='center'><span class='txt1_color'>Cheque No</span></td>");
       print("<td width='' align='center'><span class='txt1_color'>Cheque Date</span></td>");
       print("<td width='' align='center'><span class='txt1_color'>Bank Name</span></td>");
       print("<td width='' align='center'><span class='txt1_color'>Status</span></td>");
       print("</tr>");
	   $temp_ind_stmt_no='';
       foreach($pay_list as $openrow) {
       	if($openrow["bill_no"]!=$temp_ind_stmt_no){
       		$temp_ind_stmt_no=$openrow["bill_no"];
       		 print("<tr class='small'>");
			 print("<td width='' align='center'>".$openrow["payment_date"]."</td>");
             print("<td width='' align='center'>".$openrow["bill_no"]."</td>");
             print("<td width='' align='center'>".$openrow["from_date"]." to ".$openrow["to_date"]."</td>");
             print("<td width='' align='center'>".$openrow["bill_amount"]."</td>");
             print("<td width='' align='center'>".$openrow["payment_mode"]."</td>");
             print("<td width='' align='center'>".$openrow["amount"]."</td>");
             print("<td width='' align='center'>".$openrow["cheque_no"]."</td>");
             print("<td width='' align='center'>".$openrow["cheque_date"]."</td>");             
             print("<td width='' align='center'>".$openrow["bank_name"]."</td>");
             print("<td width='' align='center'>".$openrow["cheque_status"]."</td>");
             print("</tr>");
       	}
       	else{
       		 print("<tr class='small'>");
			 print("<td width='' align='center'></td>");
             print("<td width='' align='center'></td>");
             print("<td width='' align='center'></td>");
             print("<td width='' align='center'></td>");
             print("<td width='' align='center'>".$openrow["payment_mode"]."</td>");
             print("<td width='' align='center'>".$openrow["amount"]."</td>");
			 if($openrow["payment_mode"]=='CHEQUE' || $openrow["payment_mode"]=='DEMAND_DRAFT'){
             print("<td width='' align='center'>".$openrow["cheque_no"]."</td>");
			 }
			 else{
			 	print("<td width='' align='center'>".$openrow["reference_no"]."</td>");
			 }
             print("<td width='' align='center'>".$openrow["cheque_date"]."</td>");             
             print("<td width='' align='center'>".$openrow["bank_name"]."</td>");
             print("<td width='' align='center'>".$openrow["cheque_status"]."</td>");
             print("</tr>");
       	}
           }
			
          
     		
          print("</table>");
          	if(empty($pay_list))
			{
			print("<div style='margin:250px 0px 0px 350px'>");	
			print("<font style='font-size:2em;color:#254117; font-family:'BebasNeueRegular', Arial, Helvetica, sans-serif; >Nothing to Display...!</font>");
			print("</div");	
			}
  ?>
			