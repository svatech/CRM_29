<?php 
   $counter=0;
   print("<table width='100%' height='100%' border='1' align='left' cellpadding='1' cellspacing='1' style='margin-bottom:20px'>");
   foreach($indent_stmt as $row) {
   		$counter++;     	
     	$rowid="row".$counter;
     	print("<tr id='$rowid' class='td_rows'>");
        $billno_id="billno".$counter;  
        print("<td width='7%'  ><input type='text'  class='plain_txt' id='$billno_id'  value='".$row->bill_no."' /></td>");
    	print("<td width='7.5%'><input type='text'  class='plain_txt' readonly='readonly' value='".$row->bill_date."' /></td>");
        $party_id="cust_name".$counter;
        print("<td width='20%'><input type='text' class='plain_txt' readonly='readonly' id='$party_id' value='".$row->customer_name."' /></td>");
        print("<td width='7%'><input type='text'  class='plain_txt' readonly='readonly'  value='".$row->from_date."'/></td>");
   		print("<td width='7%'><input type='text'  class='plain_txt' readonly='readonly'  value='".$row->to_date."'/></td>");
   		print("<td width='6%'><input type='text' class='plain_txt' readonly='readonly'  value='".$row->bill_amount."'/></td>");
   		print("<td width='6%'><input type='text' class='plain_txt' readonly='readonly'  value='".$row->action_user."'/></td>");
		//print("<td width='10%'><input type='text' class='plain_txt' readonly='readonly'  value='".$row->status."'/></td>");
        //print("<td width='10%'><input type='text' class='plain_txt' readonly='readonly'  value='".$row->balance."' /></td>");
 		print("<td width='7%'><a  href='javascript:reprint_indent_bill(\"".$row->bill_no."\",\"".$row->bill_date."\");' id='edit_id'><font color='000000'>Reprint</font></a></td>");
 		print("<td width='6%'><a  href='javascript:show_details(\"".$row->bill_no."\");' id='edit_id'><font color='0033FF'>Details</font></a></td>");
 		print("<td width='5%'><a  href='javascript:cancel_indent_bill(\"".$row->bill_no."\");' id='edit_id'><font color='FF0000'>Cancel</font></a></td>");
		print("<td width='4%'><a  href='javascript:indent_customer_statement_sms(\"".$row->bill_no."\");' id='indent_sms'><font color='green'>SMS</font></a></td>");
 		$status=$row->indent_sms_status;
		$phone_number=$row->phone_number;
 		if( $status == 1 && (preg_match("/^[0-9]{10}$/", $phone_number)))
		{
		print("<td width='5%'> <font color='green'>Sent<font></td>");
		}
 		else if(!preg_match("/^[0-9]{10}$/", $phone_number)){
 			print("<td width='5%'><font color='RED'>Invalid<font></td>");
 			}
 			else {
 				print("<td width='5%'><input type='text' class='plain_txt' readonly='readonly'  id='sms_status' value='' /></td>");
 			}
 		print("</tr>");    	
		 }
print("</table>");  
echo "<input type='hidden' id='hrowcount' value='$counter' />";
if($counter==0)
{
print("<div style='margin:150px 0px 0px 370px'>");	
print("<font style='font-size:2em;color:#254117; font-family:'BebasNeueRegular', Arial, Helvetica, sans-serif; >No Statements to Display...!</font>");
print("</div");	
}
?>