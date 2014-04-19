<?php


define("MYSQL_HOSTNAME","localhost");
define("MYSQL_USERNAME",""); // enter your mysql username
define("MYSQL_PASSWORD",""); // enter your mysql password
define("MYSQL_DATABASE","thiswallet"); // change this if you use a different DB name

require_once('jsonRPCClient.php');
require_once 'coinbase-php/lib/Coinbase.php';

$coinbase = Coinbase::withApiKey("API_KEY", "API_SECRET"); // change the API key and Secret with the one from Coinbase

// enter blockchain.info wallet identifier and password in order to verify Bitcoin withdraw ID

$btc_connect = array("user" => "identifier","pass" =>   "password", "host" =>   "blockchain.info", "port" =>   80);
$bitcoin = new jsonRPCClient("http://{$btc_connect['user']}:{$btc_connect['pass']}@{$btc_connect['host']}:{$btc_connect['port']}");



?>
