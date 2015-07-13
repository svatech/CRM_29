<?php 
   $counter=0;
   print("<table width='100%'  border='1' align='left' cellpadding='1' cellspacing='1' style='margin-bottom:20px'>");
   foreach($billdetails as $row) {
   		$counter++;     	
     	$rowid="row".$counter;
     	print("<tr id='$rowid' class='td_rows'>");
        $bill_id="bill_no".$counter;  
        $bill_no=$row->bill_number;   
               
        print("<td width='8%'  ><input type='text'  class='plain_txt' id='$bill_id'  value='$bill_no' /></td>");
    	$indentno_id="indentno".$counter;
    	if($row->indent_no!='NULL'){
        	print("<td width='8%'><input type='text'  class='plain_txt' readonly='readonly' id='$indentno_id' value='".$row->indent_no."' /></td>");
    	}
    	else{
    		print("<td width='8%'><input type='text'  class='plain_txt' readonly='readonly' id='$indentno_id' value='' /></td>");
    	}
    	$cust_id="cust".$counter;
        print("<td width='16%'><input type='text'  class='plain_txt' readonly='readonly' id='$cust_id' value='".$row->customer_name."' /></td>");
        $vehicle_id="vehicle".$counter;
        print("<td width='10%'><input type='text' class='plain_txt' readonly='readonly' id='$vehicle_id' value='".$row->vehicle_number."' /></td>");
        $acctdate_id="acctdate".$counter;
         print("<td width='9%'><input type='text' class='plain_txt' readonly='readonly' id='$acctdate_id' value='".$row->acct_date."'/></td>");
   		 $Shift_id="shift".$counter;
         print("<td width='5%'><input type='text'  class='plain_txt' readonly='readonly' id='$Shift_id' value='".$row->shift."'/></td>");
   		 $count_id="count".$counter;
         print("<td width='5%'><input type='text'  class='plain_txt' readonly='readonly' id='$count_id' value='".ucfirst($row->counter)."'/></td>");
		$totamt_id="totamt".$counter;
         print("<td width='8%'><input type='text'  class='plain_txt' readonly='readonly' id='$totamt_id' value='".$row->total_amount."'/></td>");
        $sales_id="sales".$counter;
        print("<td width='11%'><input type='text'  class='plain_txt' readonly='readonly' id='$sales_id' value='".$row->sale_mode."' /></td>");
 		$bill_time="billtime".$counter;
        print("<td width='14%'><input type='text'  class='plain_txt' readonly='readonly' id=' $bill_time' value='".$row->bill_time."' /></td>");
		$reprint_id="reprint".$counter;
        print("<td width='4%'><a  href='javascript:reprint_pd_bill(\"".$row->bill_number."\");' id='$reprint_id'><font color='000000'>Reprint </font></a></td>");
        $edit_id="edit".$counter;
        print("<td width='5%'><a  href='javascript:updatebill(\"".$row->bill_number."\");' id='edit_id'><font color=''>Edit </font></a></td>");
		$cancel_id="cancel".$counter;
        print("<td width='5%'><a  href='javascript:cancelbill(\"".$row->bill_number."\");' id='cancel_id'><font color='FF0000'>Cancel </font></a></td>");
        print("</tr>");    	
		 }
print("</table>");  
echo "<input type='hidden' id='hrowcount' value='$counter' />";
if($counter==0)
{
print("<div style='margin:150px 0px 0px 370px'>");	
print("<font style='font-size:2em;color:#254117; font-family:'BebasNeueRegular', Arial, Helvetica, sans-serif; >No Bill to Display...!</font>");
print("</div");	
}
?>  
