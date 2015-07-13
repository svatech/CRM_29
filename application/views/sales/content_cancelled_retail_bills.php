<?php 
   $counter=0;
   print("<table width='100%' height='100%' border='1' align='left' cellpadding='1' cellspacing='1' style='margin-bottom:20px'>");
   foreach( $cancelled_bills as $row) {
   		$counter++;     	
     	$rowid="row".$counter;
     	print("<tr id='$rowid' class='td_rows'>");
        $bill_id="bill_no".$counter;  
        $bill_no=$row->bill_number;   
		
		print("<td width='8%'  ><input type='text'  class='plain_txt' id='$bill_id'  value='$bill_no' /></td>");
    	$cust_id="cust".$counter;
        print("<td width='16%'><input type='text'  class='plain_txt' readonly='readonly' id='$cust_id' value='".$row->customer_name."' /></td>");
        $acctdate_id="acctdate".$counter;
         print("<td width='8%'><input type='text' class='plain_txt' readonly='readonly' id='$acctdate_id' value='".$row->acct_date."'/></td>");
        $totamt_id="totamt".$counter;
         print("<td width='8%'><input type='text'  class='plain_txt' readonly='readonly' id='$totamt_id' value='".$row->total_amount."'/></td>");
        $sales_id="sales".$counter;
        print("<td width='9%'><input type='text'  class='plain_txt' readonly='readonly' id='$sales_id' value='".$row->sale_mode."' /></td>");
 		$bill_time="billtime".$counter;
        print("<td width='12%'><input type='text'  class='plain_txt' readonly='readonly' id=' $bill_time' value='".$row->bill_time."' /></td>");

		$cancel_time="canceltime".$counter;
        print("<td width='12%'><input type='text'  class='plain_txt' readonly='readonly' id=' $cancel_time' value='".$row->cancelled_time."' /></td>");
		$cancel_user="cancel_user".$counter;
        print("<td width='6%'><input type='text'  class='plain_txt' readonly='readonly' id=' $cancel_user' value='".$row->cancelled_user."' /></td>");
		$reason="reason".$counter;
        print("<td width='16%'><textarea name='reason' id='reason' rows='3' cols='20'  class='plain_txt'>$row->reason</textarea></td>");
		$edit_id="edit".$counter;
        print("<td width='5%'><a  href='javascript:show_cancelbill_details(\"".$row->bill_number."\");' id='edit_id'><font color=''>Click</font></a></td>");
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
