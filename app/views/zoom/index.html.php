<?php 

?>
<div class="row text-align-center">
<div class="col-md-3"></div>
<div class="col-md-6">

<?=$this->form->create('',array('url'=>'/zoom/index', 'enctype'=>"multipart/form-data")); ?>

<input type="text" id="yyyymm" name="yyyymm" value="<?=gmdate('Y-m',time())?>" class="form-control">
<input type="submit" name="submit" value="Submit" id="Submit" class="btn btn-primary">

</form>
</div>
<div class="col-md-3"></div>
</div>