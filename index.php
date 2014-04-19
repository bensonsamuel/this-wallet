<?php
header("X-Powered-By: "); 
session_start();

require_once 'assets/scripting/PHPCoinAddress.php';

$coin = CoinAddress::bitcoin();  
$key = $coin['public'];
$this_id = hash('ripemd160', $key);
$_SESSION['this_id']= $this_id;

if (isset($_SESSION['withdrawid'])){
$add=$_SESSION['withdrawid'];
}else{$add="Please enter a valid address. We need this to send back any payment to you.";}

?>

<!doctype html public="♥">
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Coinbase Wallet</title>
    <meta name="author" content="cryptos">
   <link rel="stylesheet" href="assets/css/bootstrap.min.css">
   <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">

 
</head>
<body>
<style>
body {width:90%;height:100%;margin:0 auto;}
input {height:40px;width:300px;}
button{padding:20px;}
</style>

<button class="btn btn-info btn-lg" type="button" data-toggle="modal" data-target=".bs-example-modal-lg">Start</button>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Make a Payment</h4>
            </div>
            <div class="modal-body">
                
                <div id="container">
                
                <div class="valuebox">
                    <b>Please select the amount</b>
                    <br><br>
                    <div id="slider-horizontal"></div></br>
                    <p></div>
                <input type="text" id="amount" class="form-control" style="border:1;color:#f6931f; font-weight:bold;">
                BTC </p>


                    <p>Please enter a valid Bitcoin address or a Coinbase e-mail ID below. We need this to send back any payment to you.</p>
                    <input name="withdrawid" type="text" maxlength="100" value="" class="form-control" id="withdrawid" required />
                    </br>	</br>
                   
                    <div class="gamepayrules" align="center">
                        <span class="selectpaydivno" style="float:left;"><?php echo $add; ?></span>

                        <div id="procimg"><img src="assets/img/Processing.gif"></div>
                        
                    </div></div>

                <hr>
            <iframe src="" style="width: 520px; height: 200px; border: none; box-shadow: 0 1px 3px rgba(0,0,0,0.25); overflow: scroll;" scrolling="yes" allowtransparency="true" frameborder="0" class="coinbasepayframe" id="coinbasepayframe"></iframe>

                <button id="start_button" class="btn btn-primary btn-lg">Start</button>
                
                <div id="logoblock">
                <br>
                    <span><b><u>Payment Details</u></b></span></br>
                    <span><a id="othpay"><span align="right" class="paytext"></a><b>Coinbase: </b>No network transaction fees. Instant confirmations.</span><b><br>Other Wallets: </b>0.1 mBtc Network trx fees. Single broadcast to Coinbase is needed for play to begin.</span>

                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn">Close</a>
                </div>
            </div>
        </div>
    </div>
</div>

 <script src="assets/js/jquery.min.js"></script>
 <script src="assets/js/bootstrap.min.js"></script>
 <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
 
<script type="text/javascript">

$(document).ready(function() {

$("#coinbasepayframe").hide();
$("#procimg").hide();

$( "#start_button" ).click(function() {
  $('#start_button').hide;
  $("#logoblock").hide();
  $('.selectpaydivno').text('Checking Address. This will take a moment.');
  $('#procimg').show();
  verifyaddress();
 });

});


$(function() {
	  
      $("#slider-horizontal").slider({
      orientation: "horizontal",
      range: "max",
      step: 0.00100000,
      min: 0.00010000,
      max: 1.00000000,
      value: 0.00100000,
      slide: function(event, ui) {
      $("#amount").val(ui.value.toFixed(6));
	
      }
    });
    $("#amount").val( $("#slider-horizontal").slider("value"));
	
  });


function verifyaddress(){
withdrawid = $('#withdrawid').val();
amount = $('#amount').val();

$.ajax({url: 'assets/scripting/verifywithdrawid.php', type:'POST', data:{'withdrawid': withdrawid,'amount': amount}, dataType: 'text', 
success: function(output_string){
if (output_string[0] == "P"){$("#withdrawid").prop('enabled', 'true');$("#coinbasepayframe").hide();$('#procimg').hide();
    $('.selectpaydivno').html(output_string);$('.selectpaydivno').show();$('#start_button').show;return false;};
if (output_string[0] !== "P"){$("#container").hide();$('.selectpaydivno').html(output_string);$('.valuebox').hide();
    $("#withdrawid").prop('disabled', 'false');$('#coinbasepayframe').show();$('#procimg').hide(); $('#start_button').hide;
    coinbasepayframe();$('.selectpaydivno').hide();};
}})};


function checkpayment(){
$.ajax({
            url: 'assets/scripting/refreshbalance.php',
            type:'GET',
            dataType: 'text',
            success: function(output_string){
       
		if (output_string == 0){return false;}
		else
		{}} 
            });  
}

function coinbasepayframe(){

var buttid = $('.selectpaydivno').text();

$('.coinbasepayframe').attr('src', 'https://coinbase.com/inline_payments/'+buttid+'?custom='+'<?php echo $this_id ?>');
$("#coinbasepayframe").show();
setInterval(function(){checkpayment()},1000);

}
	
</script>


</body>
</html>

