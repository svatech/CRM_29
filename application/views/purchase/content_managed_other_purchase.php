<?php 
function romanNumerals($num) 
{
    $n = intval($num);
    $res = '';
 
    /*** roman_numerals array  ***/
    $roman_numerals = array(
                'M'  => 1000,
                'CM' => 900,
                'D'  => 500,
                'CD' => 400,
                'C'  => 100,
                'XC' => 90,
                'L'  => 50,
                'XL' => 40,
                'X'  => 10,
                'IX' => 9,
                'V'  => 5,
                'IV' => 4,
                'I'  => 1);
 
    foreach ($roman_numerals as $roman => $number) 
    {
        /*** divide to get  matches ***/
        $matches = intval($n / $number);
 
        /*** assign the roman char * $matches ***/
        $res .= str_repeat($roman, $matches);
 
        /*** substract from the number ***/
        $n = $n % $number;
    }
 
    /*** return the res ***/
    return $res;
    }
?>

<?php
   $counter=0;
   print("<table width='100%' height='100%' border='1' align='left' cellpadding='1' cellspacing='1' style='margin-bottom:20px'>");
   foreach( $managed_other_purchase_details as $row) {
   		$counter++;     	
     	$rowid="row".$counter;
     	print("<tr id='$rowid' class='td_rows'>");
        $voucher_id="voucher_no".$counter;  
        $voucher_no=$row->voucher_no;   
		$version=$row->voucher_updated;               
        $version1=romanNumerals($version);
		$voucher_version=$voucher_no." - ".$version1;
        
		print("<td width='10%'  ><input type='text'  class='plain_txt' id='$voucher_id'  value='$voucher_version' /></td>");
    	 	$acct_date_id="acct_date".$counter;
        print("<td width='10%'><input type='text'  class='plain_txt' readonly='readonly' id='$acct_date_id' value='".$row->account_date."' /></td>");
        $inv_no_id="inv_no".$counter;
        print("<td width='10%'><input type='text' class='plain_txt' readonly='readonly' id='$inv_no_id' value='".$row->bill_no."' /></td>");
        $inv_date_id="inv_date".$counter;
        print("<td width='10%'><input type='text' class='plain_txt' readonly='readonly' id='$inv_date_id' value='".$row->bill_date."'/></td>");
   		$party_id="supp_name".$counter;
        print("<td width='20%'><input type='text'  class='plain_txt' readonly='readonly' id='$party_id' value='".$row->party_name."'/></td>");
   		$total_id="total".$counter;
        print("<td width='10%'><input type='text'  class='plain_txt' readonly='readonly' id='$total_id' value='".$row->total."' /></td>");
        $added_time_id="added_time".$counter;
        print("<td width='15%'><input type='text'  class='plain_txt' readonly='readonly' id='$added_time_id' value='".$row->added_time."' /></td>");
       	$user="user".$counter;
        print("<td width='7%'><input type='text'  class='plain_txt' readonly='readonly' id=' $user' value='".$row->added_by."' /></td>");
		
 		$edit_id="edit".$counter;
        print("<td width='8%'><a  href='javascript:showpurchasedetails_other(\"".$row->voucher_no."-".$row->voucher_updated."\")' id='edit_id'><font color=''>Click </font></a></td>");
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
		