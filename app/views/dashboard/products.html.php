<div class="container">
<div style="">
  <div class="row">
    <div style="width:50%"><h4>Categories</h4></div>
    <div style="width:50%"><h4>Products</h4></div>
  </div>
</div>
<div class="row">
  <div class="list-group col-3">
  <?php foreach($allcategories as $c){?>
    <a href="/dashboard/products/<?=urlencode($c['name'])?>"><?=ucwords($c['name'])?> (<?=$c['count']?>)</a>
  <?php }?>
  </div>
  <div class="list-group col-9" >
  <?php $x=1;foreach($allproducts as $p){?>
  <a href="/dashboard/product/<?=urlencode($p['code'])?>"><?=urlencode($p['code'])?>: <?=ucwords($p['name'])?></a> MRP: <?=$p['mrp']?> Size: <?=$p['size']?>
  <form id="Form<?=$x?>">
  <input type="hidden" name="code" id="code" value="<?=urlencode($p['code'])?>">
  <div class="form-group row" style="border-bottom:2px solid gray;padding-bottom:5px">
  <input class="form-check-input" type="checkbox" value="false" id="stock" name="stock" <?php if($p['stock']=="true"){echo " checked ";}?>">
   <label class="form-check-label" for="stock">
    Stock
  </label>

  <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
  <input type="text" name="quantity" id="quantity" class="form-control col-1" value="<?=$p['quantity']?>" >
  
  <label for="discount" class="col-sm-2 col-form-label">Discount</label>
  <input type="text" name="discount" id="discount" class="form-control col-1" value="<?=$p['discount']?>" >
  <label for="discountType" class="col-sm-2 col-form-label">Discount Type</label>
  <select name="discountType" id="discountType">
  <option value="-" <?php if($p['discountType']=="-"){echo " selected ";}?>>-</option>
   <option value="Rs" <?php if($p['discountType']=="Rs"){echo " selected ";}?>>Rs</option>
   <option value="Percent" <?php if($p['discountType']=="Percent"){echo " selected ";}?>>Percent</option>
  </select>
  &nbsp;<input type="button" value="Save" class="btn btn-primary btn-sm" onclick="productSave(this.form.code.value,this.form.discount.value,this.form.discountType.value,this.form.stock.checked,this.form.quantity.value,);">
  </div>
  <img src="/img/products/<?=$p['code']?>.jpg" width="60"/>
  </form>
  <?php $x++;}?>
  </div>
  
  
  
</div>

</div>