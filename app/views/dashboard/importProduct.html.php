<div class="row">
<div class="col-md-6">
<?=$this->form->create('',array('url'=>'/dashboard/importProduct', 'enctype'=>"multipart/form-data")); ?>
<br>
<?=$this->form->field('file', array('type' => 'file','label'=>'product.csv', 'class'=>'form-control-file')); ?>
<br>

<input type="submit" name="submit" value="Submit" id="Submit" class="btn btn-primary">

</form>
</div>
