<div class="row">
<div class="col-md-6">
<?=$this->form->create('',array('url'=>'/x/index', 'enctype'=>"multipart/form-data")); ?>
<br>
<?=$this->form->field('text', array('type' => 'type','label'=>'URL to shorten', 'id'=>"Text",'class'=>'form-control-file')); ?>
<br>

<input type="submit" name="submit" value="Submit" id="Submit" class="btn btn-primary">

</form>
</div>

<div class="col-md-6">
	<table class="table table-striped table-border">
  ShortURL: https://sff.team/x/go/<?=$shortURL?>
	</table>
</div>
</div>
