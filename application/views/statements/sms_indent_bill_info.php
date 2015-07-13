<?php
foreach($indent_customer_bill as $row){
$cust_name=$row["customer_name"];	
$mobile_no='9787623603';
$bill_amount=$row["bill_amount"];
$from_date=$row["from_date"];
$to_date=$row["to_date"];
$bill_no=$row["bill_no"];

$text=urlencode("Dear $cust_name, Your Vehicle $veh_no has purchased $purchase for $tot_price. Thank you for being with PRICOL.");
$sender=urlencode("PRICOL");
$URL="103.250.30.5/SendSMS/sendmsg.php?";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"http://$URL");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,"uname=deasms&pass=DeAs!@&send=$sender&dest=$cust_mobile&msg=$text");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//echo $text;
$curl_output =curl_exec($ch);
echo $curl_output;
}

?>
