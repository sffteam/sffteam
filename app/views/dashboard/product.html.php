<div class="container" style="margin-top:30px">

<div style="">
  <div class="row">
    <div class="col-3"><h4>Categories</h4></div>
    <div class="col-9"><h4><?=$product['name']?></h4></div>
  </div>
</div>
<div class="row">
  <div class="list-group col-3">
  <?php foreach($allcategories as $c){?>
    <a href="/dashboard/products/<?=urlencode($c['name'])?>"><?=ucwords($c['name'])?> (<?=$c['count']?>)</a>
  <?php }?>
  </div>
  <div class="list-group col-9">
    <h6><?=ucwords($product['name'])?> - <?=$product['code']?></h6>
    <table class="table">
    <tr>
     <td width="50%"><img src="/img/products/<?=urlencode($product['code'])?>.jpg" width="90%"></td>
     <td width="50%" style="text-align:justify">Description:<?php echo $product['description']?></td>

    </tr>
    <tr>
     <td>MRP: Rs.<?=number_format($product['mrp'],2)?> - Size: <?=$product['size']?></td>
     <td></td>
    </tr>
    </table>
     
  
  </div>
</div>

 <div class="row">
 <div class="col-10">
 	<script src="//cdn.ckeditor.com/4.5.11/full/ckeditor.js"></script>
		<?=$this->form->create(null,array('class'=>'form-group','id'=>'Product',)); ?>
		<textarea name="description" cols="60" rows="4" class="ckeditor"><?=$product['description']?></textarea>
		<br>
		Video:
		<input type="text" name="video" id="video" class="form-control" value="<?=$product['video']?>">
		<input type="hidden" name="code" id="code" value="<?=$product['code']?>">
		<input type="button" value="Save" class="form-control btn btn-primary" onclick="$('#Product').submit();">
		</form>

 </div>
 </div>
 
</div>