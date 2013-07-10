<?php

$con = mysql_connect("localhost","faraface_se4","FU3EWJTd");
mysql_select_db("faraface_se4", $con);


$s  = $_POST['s'];
$mid  = $_POST['mid'];
$url  = $_POST['url'];
if($s == 1){
echo("&#1578;&#1593;&#1740;&#1740;&#1585;&#1575;&#1578; &#1576;&#1575; &#1605;&#1608;&#1601;&#1602;&#1740;&#1578; &#1579;&#1576;&#1578; &#1588;&#1583;.");
$i=1;
//mysql_query("UPDATE `zarinpal` SET  `mid` = '$mid' WHERE `id`='$i'");
mysql_query("UPDATE zarinpal SET mid='$mid' , url='$url' WHERE `id`='$i'");
}
?>