<?php
header("X-Powered-By: "); 

session_start();
$this_id = $_SESSION['this_id'];
$withdrawid = $_SESSION['withdrawid'];

require('config.php');
$mysql = new mysqli(MYSQL_HOSTNAME,MYSQL_USERNAME,MYSQL_PASSWORD,MYSQL_DATABASE);
$results = $mysql->query("SELECT * FROM `invoice` WHERE `order_id`='$this_id'");
$row = $results->fetch_assoc();
$mysql->close();

if ($row['chances'] <1)
{
echo '0';
}
else
{
$mysql = new mysqli(MYSQL_HOSTNAME,MYSQL_USERNAME,MYSQL_PASSWORD,MYSQL_DATABASE);
$update_add = $mysql->query("UPDATE invoice SET withdraw_id = '$withdrawid' WHERE `order_id`='$this_id'");
$row = $update_add->fetch_assoc();
$mysql->close();

// this is where the forwarding code comes. If this code executes, a payment has been received.
echo "Place your code here to begin the paid session";
}


?>
