<div class="row" style="border-bottom:1px solid gray">
<div class="col-md-1">Code</div>
<div class="col-md-2">Category</div>
<div class="col-md-4">Name</div>
<div class="col-md-1">Quantity</div>
<div class="col-md-1">MRP</div>
<div class="col-md-1">DP</div>
<div class="col-md-1">BV</div>
<div class="col-md-1">Action</div>
</div>

<?php 
$code="";
$i=1;
foreach($products as $p){?>

<div class="row" style="border-bottom:1px solid gray">
<div class="col-md-1"><small><?=$i?>-<?=$p['code']?> <?php if($code==$p['code']){echo "<b>DDD</b>";}?></small></div>
<div class="col-md-2"><?=ucwords($p['category'])?></div>
<div class="col-md-4"><?=$p['name']?><img src="/img/products/<?=$p['code']?>.jpg" width="30"></div>
<div class="col-md-1">
<input class="form-check-input" type="checkbox" value="false" id="ST-<?=$p['code']?>" name="ST-<?=$p['code']?>" <?php if($p['stock']=="true"){echo " checked ";}?> onblur="change('stock',this.checked,this.id)">
<input type="tel" value="<?=$p['quantity']?>" name="QT-<?=$p['code']?>" id="QT-<?=$p['code']?>" class="form-control" min="0000" max="9999" onblur="change('quantity',this.value,this.id)">
</div>
<div class="col-md-1"><input type="tel" value="<?=$p['mrp']?>" name="MR-<?=$p['code']?>" id="MR-<?=$p['code']?>" class="form-control" min="0000" max="9999" onblur="change('mrp',this.value,this.id)"></div>
<div class="col-md-1"><input type="tel" value="<?=$p['dp']?>" name="DP-<?=$p['code']?>" id="DP-<?=$p['code']?>" class="form-control" min="0000" max="9999" onblur="change('dp',this.value,this.id)"></div>
<div class="col-md-1"><input type="tel" value="<?=$p['bv']?>" name="BV-<?=$p['code']?>" id="BV-<?=$p['code']?>" class="form-control" min="0000" max="9999" onblur="change('bv',this.value,this.id)"></div>
<div class="col-md-1"><a href="/dashboard/deleteproduct/<?=$p['_id']?>">Delete</a></div>

</div>
<?php
$i++;
 $code = $p['code'];?>
<?php }?>
