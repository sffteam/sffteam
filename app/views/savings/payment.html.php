<?php

$MERCHANT_KEY = PAYUMONEY_KEY;
$SALT = PAYUMONEY_SALT;

$key = PAYUMONEY_KEY;
$txnid = "TXN-" . rand(10000,99999999);
$amount = substr($data->shopping,1);
$productinfo = $data->mcaNumber.'-'.$data->shopping;
$firstname = urldecode($data->name);
$udf1 = $paymentCount;
$email = $data->email;
$mobile = $data->mobile;
$udf5 = "BOLT_KIT_PHP7";
$salt = PAYUMONEY_SALT;

// Merchant Key and Salt as provided by Payu.

		$hash=strtolower(hash('sha512', $key.'|'.$txnid.'|'.$amount.'|'.$productinfo.'|'.$firstname.'|'.$email.'|'.$udf1.'||||'.$udf5.'||||||'.$salt));


//$PAYU_BASE_URL = "https://sandboxsecure.payu.in";		// For Sandbox Mode
$PAYU_BASE_URL = "https://secure.payu.in";			// For Production Mode

$action = $PAYU_BASE_URL . '/_payment';

?>
<html>
  <head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<link href="/css/bootstrap.css" rel="stylesheet">
<style>
<style>
.text{
 font-weight:bold;
}
p {
 color:red;
 font-weight:bold;
}
h4{margin-top:5px solid gray}
</style>

</style>
  <script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
     console.log(hash);
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>
  </head>
  <body>
<div class="container">
	<div  style="text-align:center">
     <div style="text-align:center">
    	<h4>Pay to Hitarth IT Services Pvt. Ltd. for SFF-Savings</h4>
     <h6>through</h6>
    </div>
    	<img src="/payumoney/images/payumoney.png" alt="PayUMoney" text="PayUMoney"/>
    </div>
    <div style="text-align:center">
    	<h4>Transaction of Rs. <?=number_format(substr($data->shopping,1))?></h4>
    </div>
    <form action="<?php echo $action; ?>" method="post" name="payuForm">
      <input type="hidden" name="key" value="<?php echo $key?>" />
      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
      <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
      <input type="hidden" id="udf5" name="udf5" value="<?=$udf5?>" />
      <input type="hidden" id="udf1" name="udf1" value="<?=$udf1?>" />
      <input type="hidden" id="surl" name="surl" value="https://sff.team/success" />
      <input type="hidden" id="furl" name="furl" value="https://sff.team/success" />
      <input type="hidden" id="service_provider" name="service_provider" value="payu_paisa" />

     <div class="form-group">
     <span class="text"><label>Transaction ID:</label></span>
     <input type="text" class="form-control" id="txnid" name="txnid"  placeholder="Transaction ID" value="<?=$txnid?>" readonly="readonly"/>
     </div>

    <div class="form-group">
    <span class="text"><label>Amount:</label></span>
    <span><input type="text" class="form-control" id="amount" name="amount" placeholder="Amount" value="<?=$amount?>"  readonly="readonly"/></span>    
    </div>

    <div class="form-group">
    <span class="text"><label>MCA-Product Info:</label></span>
    <span><input type="text" class="form-control" id="productinfo" name="productinfo" placeholder="Product Info" value="<?=$productinfo?>"  readonly="readonly"/></span>
    </div>

    <div class="form-group">
    <span class="text"><label>Name:</label></span>
    <span><input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" value="<?=$firstname?>"  readonly="readonly"/></span>
    </div>

    <div class="form-group">
    <span class="text"><label>Email ID:</label></span>
    <span><input type="text" class="form-control" id="email" name="email" placeholder="Email ID" value="<?=$email?>"  readonly="readonly"/></span>
    </div>
    
    <div class="form-group">
    <span class="text"><label>Mobile/Cell Number:</label></span>
    <span><input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile/Cell Number" value="<?=$mobile?>"  readonly="readonly"/></span>
    </div>
    <div><input type="submit" value="Pay Rs. <?=$amount?>" class="form-control btn btn-info" onclick="submitPayuForm()"/></div>
    </form>
</div>
  </body>
</html>
