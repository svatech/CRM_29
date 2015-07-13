<?php 
   $counter=0;
   print("<table width='100%' height='100%' border='1' align='left' cellpadding='1' cellspacing='1' style='margin-bottom:20px'>");
   foreach($expenses as $row) {
   		$counter++;     	
     	$rowid="row".$counter;
     	print("<tr id='$rowid' class='td_rows'>");
        print("<td width='9%'  ><input type='text'  class='plain_txt' id=''  value='".$row->exp_date."' /></td>");
        $bill_id="bill_no".$counter;  
        print("<td width='6%'><input type='text'  class='plain_txt' readonly='readonly' id='$bill_id' value='".$row->bill_no."' title='".$row->bill_no."'/></td>");
        $cust_id="cust".$counter;
        print("<td width='15%'><input type='text' class='plain_txt' readonly='readonly' id='$cust_id' value='".$row->vendor_name."' title='".$row->vendor_name."'/></td>");
        print("<td width='15%'><input type='text' class='plain_txt' readonly='readonly' id='' value='".$row->items."' title='".$row->items."'/></td>");
   		print("<td width='10%'><input type='text'  class='plain_txt' readonly='readonly' id='' value='".$row->amount."'/></td>");
   		print("<td width='11%'><input type='text'  class='plain_txt' readonly='readonly' id='' value='".$row->added_by."'/></td>");
        print("<td width='14%'><input type='text'  class='plain_txt' readonly='readonly' id='' value='".$row->added_time."' /></td>");
 		print("<td width='10%'><input type='text'  class='plain_txt' readonly='readonly' id='' value='".$row->cancelled_by."' /></td>");
		print("<td width='10%'><input type='text'  class='plain_txt' readonly='readonly' id='' value='".$row->cancelled_time."' /></td>");
        print("</tr>");    	
		 }
print("</table>");  
echo "<input type='hidden' id='hrowcount' value='$counter' />";
if($counter==0)
{
print("<div style='margin:150px 0px 0px 370px'>");	
print("<font style='font-size:2em;color:#254117; font-family:'BebasNeueRegular', Arial, Helvetica, sans-serif; >No Expense to Display...!</font>");
print("</div");	
}
?>  
