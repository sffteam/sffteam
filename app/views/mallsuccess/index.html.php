<div class="navbar">
	<div class="navbar-bg"></div>
	<div class="navbar-inner">
		<div class="title">Payment Done</div>
		<div class="right">
		<!-- Link to close popup -->
			<a href="/" class="link popup-close text-color-red"><strong>Home</strong></a>
		</div>
	</div>
</div>
<div class="container">
	<div  style="text-align:center">
     <div style="text-align:center">
    	<h4>Payment to Hitarth IT Services Pvt. Ltd. for SFF-Mall</h4>
     <h6>through</h6>
    </div>
    	<img src="/payumoney/images/payumoney.png" alt="PayUMoney" text="PayUMoney"/>
    </div>
    <div style="text-align:center">
    	<h4>Transaction of Rs. <?=number_format($postdata['amount'])?></h4>
    </div>

     <div class="form-group">
     <span class="text"><label>Transaction ID:</label></span>
     <input type="text" class="form-control" id="txnid" name="txnid"  placeholder="Transaction ID" value="<?=$postdata['txnid']?>" readonly="readonly"/>
     </div>
     <?php if($postdata['status']=="success"){?>
     <h4>Success!</h4>
     <?php }else{?>
     <h4>Failed!</h4>
     <?php }?>
     <a href="#" class="btn btn-small btn-primary btn-block" onclick="return window.close();">Close the App - SFF-Mall</a>
</div>