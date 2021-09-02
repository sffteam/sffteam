<div class="navbar">
  <div class="navbar-bg bg-color-black"></div>
  <div class="navbar-inner sliding">
    <a href="/mca/" class="external link text-color-white">Home</a>
    <a href="/mca/reports/" class="external link text-color-white">Reports</a>
    <a href="/mca/pdfs/" class="external link text-color-white">PDFs</a>
    <a href="/mca/products/categories/" class="external link text-color-white">Products</a>
    <a href="/mca/videos/" class="external link text-color-white">Videos</a>
  </div>
</div>
<?php
if($AllProducts==null || $AllProducts ==""){
 ?>
 <div class="block-title Bebas sz3">Categories</div>
      <div class="list links-list">
        <ul>
        <?php
         foreach($Categories as $key=>$val){
        ?>
          <li><a href="/mca/products/<?=$key?>/" class="external link"><?=$val?></a></li>
        <?php
         }
        ?>
        </ul>
        <br>
      </div>
 <?php
}
?>
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
    <strong style="color:green"><?=number_format($p['BV']/$p['DP']*100,0)?>%</strong><br>
    <strong>Weight: <?=number_format($p['Weight'],1)?> grams (GROSS) - For net weight deduct 10% / packaging</strong>
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
    <strong style="color:green"><?=number_format($p['BV']/$p['DP']*100,0)?>%</strong>
    </p>
    <p class="sz1 Bebas">Cost after FREE gift: ₹<?=number_format($p['DP']-$p['DP']*10/100,1)?></p>
    <p class="sz1 Bebas">Cost after 1 Year Loyalty: ₹<?=number_format($p['DP']-$p['DP']*25/100-$p['DP']*10/100,1)?></p>
    <p class="sz2 Bebas">Savings: ₹<?=number_format($p['DP']-($p['DP']-$p['DP']*25/100-$p['DP']*10/100),1)?></p>
 </div>
<?php
}
?>
</div>