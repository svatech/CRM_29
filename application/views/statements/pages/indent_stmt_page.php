
<div >
  <p style='margin-left:70%;display:none;' id='billno_row' >Bill No: <span id='billno' style='margin-left:5px;'></span><input type="text" id="bill_no"  class="" style="width:100px;"/></p>  
<p style='margin-left:70%' >Date:<span id='billdate' style='margin-left:5px;'></span><input type="text" id="bill_date"  class="" style="width:100px onclick='generate bill()';"/></p>
<div  style='float:left;width:50%'> 

<table style='margin-left:30px;font-size:10pt;font-weight:bold;'>
<tr><td>From</td><td>PRICOL FUEL & LUBE SERVICES,</td></tr>
<tr><td></td><td>SURVEY NO - 318/319, P.N.PALAYAM,</td></tr>
<tr><td></td><td>COIMBATORE - 641020</td></tr>
</table>
</div>
<?php foreach($cust_addr as $addr)
{
$addrs=explode('%%',$addr['address']);

$total_bills=$addr["total_bills"];
$total_payments=$addr["total_payments"];
}
?>
<?php foreach ($cust_addr as $names);?>

<div  style='float:right;width:50%;'> 
<table align="left" style='font-size:10pt;font-weight:bold;'>
<tr><td>To</td><td><?php if(isset($names["customer_name"])){echo strtoupper($names["customer_name"]);}?></td></tr>
<tr><td></td><td><?php if(isset($addrs[0])){echo $addrs[0];}?></td></tr>
<tr><td></td><td><?php if(isset($addrs[1])){echo $addrs[1];}?></td></tr>
<tr><td></td><td><?php if(isset($addrs[2])){echo $addrs[2];} ?></td></tr>
</table>
</div>

</div>
<?php print("<p align='center' style='margin-top:100px;font-size:10pt;font-weight:bold;'>Indent Fuels/Lubes Sales Details for the Period $sdate To $edate </p>"); ?>
<?php
	   print("<table  border='0' align='left' cellpadding='1' cellspacing='1' margin='10px' style='border-collapse:collapse;font-size:9pt;'>");
       print("<tr bgcolor='#559999' id='hdr_row' style='color:white;border-right:1px solid white; '>");
       print("<td width='12%' align='center'><span class='txt1_color'>Bill Date</span></td>");
       print("<td width='12%' align='center'><span class='txt1_color'>Shift</span></td>");
       print("<td width='12%' align='center'><span class='txt1_color'>Indent No</span></td>");
       print("<td width='12%' align='center'><span class='txt1_color'>Reference No</span></td>");
       print("<td width='12%' align='center'><span class='txt1_color'>Bill No</span></td>");
       print("<td width='20%' align='center'><span class='txt1_color'>Type of Product</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>Quantity(Ltrs)</span></td>");
       print("<td width='10%' align='center'><span class='txt1_color'>MRP(Rs)</span></td>");
       print("<td width='12%' align='center'><span class='txt1_color'>Amount(Rs)</span></td>");
       print("</tr>");
       
      	    $veh_no="";
      	    $ctr=0;
      	    $r_tot_amt=0;
      	    $t_tot_amt=0;
            foreach($indent_stmt as $openrow) {
             if($veh_no!=$openrow["vehicle_number"]){
             if($ctr!=0){
             print("<tr class='td_rows'>");
			 print("<td width='12%' align='right' colspan='8'></td>");
                     
             print("<td width='12%' align='center'>".round($r_tot_amt,3)."</td>");
             print("</tr>");
             }
             	$veh_no=$openrow["vehicle_number"];
             	$ctr++;
             	$r_tot_amt=0;
           	 print("<tr class='td_rows'>");
			 print("<td width='12%' align='left' colspan='9'>".$openrow["vehicle_number"]."</td>");
             print("</tr>");
             }
             $r_tot_amt+=round($openrow["value"],3);
             $t_tot_amt+=round($openrow["value"],3);
			/* print("<tr class='td_rows'>");
			 print("<td width='12%' align='center'><input type='text'  readonly='readonly' value='".$openrow["billdate"]."' size='10' class='plain_txt' /></td>");
             print("<td width='12%' align='center'><input type='text'  readonly='readonly' value='".$openrow["shift"]."' size='10' class='plain_txt' /></td>");
             print("<td width='12%' align='center'><input type='text'  readonly='readonly' value='".$openrow["indent_no"]."' size='8' class='plain_txt' /></td>");
             print("<td width='12%' align='center'><input type='text' readonly='True' value='".$openrow["bill_number"]."' size='5' class='plain_txt'/></td>");
             print("<td width='20%' align='center'><input type='text' readonly='True' value='".$openrow["product"]."' size='20' class='plain_txt' /></td>");
             print("<td width='10%' align='center'><input type='text' readonly='True' value='".$openrow["quantity"]."' size='35' class='plain_txt' /></td>");             
             print("<td width='10%' align='center'><input type='text' readonly='True' value='".$openrow["rate"]."' size='6' class='plain_txt' /></td>");             
             print("<td width='12%' align='center'><input type='text' readonly='readonly' value='".$openrow["value"]."' size='8' class='plain_txt' /></td>");
             
             print("</tr>");
             */
             print("<tr class=''>");
             print("<td width='12%' align='center'>".($openrow["billdate"]!='0000-00-00' && $openrow["billdate"]!='' ? date('d-m-Y',strtotime($openrow["billdate"])) : '')."</td>");
             print("<td width='12%' align='center'>".$openrow["shift"]."</td>");
             print("<td width='12%' align='center'>".$openrow["indent_no"]."</td>");
             print("<td width='12%' align='center'>".$openrow["reference_no"]."</td>");
             print("<td width='12%' align='center'>".$openrow["bill_number"]."</td>");
             print("<td width='20%' align='center'>".$openrow["product"]."</td>");
             print("<td width='10%' align='center'>".$openrow["quantity"]."</td>");             
             print("<td width='10%' align='center'>".$openrow["rate"]."</td>");             
             print("<td width='12%' align='center'>".$openrow["value"]."</td>");
             $ctr++;
             print("</tr>");
               		}
               		if($ctr!=0){
             print("<tr class='td_rows'>");
			 print("<td width='12%' align='right' colspan='8'></td>");
                     
             print("<td width='12%' align='center'>".round($r_tot_amt,3)."</td>");
             print("</tr>");
             /*print("<tr class='td_rows'>");
			 print("<td width='12%' align='right' colspan='7'>Total</td>");
                     
             print("<td width='12%' align='center'>".round($t_tot_amt,3)."</td>");
             print("</tr>");
             print("<tr class='td_rows'>");
			 print("<td width='12%' align='right' colspan='7'>Old Arrears</td>");
			 if(!isset($old_arrears)){
             $old_arrears=$total_bills-$total_payments;
			 }
             print("<td width='12%' align='center'>".round($old_arrears,3)."</td>");
             print("</tr>");*/
              print("<tr class='td_rows'>");
			 print("<td width='12%' align='right' colspan='8'>Grand Total</td>");
             //$grant_tot=$t_tot_amt+$old_arrears;
             $grant_tot=$t_tot_amt;
             print("<td width='12%' align='center'>".round($grant_tot,2)."</td>");
             print("<input type='hidden' id='grand_tot' name='grand_tot' value='".round($grant_tot,2)."' />");
            // print("<input type='hidden' id='old_arrears' name='old_arrears' value='".round($old_arrears,3)."' />");
             print("</td></tr>");
               		
          print("</table>");
          if($grant_tot>0){
          $tot_arr=explode('.', round($grant_tot,2));
          print("<p align='center' style='margin-top:80px;font-size:9pt;font-weight:bold;'>");
          if(isset($tot_arr[1]) and $tot_arr[1]!='')
          print(no_to_word($tot_arr[0],'1')." ".no_to_word_paise(str_pad($tot_arr[1],2,"0")));
          else 
          print(no_to_word($tot_arr[0],'0'));
          print("</p>");
          
          print("<p align='left' style='margin-top:30px;margin-left:30px;font-size:9pt;font-weight:bold;'> Note: This is Computer generated bill. Signature is not required.</p>");
          }
               		}
          ?>
      
