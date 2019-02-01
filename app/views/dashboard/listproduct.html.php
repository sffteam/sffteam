<?php 
$code="";
foreach($products as $p){?>

<div class="row" style="border-bottom:1px solid gray">
<div class="col-md-1"><?=$p['code']?><?php if($code==$p['code']){echo "<b>XXX</b>";}?></div>
<div class="col-md-2"><?=$p['category']?></div>
<div class="col-md-5"><?=$p['name']?></div>
<div class="col-md-1"><?=$p['mrp']?></div>
<div class="col-md-1"><?=$p['dp']?></div>
<div class="col-md-1"><?=$p['bv']?></div>
<div class="col-md-1"><a href="/dashboard/deleteproduct/<?=$p['_id']?>">Delete</a></div>

</div>
<?php $code = $p['code'];?>
<?php }?>
