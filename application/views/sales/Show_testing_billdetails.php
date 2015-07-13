<?php 
   $counter=0;
   print("<table width='100%' height='100%' border='1' align='left' cellpadding='1' cellspacing='1' style='margin-bottom:20px'>");
   foreach($billdetails as $row) {
   		$counter++;     	
     	$rowid="row".$counter;
     	print("<tr id='$rowid' class='td_rows'>");
        $bill_id="bill_no".$counter;  
        $bill_no=$row->bill_no;   
               
        print("<td width='10%'  ><input type='text'  class='plain_txt' id='$bill_id'  value='$bill_no' /></td>");
    	$acct_date_id="acct_date".$counter;
        print("<td width='10%'><input type='text'  class='plain_txt' readonly='readonly' id='$acct_date_id' value='".$row->account_date."' /></td>");
        $Shift_id="shift".$counter;
        print("<td width='9%'><input type='text'  class='plain_txt' readonly='readonly' id='$Shift_id' value='".$row->shift."'/></td>");
   		$count_id="count".$counter;
        print("<td width='9%'><input type='text'  class='plain_txt' readonly='readonly' id='$count_id' value='".ucfirst($row->counter)."'/></td>");
        $pump_id="pump".$counter;
        print("<td width='9%'><input type='text' class='plain_txt' readonly='readonly' id='$pump_id' value='".$row->pump_no."'/></td>");
   		$testqty_id="testqty".$counter;
        print("<td width='11%'><input type='text'  class='plain_txt' readonly='readonly' id='$testqty_id' value='".$row->test_qty."'/></td>");
        $purpose_id="purpose".$counter;
        print("<td width='11%'><input type='text'  class='plain_txt' readonly='readonly' id='$purpose_id' value='".$row->purpose."'/></td>");
        $addby_id="addby".$counter;
        print("<td width='11%'><input type='text'  class='plain_txt' readonly='readonly' id='$addby_id' value='".$row->added_by."' /></td>");
 		$bill_time="billtime".$counter;
        print("<td width='13%'><input type='text'  class='plain_txt' readonly='readonly' id=' $bill_time' value='".$row->added_time."' /></td>");
		$cancel_id="cancel".$counter;
        print("<td width='7%'><a  href='javascript:cancel_testing_bill(\"".$row->bill_no."\");' id='$cancel_id'><font color='FF0000'>Cancel </font></a></td>");
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
