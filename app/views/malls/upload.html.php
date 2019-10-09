<div class="row">
<div class="col-md-6">
<?=$this->form->create('',array('url'=>'/malls/upload', 'enctype'=>"multipart/form-data")); ?>
<br>
<?=$this->form->field('file', array('type' => 'file','label'=>'Products.csv', 'class'=>'form-control-file')); ?>
<br>
<input type="submit" name="submit" value="Submit" id="Submit" class="btn btn-primary">

</form>
</div>

<div class="col-md-6">
	<table class="table table-striped table-border">
	</table>
</div>
</div>