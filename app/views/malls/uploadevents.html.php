<div class="row">
<div class="col-md-6">
<?=$this->form->create('',array('url'=>'/malls/uploadevents', 'enctype'=>"multipart/form-data")); ?>
<br>
<?=$this->form->field('file', array('type' => 'file','label'=>'BV.csv', 'id'=>"FileName",'onblur'=>'changeYear()','class'=>'form-control-file')); ?>
<br>
<input type="text" id="yyyymm" name="yyyymm" value="<?=gmdate('Y-m',time())?>" class="form-control">
<input type="submit" name="submit" value="Submit" id="Submit" class="btn btn-primary">
Remove  –  from data
</form>
</div>

<div class="col-md-6">
	<table class="table table-striped table-border">
	</table>
</div>
</div>
<script>
function changeYear(){
	var FileNameSelected = document.getElementById("FileName").value;
	console.log(FileNameSelected.substring(12,19));
	document.getElementById("yyyymm").value = FileNameSelected.substring(12,19);
}
</script>