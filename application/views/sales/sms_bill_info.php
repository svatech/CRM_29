<?php
if($info == "Petrol")
{
foreach($bill_info as $row){
	$veh_no=$row["vehicle_number"];
	$tot_price=$row["total_amount"];
}
}else if ($info == "Other")
{
foreach($bill_info as $row){
	$veh_no=$row["vehicle_number"];
	$tot_price=$row["total_amt"];
}
}
$purchase='';
$ctr=0;
foreach($bill_details as $res){
	$purchase=$purchase.$res["product"]." ".$res["quantity"]." Lit";
	//$purchase=$res["product"];
	if($ctr>0){
		//$purchase=$purchase.", ";
	}
	$ctr++;
}
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