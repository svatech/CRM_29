
<?php
foreach($oil_service as $row){
$cust_name=$row["customer_name"];	
$mobile_no=$row["mobile_number"];
$oil_service_wedding_date=$row["oil_service_wedding_date"];



$text=urlencode("Dear $cust_name, Due date for changing your vehicle engine oil is on $oil_service_wedding_date. Thank you for being with PRICOL FUEL.");
//ECHO $m."<br>";
$sender=urlencode("PRICOL");
$URL="103.250.30.5/SendSMS/sendmsg.php?";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"http://$URL");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,"uname=deasms&pass=DeAs!@&send=$sender&dest=$mobile_no&msg=$text");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_exec ($curl);
//curl_close ($curl);
//echo $text;
$curl_output =curl_exec($ch);
echo $curl_output;

ECHO $mobile_no."<br>";
echo $cust_name."<br>";
echo $oil_service_wedding_date."<br>";
//echo $cust_mobile;
}
?>
