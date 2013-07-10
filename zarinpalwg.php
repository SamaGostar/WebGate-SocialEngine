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
include("nusoap/nusoap.php");
$amount=$price;
$callBackUrl = $url.'/zarinpalwgcb.php?sid='.$sid;
$client = new nusoap_client('https://www.zarinpal.com/pg/services/WebGate/wsdl', 'wsdl');
$res = $client->call('PaymentRequest', array(
array(
					'MerchantID' 	=> $mid ,
					'Amount' 		=> $amount ,
					'Description' 	=> $sid ,
					'Email' 		=> $data['email'] ,
					'Mobile' 		=> '' ,
					'CallbackURL' 	=> $callBackUrl
					)
) );
header('Location: https://www.zarinpal.com/pg/StartPay/'.$res['Authority'] . "/");
?>