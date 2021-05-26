<div class="navbar">
  <div class="navbar-bg"></div>
  <div class="navbar-inner sliding">
    <div class="title">Products</div>
  </div>
</div>
<div class="row">
<?php
foreach($AllProducts as $p){
 ?>
 <div class="col-50" style="border:1px solid black;margin:2px;padding:2px; ">
 <a href="#" ><img src="https://sff.team/img/products/<?=$p['Code']?>.jpg" sizes="100vw" \
    srcset="https://sff.team/img/products/<?=$p['Code']?>_100.jpg 100w, https://sff.team/img/products/<?=$p['Code']?>_200.jpg 200w, https://sff.team/img/products/<?=$p['Code']?>_400.jpg 400w," class="lazy lazy-fade-in demo-lazy"/></a>
    <p class="Raleway sz1"><?=$p['Code']?>: <strong><?=ucwords($p['Name'])?></strong>
    <br><strike style="color:red">MRP: ₹<?=number_format($p['MRP'],1)?></strike> 
    <strong style="color:green">DP: ₹<?=number_format($p['DP'],1)?></strong> 
    <strong style="color:blue">BV: <?=number_format($p['BV'],1)?></strong>
    <strong style="color:red">PV: <?=number_format($p['PV'],1)?></strong>
    </p>
    <p class="sz1 Bebas">Cost after FREE gift: ₹<?=number_format($p['DP']-$p['DP']*10/100,1)?></p>
    <p class="sz1 Bebas">Cost after 1 Year Loyalty: ₹<?=number_format($p['DP']-$p['DP']*25/100-$p['DP']*10/100,1)?></p>
    <p class="sz2 Bebas">Savings: ₹<?=number_format($p['DP']-($p['DP']-$p['DP']*25/100-$p['DP']*10/100),1)?></p>
 </div>
 <?php continue;?>
 <div class="col-50" style="border:1px solid black;margin:2px;padding:2px; ">
 <a href="#" ><img src="https://sff.team/img/products/<?=$p['Code']?>.jpg" sizes="100vw" \
    srcset="https://sff.team/img/products/<?=$p['Code']?>_100.jpg 100w, https://sff.team/img/products/<?=$p['Code']?>_200.jpg 200w, https://sff.team/img/products/<?=$p['Code']?>_400.jpg 400w," class="lazy lazy-fade-in demo-lazy"/></a>
    <p class="Raleway sz1"><?=$p['Code']?>: <strong><?=ucwords($p['Name'])?></strong>
    <br><strike style="color:red">MRP: <?=number_format($p['MRP'],1)?></strike> 
    <strong style="color:green">DP: <?=number_format($p['DP'],1)?></strong> 
    <strong style="color:blue">BV: <?=number_format($p['BV'],1)?></strong>
    <strong style="color:red">PV: <?=number_format($p['PV'],1)?></strong>
    </p>
    <p class="sz1 Bebas">Cost after FREE gift: ₹<?=number_format($p['DP']-$p['DP']*10/100,1)?></p>
    <p class="sz1 Bebas">Cost after 1 Year Loyalty: ₹<?=number_format($p['DP']-$p['DP']*25/100-$p['DP']*10/100,1)?></p>
    <p class="sz2 Bebas">Savings: ₹<?=number_format($p['DP']-($p['DP']-$p['DP']*25/100-$p['DP']*10/100),1)?></p>
 </div>
<?php
}
?>
</div>