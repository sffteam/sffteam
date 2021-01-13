
<script src="/js/qrcode.js"></script>
<div class="row block">
 <div class="col-100">
  <img src="/img/TUY-inAction.jpg" width="100vw">
 </div>
 <div class="col-100">
  <p class="text-align-center sz1"><?=$user['mcaName']?></p>
  <p class="text-align-center sz1"><?=$user['mcaNumber']?></p>
 </div>
 <div id="recQRMobile" class="col-100 text-align-center">
 </div>
 <div id="recAmount" class="col-100 text-align-center">
 </div>
  <div class="col-100">
  <img src="/img/TUY-Mission.jpg" width="100vw">
  
 </div>
</div>

<?php if($amount['Payment']>0){?>
<script>

 var qrCode = qrcode(6, 'L');
 var text = "Name: " + "<?=$user['mcaName']?>" + " MCA: " + "<?=$user['mcaNumber']?>";
 text = text.replace(/^[\s\u3000]+|[\s\u3000]+$/g, '');
 qrCode.addData(text);
 qrCode.make();
 var amount = "Rs. " + "<?=$amount['Payment']?>";
 $$('#recQRMobile').html(qrCode.createImgTag(4));
 $$('#recAmount').html("<span class='sz3'><strong>Rs. <?=$amount['Payment']?></strong></span>");
</script>
<?php }else{?>
<script>
$$('#recQRMobile').html("<span class='sz2'>No Payment Received</span>");
</script>
<?php }?>