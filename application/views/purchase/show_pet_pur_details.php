<?php 
   $counter=0;
   print("<table width='100%' height='100%' border='1' align='left' cellpadding='1' cellspacing='1' style='margin-bottom:20px'>");
   foreach($pur_details as $row) {
   		$counter++;     	
     	$rowid="row".$counter;
     	print("<tr id='$rowid' class='td_rows'>");
        $voucher_id="voucher_no".$counter;  
        $voucher_no=$row->voucher_no;   
        print("<td width='8%'  ><input type='text'  class='plain_txt' id='$voucher_id'  value='$voucher_no' /></td>");
    	$acct_date_id="acct_date".$counter;
        print("<td width='11%'><input type='text'  class='plain_txt' readonly='readonly' id='$acct_date_id' value='".$row->account_date."' /></td>");
        $inv_no_id="inv_no".$counter;
        print("<td width='10%'><input type='text' class='plain_txt' readonly='readonly' id='$inv_no_id' value='".$row->invoice_no."' /></td>");
        $inv_date_id="inv_date".$counter;
        print("<td width='11%'><input type='text' class='plain_txt' readonly='readonly' id='$inv_date_id' value='".$row->invoice_date."'/></td>");
   		$party_id="party".$counter;
        print("<td width='20%'><input type='text'  class='plain_txt' readonly='readonly' id='$party_id' value='".$row->party_name."'/></td>");
   		$pet_qty_id="pet_qty".$counter;
        print("<td width='10%'><input type='text'  class='plain_txt' readonly='readonly' id='$pet_qty_id' value='".$row->petrol."'/></td>");
		$diesel_qty_id="diesel_qty".$counter;
        print("<td width='10%'><input type='text'  class='plain_txt' readonly='readonly' id='$diesel_qty_id' value='".$row->diesel."'/></td>");
        $total_id="total".$counter;
        print("<td width='13%'><input type='text'  class='plain_txt' readonly='readonly' id='$total_id' value='".$row->total."' /></td>");
 		$edit_id="edit".$counter;
        print("<td width='5%'><a  href='javascript:updatebill(\"".$row->voucher_no."\");' id='edit_id'><font color=''>Edit </font></a></td>");
		print("</tr>");    	
		 }
print("</table>");  
echo "<input type='hidden' id='hrowcount' value='$counter' />";
if($counter==0)
{
print("<div style='margin:150px 0px 0px 370px'>");	
print("<font style='font-size:2em;color:#254117; font-family:'BebasNeueRegular', Arial, Helvetica, sans-serif; >No Purchase to Display...!</font>");
print("</div");	
}
?>  

