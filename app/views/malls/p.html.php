<div class="block page-content">
 <h1 class="Raleway sz1"><strong><?=$self['mcaName']?> - (<a href="/tree/index/<?=$self['mcaNumber']?>/<?=$yyyymm?>/d" class="external links" title="Open Tree Structure" target="_blank"><?=$self['mcaNumber']?></a>) <?=$self[$yyyymm]['PaidTitle']?> - <?=$self['DateJoin']?> <br><small>KYC: <?=$self['KYC']?>, NEFT: <?=$self['NEFT']?></small></strong></h1>


<div class="row">
 <div class="col-80">
  <h2>Products</h2>
  <?php
     foreach($Categories as $key=>$val){
      if($category==$key){
   ?>
   <h1><?=$val?></h1>
   <?php
     }}
   ?>
  <table border=0 cellspacing=0 cellpadding=2  class="Roboto szhalf">
   <tr>
    <th class="tdw5 top left">#</th>
    <th class=" top left">Image</th>
    <th class="tdw10 top left">Code</th>
    <th class="tdw50 top left text-align-left">Name</th>
    <th class="tdw10 top left">MRP</th>
    <th class="tdw10 top left">DP</th>
    <th class="tdw10 top left">BV</th>
    <th class="tdw10 top left">DP/BV</th>
    <th class="tdw10 top left">PV</th>
    <th class="tdw10 top left">Weight</th>
    <th class="tdw10 top left right">Save</th>
   </tr>
   <tr>
    <th class="tdw5 top left"></th>
    <th class=" top left"></th>
    <th class="tdw10 top left"></th>
    <th class="tdw50 top left text-align-left"><a href="#" data-sheet=".cart-sheet" onclick="return sendCart();" class="sheet-open color-white external link">Cart <span class="material-icons color-white">add_shopping_cart</span><span id="CartFill" class="badge color-white text-color-black"></span></a></th>
    <th class="tdw10 top left" id="tMRP">11</th>
    <th class="tdw10 top left" id="tDP"></th>
    <th class="tdw10 top left" id="tBV"></th>
    <th class="tdw10 top left" id="tRatio"></th>
    <th class="tdw10 top left" id="tPV"></th>
    <th class="tdw10 top left" id="tWt"></th>
    <th class="tdw10 top left right" id="tSave"></th>
   </tr>
   <?php
    $i = 1;
     foreach($AllProducts as $p){
   ?>
   <tr>
    <td class="top left bottom"><?=$i?></td>
    <td class="top left bottom"><img src="/img/products/<?=$p['Code']?>.jpg" width="50"/></td>
    <td class="top left bottom"><?=$p['Code']?></td>
    <td class="top left bottom text-align-left"><?=$p['Name']?>
     <div class="row" style="width:100px">
      <div class="col-33"><span class="material-icons sz1"><a href="#" class=" text-color-red external link"  onclick="minustoCart('<?=$p['Code']?>');">remove</a></span></div>
      <div class="col-33 text-align-center text-color-blue szhalf"><input type="text" name="minusCode<?=$p['Code']?>" id="minusCode<?=$p['Code']?>" size="2" readonly/></div>
      <div class="col-33"><span class="material-icons sz1"><a href="#" class=" text-color-green external link" onclick="addtoCart('<?=$p['Code']?>');" >add</a></span></div>
    </div>
</td>
    <td class="top left bottom" ><?=number_format($p['MRP'],0)?></td>
    <td class="top left bottom" ><?=number_format($p['DP'],0)?></td>
    <td class="top left bottom" ><?=number_format($p['BV'],1)?></td>
    <td class="top left bottom" ><?=number_format($p['BV']/$p['DP']*100,0)?>%</td>
    <td class="top left bottom" ><?=number_format($p['PV'],1)?></td>
    <td class="top left bottom" ><?=number_format($p['Weight'],0)?></td>
    <td class="top left right bottom" ><?=number_format($p['Saving'],0)?></td>
   </tr>
   <?php
    $i++;
     }
   ?>
  </table>
 </div>
 <div class="col-20">
  <h2>Categories</h2>
  <div class="list simple-list">
   <ul>
   <?php
     foreach($Categories as $key=>$val){
   ?>
    <li><a href="/malls/p/<?=$key?>/<?=$self['mcaNumber']?>" class="external link color-black"><?=$val?></a></li>
   <?php
     }
   ?>
   </ul>
 </div>
 </div>
</div>

  <div class="sheet-modal cart-sheet">
    <div class="toolbar">
      <div class="toolbar-inner">
        <div class="left"></div>
        <div class="right"><a class="link sheet-close" href="#">Done</a></div>
      </div>
    </div>
    <div class="sheet-modal-inner">
      <div class="block">
        <h4>Info</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ac diam ac quam euismod porta vel a
          nunc. Quisque sodales scelerisque est, at porta justo cursus ac.</p>
      </div>
    </div>
  </div>

<br>
<hr>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<br>
<hr>
</div>