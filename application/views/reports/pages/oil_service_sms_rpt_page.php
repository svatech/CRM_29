<?php
 print("<table width='100%' border='1' align='left' cellpadding='1' class='alt_row' cellspacing='1' margin='10px' style='border-collapse:collapse;margin-bottom:20px;'>");
	print("<tr bgcolor='#559999' id='hdr_row' style='background-color:#559999;color:white;border-right:1px solid white;'>");
  			// print("<td width='5%' align='center'><span class='txt1_color'>Sno</span></td>");
			 print("<td width='20%' align='center'><span class='txt1_color'>Customer Name</span></td>");
      	 	 print("<td width='10%' align='center'><span class='txt1_color'>Vehicle No</span></td>");
      		 print("<td width='10%' align='center'><span class='txt1_color'>Mobile No</span></td>");
      		 print("<td width='10%' align='center'><span class='txt1_color'>Oil purchased date</span></td>");
      		 print("<td width='10%' align='center'><span class='txt1_color'>Days</span></td>");
       		 print("<td width='10%' align='center'><span class='txt1_color'>Oil service Count</span></td>");
      		// print("<td width='10%' align='center'><span class='txt1_color'>km added date</span></td>");
      		 print("<td width='10%' align='center'><span class='txt1_color'>Expiry date</span></td>");
      		 print("<td width='10%' align='center'><span class='txt1_color'>DOB</span></td>");
      		 print("<td width='10%' align='center'><span class='txt1_color'>Wedding Anniversary Date</span></td>");
      		 print("</tr>");
      		  $counter=0;
      		 foreach ($oil_service_report as $row){
      		 $counter++;     	
     		 $rowid="row".$counter;
      		 $CI =& get_instance();
			$CI->load->model('Reports_model');
			
			$result = $CI->Reports_model->get_oil_service_details($row["vehicle_number"]);
			foreach($result as $set)
			{
			$customer_counter=$set["customer_counter"];
			}
			$secs=strtotime($row["exp_date"])-strtotime(date("Y/m/d"));
			$duedate = $secs / 86400;
			
			print("<tr id='$rowid' class='' style=''>");
			
      		 $cust_id="cust_name".$counter;  
            $customer_name=$row["customer_name"];   
      		// print("<td width='5%' align='center'>".$openrow["Sno"]."</td>");
             print("<td width='20%' align='center'><input type='text' height='' style='margin-left:0px;color:black;font-weight:normal;' class='plain_txt'  id='$cust_id'  value='".$row["customer_name"]."' /></td>");
			
      		
      		 
             print("<td width='10%' align='center'>".$row["vehicle_number"]."</td>");
             print("<td width='10%' align='center'>".$row["mobile_number"]."</td>");
             print("<td width='10%' align='center'>".$row["km_add_date"]."</td>");
             if($duedate > 10)
             {
             print("<td width='10%' align='center'>".$duedate."</td>"); 
             }else
             {
             print("<td width='10%' align='center' style='color:red;'>".$duedate."</td>"); 
             }
             if($customer_counter <= "1")   
             {
             print("<td width='10%' align='center' style='color:red;'>".$customer_counter."</td>");
             }else {
               print("<td width='10%' align='center' style='color:green;'>".$customer_counter."</td>");
             }
            // print("<td width='10%' align='center'>".$openrow["km_add_date"]."</td>");
            print("<td width='10%' align='center'>".$row["exp_date"]."</td>");
             print("<td width='10%' align='center'>".$row["oil_service_dob"]."</td>");
             print("<td width='10%' align='center'>".$row["oil_service_wedding_date"]."</td>");
            
            
      		 }
      		 print("</tr>");
      		 
         
          print("</table>");
      		echo "<input type='hidden' id='hrowcount' value='$counter' />"; 
          	if(empty($oil_service_report))
			{
			print("<div style='margin:150px 0px 0px 370px'>");	
			print("<font style='font-size:2em;color:#254117; font-family:'BebasNeueRegular', Arial, Helvetica, sans-serif; >Nothing to Display...!</font>");
			print("</div");	
			}
			
			
			
			
			
  