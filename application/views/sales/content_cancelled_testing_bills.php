<?php 
   $counter=0;
   print("<table width='100%' height='100%' border='1' align='center' cellpadding='1' cellspacing='1' style='margin-bottom:20px'>");
   foreach( $cancelled_bills as $row) {
   		$counter++;     	
     	$rowid="row".$counter;
     	print("<tr id='$rowid' class='td_rows'>");
        $bill_id="bill_no".$counter;  
        $bill_no=$row->bill_no;   
		print("<td width='8%'  ><input type='text'  class='plain_txt' id='$bill_id'  value='$bill_no' /></td>");
    	$acct_date_id="acct_date".$counter;
        print("<td width='8%'><input type='text'  class='plain_txt' readonly='readonly' id='$acct_date_id' value='".$row->account_date."' /></td>");
        $Shift_id="shift".$counter;
        print("<td width='7%'><input type='text'  class='plain_txt' readonly='readonly' id='$Shift_id' value='".$row->shift."'/></td>");
   		$count_id="count".$counter;
        print("<td width='7%'><input type='text'  class='plain_txt' readonly='readonly' id='$count_id' value='".ucfirst($row->counter)."'/></td>");
        $pump_id="pump".$counter;
        print("<td width='10%'><input type='text' class='plain_txt' readonly='readonly' id='$pump_id' value='".$row->pump_no."'/></td>");
   		$testqty_id="testqty".$counter;
        print("<td width='10%'><input type='text'  class='plain_txt' readonly='readonly' id='$testqty_id' value='".$row->test_qty."'/></td>");
        $bill_time="billtime".$counter;
        print("<td width='15%'><input type='text'  class='plain_txt' readonly='readonly' id=' $bill_time' value='".$row->added_time."' /></td>");
 		$cancel_user="canceluser".$counter;
        print("<td width='10%'><input type='text'  class='plain_txt' readonly='readonly' id=' $cancel_user' value='".$row->cancelled_user."' /></td>");
        $cancel_time="canceltime".$counter;
        print("<td width='15%'><input type='text'  class='plain_txt' readonly='readonly' id=' $cancel_time' value='".$row->cancelled_time."' /></td>");
		$reason="reason".$counter;
        print("<td width='20%'><textarea name='reason' id='reason' rows='2' cols='20'  class='plain_txt'>$row->reason</textarea></td>");
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
