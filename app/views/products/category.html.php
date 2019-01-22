<div class="container" style="margin-top:30px">

<div style="">
  <div class="row">
    <div style="width:50%"><h4>Categories</h4></div>
    <div style="width:50%"><h4>Products</h4></div>
  </div>
</div>
<div class="row">
  <div class="list-group col-3">
  <?php foreach($allcategories as $c){?>
    <a href="/products/category/<?=urlencode($c['Name'])?>"><?=ucwords($c['Name'])?> (<?=$c['count']?>)</a>
  <?php }?>
  </div>
  <div class="list-group col-9">
  <?php foreach($products as $p){?>
    <a href="/products/product/<?=urlencode($p['code'])?>"><?=ucwords($p['name'])?></a> MRP: <?=$p['mrp']?> Size: <?=$p['size']?>
  <?php }?>
  </div>
</div>
 
</div>