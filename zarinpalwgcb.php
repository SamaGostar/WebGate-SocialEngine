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


	
	$merchantID = $mid;
	$amount = $price; //Amount will be based on Toman
	$au = $_GET['Authority'];
	$st = $_GET['Status'];
	$url=$url;
      //  $callBackUrl = $url.'/zarinpalcb.php?sid='.$sid;
      if($st == "OK"){

		  $param_verify = array("merchant_id" => $merchantID, "authority" => $au, "amount" => $amount * 10);
		  $jsonData = json_encode($param_verify);
		  $ch = curl_init('https://api.zarinpal.com/pg/v4/payment/verify.json');
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
		  curl_close($ch);
		  $result = json_decode($result, true);


      }else{
      	header('Location: '.$url.'/payment/subscription/finish/state/failed');
      }
      
      
if ($result['data']['code'] == 100) {
	//mysql_query("UPDATE `engine4_users` SET  `enabled` = '1' WHERE `user_id`='$uid'");
      header('Location: '.$url.'/payment/subscription/return?state=return');
}
if ($result['data']['code'] != 100) {
	//mysql_query("UPDATE `engine4_users` SET  `enabled` = '1' WHERE `user_id`='$uid'");
		echo'ERR: '.$result['errors']['code'];
      header('Location: '.$url.'/payment/subscription/finish/state/failed');

}
?>
