<div class="row">
<div class="col-2">
<ul>
	<?php foreach ($products as $p){?>
	<li><a href="/malls/show/<?=$p['Code']?>"><?=$p['Code']?>-<?=is_null($p['Description'])?></a>
	<?=$p['Name']?></li>
	<?php	}	?>
	</ul>
</div>	
<div class="col-10">
<?=$product['Code']?> - 
<?=$product['Name']?>

	<script src="//cdn.ckeditor.com/4.5.11/full/ckeditor.js"></script>
		<?=$this->form->create(null,array('class'=>'form-group','id'=>'Product',)); ?>
		<textarea name="Description" cols="60" rows="4" class="ckeditor"><?=$product['Description']?></textarea>
		Gujarati
		<textarea name="g_Description" cols="60" rows="4" class="ckeditor"><?=$product['g_Description']?></textarea>
		Hindi
		<textarea name="h_Description" cols="60" rows="4" class="ckeditor"><?=$product['h_Description']?></textarea>
		<br>
		Video:
		<input type="text" name="Video" id="Video" class="form-control" value="<?=$product['Video']?>">
		<input type="hidden" name="Code" id="Code" value="<?=$product['Code']?>">
		<input type="button" value="Save" class="form-control btn btn-primary" onclick="$('#Product').submit();">
		</form>
		</div>
</div>