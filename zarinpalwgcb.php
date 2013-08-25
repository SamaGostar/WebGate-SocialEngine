<?php
include("save.php");
$sid  =  $_GET['sid'];


$query="SELECT * FROM engine4_payment_subscriptions WHERE subscription_id='$sid'";
$select=mysql_query($query);
$row=mysql_fetch_array($select);
$pid=$row['package_id'];
$uid=$row['user_id'];

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
	
	$merchantID = $mid;
	$amount = $price; //Amount will be based on Toman
	$au = $_GET['Authority'];
	$st = $_GET['Status'];
	$url=$url;
      //  $callBackUrl = $url.'/zarinpalcb.php?sid='.$sid;
      if($st == "OK"){
	$client = new nusoap_client('https://de.zarinpal.com/pg/services/WebGate/wsdl', 'wsdl');
	$res = $client->call("PaymentVerification", array(
	array(
				'MerchantID'	 => $merchantID ,
				'Authority' 	 => $au ,
				'Amount'		 => $amount
				)
	));
      }else{
      	header('Location: '.$url.'/payment/subscription/finish/state/failed');
      }
      
      
if ($res->Status =="100") {
	//mysql_query("UPDATE `engine4_users` SET  `enabled` = '1' WHERE `user_id`='$uid'");
      header('Location: '.$url.'/payment/subscription/return?state=return');
}
if ($res->Status != 100) {
	//mysql_query("UPDATE `engine4_users` SET  `enabled` = '1' WHERE `user_id`='$uid'");
		echo'ERR: '.$res->Status;
      header('Location: '.$url.'/payment/subscription/finish/state/failed');

}
?>
