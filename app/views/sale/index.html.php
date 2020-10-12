<div class="page-content">
 <div class="block">
  
 </div>

<div class="block bg-color-pink">
 <h1 class="sz3b text-align-center">Diwali Sale</h1>
</div>
<div class="block" style="background: url('/img/diwali.jpg') no-repeat center center fixed;   background-repeat: no-repeat;
    background-size: 100% auto;
    background-position: center top;
    background-attachment: fixed;">
 <h1 class="sz4b Share text-align-center text-color-white padding" style="text-shadow: 2px 2px #000000;">Brought to you by<br><?=$mobile['mcaName']?><br>Call/WhatsApp: +91<?=$mobile['Mobile']?></h1>
</div>
 
   <h2 class="sz3 bg-color-gray text-color-black text-align-center"><a class="external text-color-black" href="/sale/index/all/<?=$mobile['mcaNumber']?>">Categories All</a></h2>
   
    <div class="row responsive block">
    <?php foreach($CategoriesArray as $ca=>$val){?>
     <div class=" col-50 Share sz1 " style="margin-bottom:5px;border-bottom:1px dotted black"><a style="color-black" class="external" href="/sale/index/<?=$ca?>/<?=$mobile['mcaNumber']?>"><?=$val?></a></div>
    <?php }?>
    </div>
 

<?php foreach($tuy as $t){?>
 <h1 class="sz3 bg-color-black text-color-white text-align-center"><?=$t?></h1>
 <div class="block">products</div>
<?php } ?>

</div>

