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
   foreach( $managed_retail_bill_details as $row) {
   		$counter++;     	
     	$rowid="row".$counter;
     	print("<tr id='$rowid' class='td_rows'>");
        $bill_id="bill_no".$counter;  
        $bill_no=$row->bill_number;   
		$version=$row->bill_updated;               
        $version1=romanNumerals($version);
		$bill_version=$bill_no." - ".$version1;
        
		print("<td width='12%'  ><input type='text'  class='plain_txt' id='$bill_id'  value='$bill_version' /></td>");
    	$cust_id="cust".$counter;
        print("<td width='16%'><input type='text'  class='plain_txt' readonly='readonly' id='$cust_id' value='".$row->customer_name."' /></td>");
        $vehicle_id="vehicle".$counter;
        print("<td width='10%'><input type='text' class='plain_txt' readonly='readonly' id='$vehicle_id' value='".$row->vehicle_number."' /></td>");
        $acctdate_id="acctdate".$counter;
         print("<td width='10%'><input type='text' class='plain_txt' readonly='readonly' id='$acctdate_id' value='".$row->acct_date."'/></td>");
   		 $Shift_id="shift".$counter;
         print("<td width='5%'><input type='text'  class='plain_txt' readonly='readonly' id='$Shift_id' value='".$row->shift."'/></td>");
   		    $count_id="count".$counter;
         print("<td width='5%'><input type='text'  class='plain_txt' readonly='readonly' id='$count_id' value='".ucfirst($row->counter)."'/></td>");
		$totamt_id="totamt".$counter;
         print("<td width='8%'><input type='text'  class='plain_txt' readonly='readonly' id='$totamt_id' value='".$row->total_amount."'/></td>");
        $sales_id="sales".$counter;
        print("<td width='10%'><input type='text'  class='plain_txt' readonly='readonly' id='$sales_id' value='".$row->sale_mode."' /></td>");
 		$bill_time="billtime".$counter;
        print("<td width='14%'><input type='text'  class='plain_txt' readonly='readonly' id=' $bill_time' value='".$row->bill_time."' /></td>");
		$user="user".$counter;
        print("<td width='5%'><input type='text'  class='plain_txt' readonly='readonly' id=' $user' value='".$row->user."' /></td>");
		
        $edit_id="edit".$counter;
        print("<td width='5%'><a  href='javascript:showbilldetails(\"".$row->bill_number."-".$row->bill_updated."\");' id='edit_id' ><font color=''>Click</font></a></td>");
		print("</tr>");    	
		 }
print("</table>");  
echo "<input type='hidden' id='hrowcount' value='$counter' />";
if($counter==0)
{
print("<div style='margin:150px 0px 0px 370px'>");	
print("<font style='font-size:2em;color:#254117; font-family:BebasNeueRegular, Arial, Helvetica, sans-serif;'>No Bill to Display...! </font>");
print("</div>");	
}
?>  
