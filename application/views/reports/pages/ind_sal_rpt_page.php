<?php
 print("<table width='100%' border='1' align='left' cellpadding='1' class='alt_row' cellspacing='1' margin='10px' style='border-collapse:collapse;margin-bottom:20px;'>");
       print("<tr bgcolor='#559999' id='hdr_row' style='background-color:#559999;color:white;border-right:1px solid white;'>");
       print("<td width='9%' align='center'><span class='txt1_color'>Acct Date</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Bill No</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Indent No</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Shift</span></td>");
       print("<td width='30%' align='center'><span class='txt1_color'>Party Name</span></td>");
       print("<td width='5%' align='center'><span class='txt1_color'>Vehicle</span></td>");
       print("<td width='5%' align='center'><span class='txt1_color'>Product</span></td>");
       print("<td width='5%' align='center'><span class='txt1_color'>Litres</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Amount(Rs)</span></td>");
       print("</tr>");
       
      	    $total=0;
            foreach($indent_rpt as $openrow) {
        	 
			$CI =& get_instance();
			$CI->load->model('Reports_model');
			$result = $CI->Reports_model->ind_sal_report_details($openrow["bill_number"]);
			$ctr=1;
			$tot_ltrs=0;
			foreach ($result as $val) {
			if($ctr==1){
			 print("<tr class='small'>");
			 print("<td width='9%' align='center'>".($openrow["bill_date"]!='0000-00-00' ? date('d-m-Y',strtotime($openrow["bill_date"])) : '')."</td>");
             print("<td width='10%' align='center'>".$openrow["bill_number"]."</td>");
             print("<td width='10%' align='center'>".$openrow["indent_no"]."</td>");
             print("<td width='10%' align='center'>".$openrow["shift"]."</td>");
             print("<td width='30%' align='center'>".$openrow["customer_name"]."</td>");
             print("<td width='5%' align='center'>".$openrow["vehicle_number"]."</td>");             
             print("<td width='5%' align='center'>".$val["product"]."</td>");             
             print("<td width='5%' align='center'>".$val["quantity"]."</td>");
             print("<td width='10%' align='center'>".$val["value"]."</td>");
              $total+=$val["value"];
             print("</tr>");
             $ctr++;
             $tot_ltrs+=$val["quantity"];
			}
			else{
			 print("<tr class='small'>");
			 print("<td width='10%' align='center'></td>");
             print("<td width='10%' align='center'></td>");
             print("<td width='10%' align='center'></td>");
             print("<td width='10%' align='center'></td>");
             print("<td width='10%' align='center'></td>");
             print("<td width='20%' align='center'></td>");
             print("<td width='10%' align='center'>".$val["product"]."</td>");             
             print("<td width='10%' align='center'>".$val["quantity"]."</td>");             
             print("<td width='10%' align='center'>".$val["value"]."</td>");
             print("</tr>");
              $total+=$val["value"];
             $tot_ltrs+=$val["quantity"];
			}
			}
			
          }
          print("<tr style='color:#9900CC;font-weight:bold;'>");
          print("<td width='10%' align='center'></td>");
       print("<td width='10%' align='center'></td>");
       print("<td width='10%' align='center'></td>");
       print("<td width='10%' align='center'></td>");
       print("<td width='10%' align='center'></td>");
       print("<td width='20%' align='center'></td>");
       print("<td width='10%' align='center'></td>");
       print("<td width='10%' align='center'>Total</td>");
       print("<td width='10%' align='center'>".$total."</td>");
       print("</tr>");
          print("</table>");
          	if(empty($indent_rpt))
			{
			print("<div style='margin:150px 0px 0px 370px'>");	
			print("<font style='font-size:2em;color:#254117; font-family:'BebasNeueRegular', Arial, Helvetica, sans-serif; >Nothing to Display...!</font>");
			print("</div");	
			}
  