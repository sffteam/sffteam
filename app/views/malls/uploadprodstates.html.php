<div class="row">
<div class="col-md-6">
<?=$this->form->create('',array('url'=>'/malls/uploadprodstates', 'enctype'=>"multipart/form-data")); ?>
<br>
<?=$this->form->field('file', array('type' => 'file','label'=>'All-Products-State.csv', 'id'=>"FileName",onblur=>"changeYear()",'class'=>'form-control-file')); ?>
<br>
<input type="text" id="State" name="State" value="" class="form-control">
<input type="submit" name="submit" value="Submit" id="Submit" class="btn btn-primary">

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
	console.log(FileNameSelected);
	document.getElementById("State").value = FileNameSelected.substring(25);
}
</script>