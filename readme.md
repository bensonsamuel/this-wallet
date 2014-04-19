Get Started

1. Upload all files from this-wallet to the webserver.
2. Navigate to assets/scripting/config.php and update the Mysql Data, Coinbase API Key & Secret and Blockchain.info details.
   a. Click on Merchant tools in Coinbase and activate an API key. Set the granular controls for 'button' only. The callback URL is yoururl.com/assets/scripting/coinbase_callback.php
   b. Blockchain.info is needed only to validate the address. Please do not store funds on this account.
3. Copy the code below and add it to the sql page on phpmyadmin.

	CREATE TABLE `invoice` (
  `id` int(150) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `order_id` varchar(150) NOT NULL,
  `int_txid` varchar(150) NOT NULL,
  `tx_id` varchar(150) NOT NULL,
  `value_in_btc` decimal(20,8) NOT NULL,
  `confirmations` int(150) NOT NULL,
  `withdraw_id` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

4. In order to redirect users to a page, please enter the redirection code in refreshbalance.php

Do let me know if there are any parts of the code that does not work/ Needs clarity. It has been tested across few implements.
Demo is available at coinsecure.in/this-wallet. 
Live wallets are at use with investbitcoin.in and satoshi-karate.com.

