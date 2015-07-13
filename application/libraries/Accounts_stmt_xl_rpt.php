
<?php 

class Accounts_stmt_xl_rpt{

 public function Export($cust_name,$cust_info,$pay_list,$adv_paymts,$bal_amt){
		header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=Accounts_statement from ".$cust_name.".xls");
        print("<p align='center' style='margin-top:10px;font-size:20pt;font-weight:bold;'>Indent Customers Account History </p>"); 
        
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
 	   //	print("<div style='width:100%;'>");
 	    //print("<p align='center' style='width:100%'>");
 	   	//print("<div style='width:50%;float:left;margin-top:20px;margin-left:10px;'  >");
		print("<table  border='0' align='left'  style='width:50%;border-collapse:collapse;margin-bottom:20px;margin-left:10px;font-size:10pt;' > ");
		print("<tr style='font-weight:bold;'><td colspan='2'>Customer Name :</td><td colspan='3'>".$row["customer_name"]."</td> <td colspan='2'>Initial Deposit:</td><td colspan='3'> ".$row["initial_deposit"]."</td></tr>");
		print("<tr style='font-weight:bold;'><td colspan='2' rowspan='2'>Address:</td><td colspan='3' rowspan='2'>".$row["address"]."</td> <td colspan='2'>Advance Payments Amount:</td><td colspan='3'> ".$adv_paymt."</td></tr>");
		print("<tr style='font-weight:bold;'><td colspan='2'>Amount To be Paid(Excluding Advance Payments):</td><td colspan='3'> ".$bal_amt."</td></tr>");
		//print("</table>");
		//print("</div>");
		//print("<div style='width:50%;float:right;margin-top:20px;'>");
		//print("<table  border='0'   style='width:50%;border-collapse:collapse;' > ");
		//print("<tr style='font-weight:bold;'><td>Initial Deposit: ".$row["initial_deposit"]."</td></tr>");
		//print("<tr style='font-weight:bold;'><td>Advance Payments Amount: ".$adv_paymt."</td></tr>");
		//print("<tr style='font-weight:bold;'><td>Amount To be Paid(Excluding Advance Payments): ".$bal_amt."</td></tr>");
		//print("</table>");
		//print("</div>");
		//print("</p>");
		//print("<input type='button' id='make_payment' value='Make Payment' style='float:right;margin-right:50px;padding:5px;margin-bottom:10px;' onclick='make_cust_payment(\"".$row["customer_id"]."\")' />");
		//print("</div>");
 	   }
 	   print("<div style='width:100%;'>");
	   print("<table border='1'  margin='10px' style='border-collapse:collapse;margin-bottom:20px;'>");
       print("<tr bgcolor='#518C9C' id='hdr_row' style='color:white;border-right:1px solid white; '>");
       print("<td width='' align='center'>Date</td>");
       print("<td width='' align='center'>Stmt No</td>");
       print("<td width='' align='center'>Period</td>");
       print("<td width='' align='center'>Total Amount</td>");
       print("<td width='' align='center'>Payment Mode</td>");
       print("<td width='' align='center'>Paid Amount</td>");
       print("<td width='' align='center'>Cheque No</td>");
       print("<td width='' align='center'>Cheque Date</td>");
       print("<td width='' align='center'>Bank Name</td>");
       print("<td width='' align='center'>Status</td>");
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
			 if($openrow["payment_mode"]=='CHEQUE'){
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
          print("</div>");
          	if(empty($pay_list))
			{
			print("<div style='margin:250px 0px 0px 350px'>");	
			print("<font style='font-size:2em;color:#254117; font-family:'BebasNeueRegular', Arial, Helvetica, sans-serif; >Nothing to Display...!</font>");
			print("</div");	
			}

}
}	
?>		