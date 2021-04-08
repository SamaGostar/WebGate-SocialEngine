<?php
include("save.php");
$orderid  = $_POST['vendor_order_id'];
//user id
$query1="SELECT * FROM engine4_payment_orders WHERE order_id='$orderid'";
$select1=mysql_query($query1);
$row1=mysql_fetch_array($select1);
$uid=$row1['user_id'];
$email=$row1['user_email'];
$sid=$row1['source_id'];
$query="SELECT * FROM engine4_payment_subscriptions WHERE subscription_id='$sid'";
$select=mysql_query($query);
$row=mysql_fetch_array($select);
$pid=$row['package_id'];
$query2="SELECT * FROM engine4_payment_packages WHERE package_id='$pid'";
$select2=mysql_query($query2);
$row2=mysql_fetch_array($select2);
$price=$row2['price'];
$zaman=$row2['recurrence_type'];
$query3="SELECT * FROM zarinpal ";
$select3=mysql_query($query3);
$row3=mysql_fetch_array($select3);
$url=$row3['url'];
$mid=$row3['mid'];
$callBackUrl = $url.'/zarinpalwgcb.php?sid='.$sid;
$amount=$price;
$param_request = array(
	'merchant_id' => $mid,
	'amount' => $amount * 10,
	'description' => $sid,
	'callback_url' => $callBackUrl
);
$jsonData = json_encode($param_request);

$ch = curl_init('https://api.zarinpal.com/pg/v4/payment/request.json');
curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v4');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/json',
	'Content-Length: ' . strlen($jsonData)
));


$result = curl_exec($ch);
$err = curl_error($ch);
$result = json_decode($result, true, JSON_PRETTY_PRINT);
curl_close($ch);

if($result['data']['code'] == 100)
{
	header('Location: https://www.zarinpal.com/pg/StartPay/'.$result['data']['Authority']);
}else{
	echo'ERR: '.$result['errors']['code'];
}
?>
