<div class="container">

<div style="">
  <div class="row">
    <div style="width:50%"><h4>Categories</h4></div>
    <div style="width:50%"></div>
  </div>
</div>
<div class="row">
  <div class="list-group">
  <?php foreach($allcategories as $c){?>
    <a href="/products/category/<?=urlencode($c['Name'])?>" style="width:100%"><?=ucwords($c['Name'])?> (<?=$c['count']?>)</a>
  <?php }?>
  </div>
</div>
 
</div>