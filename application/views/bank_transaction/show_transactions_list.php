<?php 
   $counter=0;
   print("<table width='100%' height='100%' border='1' align='left' cellpadding='1' cellspacing='1' style='margin-bottom:20px'>");
   foreach($transactions as $row) {
   		$counter++;     	
     	$rowid="row".$counter;
     	print("<tr id='$rowid' class='td_rows'>");
     	if($row->transaction_type=='CASH'){
     		$trans_type="SHIFT AMOUNT-CASH DEPOSIT";
     	}
     	else if($row->transaction_type=='CREDIT'){
     		$trans_type="CREDIT CARD SALES CLEARANCE";
     	}
     	else if($row->transaction_type=='FLEET'){
     		$trans_type="FLEET CARD SALES CLEARANCE";
     	}
     	else if($row->transaction_type=='XTRAREWARD'){
     		$trans_type="XTRAREWARD CARD SALES CLEARANCE";
     	}
  		else if($row->transaction_type=='EASYFUELS'){
     		$trans_type="EASYFUELS CARD SALES CLEARANCE";
     	}
        print("<td width='25%'  ><input type='text'  class='plain_txt' id=''  value='".$trans_type."' title='".$trans_type."'/></td>");
        $cust_id="cust".$counter;
        print("<td width='14%'><input type='text' class='plain_txt' readonly='readonly'  value='".$row->deposited_date."' title='".$row->deposited_date."'/></td>");
        if($row->transaction_type=='CASH' || $row->transaction_type=='CREDIT'){
        	print("<td width='15%'><input type='text' class='plain_txt' readonly='readonly' id='' value='".$row->shift_date."' title='".$row->shift_date."'/></td>");
        }
        else{
        	print("<td width='15%'><input type='text' class='plain_txt' readonly='readonly' id='' value='".$row->trans_start_date."-".$row->trans_end_date."' title='".$row->trans_start_date."-".$row->trans_end_date."'/></td>");
        }
        print("<td width='11%'><input type='text'  class='plain_txt' readonly='readonly' id='' value='".$row->amount."'/></td>");
   		print("<td width='11%'><input type='text'  class='plain_txt' readonly='readonly' id='' value='".$row->added_by."'/></td>");
        print("<td width='14%'><input type='text'  class='plain_txt' readonly='readonly' id='' value='".$row->added_time."' /></td>");
 		$edit_id="edit".$counter;
        print("<td width='5%'><a  href='javascript:update_entry(\"".$row->id."\");' id='edit_id'><font color=''>Edit </font></a></td>");
		$cancel_id="cancel".$counter;
        print("<td width='5%'><a  href='javascript:cancel_entry(\"".$row->id."\");' id='cancel_id'><font color='FF0000'>Cancel </font></a></td>");
        print("</tr>");    	
		 }
print("</table>");  
echo "<input type='hidden' id='hrowcount' value='$counter' />";
if($counter==0)
{
print("<div style='margin:150px 0px 0px 370px'>");	
print("<font style='font-size:2em;color:#254117; font-family:'BebasNeueRegular', Arial, Helvetica, sans-serif; >No Transactions to Display...!</font>");
print("</div");	
}
?>  
