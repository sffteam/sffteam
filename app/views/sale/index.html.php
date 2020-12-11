<div class="page-content">
 <div class="block">
  
 </div>

<div class="block bg-color-pink">
 <h1 class="sz3b text-align-center">Buy - Save - Earn</h1>
</div>
<div class="block" style="background: url('/img/diwali.jpg') no-repeat center center fixed;   background-repeat: no-repeat;
    background-size: 100% auto;
    background-position: center top;
    background-attachment: fixed;">
 <h1 class="sz1b Share text-align-left text-color-white padding" style="text-shadow: 2px 2px #000000;"><br>Brought to you by<br><?=$mobile['mcaName']?><br>Call/WhatsApp:<br>+91<?=$mobile['Mobile']?><br><br></h1>
</div>
 
   <h2 class="sz3 bg-color-gray text-color-black text-align-center"><a class="external text-color-black" href="/sale/index/all/<?=$mobile['mcaNumber']?>/<?=$price?>">Categories All</a></h2>
   
    <div class="row responsive block">
    <?php foreach($CategoriesArray as $ca=>$val){?>
     <div class=" col-50 Share sz1 " style="margin-bottom:5px;border-bottom:1px dotted black"><a style="color-black" class="external" href="/sale/index/<?=$ca?>/<?=$mobile['mcaNumber']?>/<?=$price?>"><?=$val?></a></div>
    <?php }?>
    </div>
    <div class="row responsive block">
    <div class=" col-50 Share sz1 bg-color-lightblue" style="margin-bottom:5px;border-bottom:1px dotted black"> <strong><a href="#FreeGifts" class="text-color-black">Free Gifts</a></strong>
    </div>
    <div class=" col-50 Share sz1 bg-color-pink" style="margin-bottom:5px;border-bottom:1px dotted black"> <strong><a href="#Loyalty" class="text-color-black">Loyalty</a></strong>
    </div>
    </div>
    
<?php foreach($tuy as $t){?>
 <h1 class="sz3 bg-color-black text-color-white text-align-center"><?=$t?></h1>
 <div class="block">
 <?php foreach($products as $p){?>
 <?php if($t==$p['TUYName']){?>
 <div class="row " style="border-bottom:1px dotted gray">
  <div class="col-100">
   <div class="row">
    <div class="col-25 sz11b"><?=$p['Code']?></div>
    
    <?php if(strtolower($price)!='mrp'){?>
    <div class="col-25 sz11 text-color-red"><strike>Rs: <?=number_format($p['MRP'],1)?></strike></div>
    <div class="col-25 sz11 text-color-black">DP: <?=number_format($p['DP'],1)?></div>
    
    <div class="col-25 sz10 text-align-right text-color-white bg-color-red" style="padding-right:2px">Save <?=number_format($p['Saving'],2)?></div>
   <?php }else{?>
   <div class="col-25 sz11b text-color-red">Rs: <?=number_format($p['MRP'],1)?></div>
   <?php }?>
    <div class="col-100 sz12"><?=$p['Name']?></div>
   
    <div class="col-100 text-align-center">
      <img src="/img/products/<?=$p['Code']?>_400.jpg" alt="<?=$p['Code']?>">
    </div>
    <?php if(strtolower($price)!='mrp'){?>
    <div class="col-50 sz11 text-align-center">
       <div class="bg-color-green text-align-center" style="padding:1px;width:100%"><?=$p['SavingPercent']?>% Savings on MRP</div>
       <div class="bg-color-blue text-align-center"  style="padding:1px;width:100%"><?=$p['Percent']?>% DP/BV</div>
       <?php if($p['BuyInLoyalty']=="Yes"){?>
        <div class="bg-color-pink text-align-center"  style="padding:1px;width:100%"><?=$p['BuyInLoyalty']?> Buy in Loyalty</div>
       <?php }else{?>
        <div class="bg-color-orange text-align-center"  style="padding:1px;width:100%"><?=$p['BuyInLoyalty']?> High DP/BV</div>
       <?php }?>
       <div class=" bg-color-black text-align-center text-color-white"   style="padding:1px;width:100%"><?=$p['BV']?> BV</div>
       <div class=" bg-color-lightblue text-align-center color-black"  style="padding:1px;width:100%"><?=$p['PV']?> PV</div>
       </div>
    <?php }?>
    </div>
  </div>
  </div>
 <?php }?>
 <?php }?>
 </div>
<?php } ?>
 
 </div>
 <div id="FreeGifts" class="bg-color-lightblue">
 <h1 class="sz3 bg-color-black text-color-white text-align-center">Free Gifts</h1>
 
 </div>
 <div id="Loyalty" class="bg-color-pink">
 <h1 class="sz3 bg-color-black text-color-white text-align-center">Loyalty</h1>
 </div>

