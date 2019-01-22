<?php

$key = PAYUMONEY_KEY;
$txnid = "TXN-" . rand(10000,99999999);
$amount = substr($data->shopping,1);
$productinfo = $data->mcaNumber.'-'.$data->shopping;
$firstname = $data->name;
$email = $data->email;
$mobile = $data->mobile;
$udf5 = "BOLT_KIT_PHP7";
$salt = PAYUMONEY_SALT;

		$hash=strtolower(hash('sha512', $key.'|'.$txnid.'|'.$amount.'|'.$productinfo.'|'.$firstname.'|'.$email.'|||||'.$udf5.'||||||'.$salt));
//            sha512(  key | txnid | amount | productinfo | firstname | email |udf1|udf2|udf3|udf4|udf5 ||||||salt)              
 function getCallbackUrl()
{
	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	return $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . 'response.php';
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>School of Financial Freedom - Payment</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<link href="/css/bootstrap.css" rel="stylesheet">

<!-- this meta viewport is required for BOLT //-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" >
<!-- BOLT Sandbox/test //-->
<script id="bolt" src="https://sboxcheckout-static.citruspay.com/bolt/run/bolt.min.js" bolt-
color="e34524" bolt-logo="http://boltiswatching.com/wp-content/uploads/2015/09/Bolt-Logo-e14421724859591.png"></script>
<!-- BOLT Production/Live //-->
<!--// script id="bolt" src="https://checkout-static.citruspay.com/bolt/run/bolt.min.js" bolt-color="e34524" bolt-logo="http://boltiswatching.com/wp-content/uploads/2015/09/Bolt-Logo-e14421724859591.png"></script //-->
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
	<form action="#" id="payment_form" class="form">
    <input type="hidden" id="udf5" name="udf5" value="<?=$udf5?>" />
    <input type="hidden" id="service_provider" name="service_provider" value="payu_paisa" />
    <input type="hidden" id="surl" name="surl" value="https://sff.team/success" />
    <input type="hidden" id="furl" name="furl" value="https://sff.team/success" />
    <input type="hidden" id="key"  name="key" placeholder="Merchant Key" value="<?=$key?>" />
    <input type="hidden" id="salt" name="salt" placeholder="Merchant Salt" value="<?=$salt?>" />

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
    
    <div class="dv">
     <span><input type="hidden" id="hash" name="hash" placeholder="Hash" value="<?=$hash?>" /></span>
    </div>
    
    
    <div><input type="submit"  class="form-control btn btn-info" value="Pay" onclick="launchBOLT(); return false;" /></div>
	</form>
 <p> Please do not press Refresh / Back button on your app till the payment is successfull.</p>
 <p> &nbsp;</p>
</div>
<script type="text/javascript"><!--
$('#payment_form').bind('keyup blur', function(){
console.log($('#key').val());
	$.ajax({
    url: '/success/payment/',
    type: 'post',
    data: JSON.stringify({ 
      key: $('#key').val(),
      salt: $('#salt').val(),
      txnid: $('#txnid').val(),
      amount: $('#amount').val(),
      productinfo: $('#productinfo').val(),
      firstname: $('#firstname').val(),
      email: $('#email').val(),
      mobile: $('#mobile').val(),
      udf5: $('#udf5').val()
    }),
    contentType: "application/json",
    dataType: 'json',
    success: function(json) {
      if (json['error']) {
        $('#alertinfo').html('<i class="fa fa-info-circle"></i>'+json['error']);
      }
      else if (json['success']) {	
        $('#hash').val(json['success']);
      }
    }
  }); 
});
//-->
</script>
<script type="text/javascript"><!--
function launchBOLT()
{
	bolt.launch({
	key: $('#key').val(),
	txnid: $('#txnid').val(), 
	hash: $('#hash').val(),
	amount: $('#amount').val(),
	firstname: $('#firstname').val(),
	email: $('#email').val(),
	phone: $('#mobile').val(),
	productinfo: $('#productinfo').val(),
	udf5: $('#udf5').val(),
	surl : $('#surl').val(),
	furl: $('#surl').val(),
	mode: 'dropout'	
},{ responseHandler: function(BOLT){
	console.log( BOLT.response.txnStatus );		
	if(BOLT.response.txnStatus != 'CANCEL')
	{
		//Salt is passd here for demo purpose only. For practical use keep salt at server side only.
		var fr = '<form action=\"'+$('#surl').val()+'\" method=\"post\">' +
		'<input type=\"hidden\" name=\"key\" value=\"'+BOLT.response.key+'\" />' +
		'<input type=\"hidden\" name=\"salt\" value=\"'+$('#salt').val()+'\" />' +
		'<input type=\"hidden\" name=\"txnid\" value=\"'+BOLT.response.txnid+'\" />' +
		'<input type=\"hidden\" name=\"amount\" value=\"'+BOLT.response.amount+'\" />' +
		'<input type=\"hidden\" name=\"productinfo\" value=\"'+BOLT.response.productinfo+'\" />' +
		'<input type=\"hidden\" name=\"firstname\" value=\"'+BOLT.response.firstname+'\" />' +
		'<input type=\"hidden\" name=\"email\" value=\"'+BOLT.response.email+'\" />' +
		'<input type=\"hidden\" name=\"udf5\" value=\"'+BOLT.response.udf5+'\" />' +
		'<input type=\"hidden\" name=\"mihpayid\" value=\"'+BOLT.response.mihpayid+'\" />' +
		'<input type=\"hidden\" name=\"status\" value=\"'+BOLT.response.status+'\" />' +
		'<input type=\"hidden\" name=\"hash\" value=\"'+BOLT.response.hash+'\" />' +
		'</form>';
		var form = jQuery(fr);
		jQuery('body').append(form);								
		form.submit();
	}
},
	catchException: function(BOLT){
 		alert( BOLT.message );
	}
});
}
//--
</script>	

</body>
</html>
	
