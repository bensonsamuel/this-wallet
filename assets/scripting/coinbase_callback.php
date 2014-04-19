<?php


$json=json_decode($HTTP_RAW_POST_DATA, true);

require('config.php');

		$order_id = $json['order']['custom'];
		$int_txid = hash('sha256', $json['order']['id']);
        $trx_id = hash($json['transaction']['hash']);
		$value_in_btc = $json['order']['total_btc']['cents']/100000000;
		$confirmations= $json['order']['transaction']['confirmations'];

	if(isset($json['order']['id'])){
		
	$mysql = new mysqli(MYSQL_HOSTNAME,MYSQL_USERNAME,MYSQL_PASSWORD,MYSQL_DATABASE);
        $update_invoice =  "INSERT INTO `invoice`(`order_id`, `int_txid`, `tx_id`, `value_in_btc`, `confirmations`, `withdraw_id`)VALUES('$order_id', '$int_txid', '$tx_id', '$value_in_btc', '$confirmations', 'None')";
        mysqli_query($mysql, $update_invoice);
        $mysql->close();

	} else {
		// Someone sent to our Bitcoin address. This shouldn't happen if we don't post it anywhere.
	}	
	

?>