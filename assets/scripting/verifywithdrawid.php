<?php
header("X-Powered-By: "); 
session_start();

$withdrawid = $_POST['withdrawid'];
$amount = $_POST['amount'];
$this_id = $_SESSION['this_id'];
$order_id = hash('md5', $this_id);

require_once 'config.php';

		$isvalid = $bitcoin->validateaddress($withdrawid);
		$withdrawtype = "bitcoin";
		
		if (filter_var($withdrawid, FILTER_VALIDATE_EMAIL)) {
		$isvalid = 'isvalid';
		$withdrawtype = "coinbase";
		}
    				
		if($isvalid['isvalid']) {
            $_SESSION['withdrawid'] = $withdrawid;
            $response = $coinbase->createButton($order_id, $amount, "BTC", array(
                "description" => "My Wallet"));
            
            echo $response->button->code;
	
		}
		else{
		echo "Please enter a valid address";
		}


?>