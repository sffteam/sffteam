<?php

//print_r($amount);
?>
<h1 class="borderTop">SFF -Savings</h1>
<div class="row" style="text-align:center;margin:0 auto">
 <div class="col-2">
  <img src="/img/indianeagles.team.logo.png" width="30px">
 </div>
 <div class="col">
  <h5>Rs. <?=number_format($amount)?></h5> 
 </div>
 <div class="col-2">
  <a href="/savings/information"><i class="fa fa-info fa-2x"></i></a>
 </div>
</div>


<div class="row" style="text-align:center;color:#fff;background-color:#000">
 <div class="col" style="width:auto;border-right:1px solid white">
 Deposit
 </div>
 <div class="col" style="width:auto;border-right:1px solid white">
 Yearly Get Products
 </div> 
 <div class="col" style="width:auto;">
 CashBack
 </div> 
</div>
<div class="row" style="text-align:center;color:#333;background-color:#fff;border-bottom:1px dotted gray">
 <div class="col" style="width:auto;border-right:1px dotted gray;background-color:#fcf">
 <?=number_format($amount)?>
 </div>
 <div class="col" style="width:auto;border-right:1px dotted gray;background-color:#C4EAC7">
 <?=number_format($amount*1.5)?>
 </div> 
 <div class="col" style="width:auto;;background-color:#C4EAC7">
 <?=number_format($amount*.1)?>
 </div> 
</div>


<p style="text-align:justify;padding-right:10px;padding-left:10px;line-height: 120%;">
<b>Example:</b> When you deposit Rs. <?=number_format($amount)?> with School of Financial Freedom, you will get monthly Rs. <?=number_format($amount*1.5/12)?> of products for 12 months from <b><a href="http://modicare.com" target="_blank">Modicare</a></b> as per its Aazadi Business Plan totaling to Rs. <?=number_format($amount*1.5)?> in a year and cash back 10% per annum in your bank account about Rs. <?=number_format($amount*.1)?> in one year.<br>
<span style="text-align:justify;line-height: 120%;font-size:11px">
<b><a href="/savings/sff">School of Financial Freedom</a></b> and <b><a href="/savings/sff">IndianEagles.Team</a></b> are sub-divisions of <b><a href="/savings/sff">Hitarth IT Services Pvt. Ltd.</a></b></span>
</p>

<div class="bottom">
 <div class="row" style="text-align:center;margin:0 auto">
 <div class="col">
   <a href="/savings/signin" 
    class="btn btn-sm btn-block btn-info">Sign In</a>
 </div>
  <div class="col">
   <a href="/savings/information" 
   class="btn btn-sm btn-block btn-info">Information</a>
  </div>
  <div class="col">
   <a href="/savings/register" 
   class="btn btn-sm btn btn-info">Register</a>
  </div>
 </div>
</div>