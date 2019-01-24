<div class="container-fluid">
  <div class="row">
		<?php echo $this->_render('element', 'nav');?>	
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
      <div style="margin:auto">
      <?=$this->form->create('',array('url'=>'/dashboard/updateUser')); ?>
      MCA Number:
      <input type="text"  id="mcaNumber" name="mcaNumber" class="form-control" value="<?=$mcaNumber?>">
      Plan:
      <select name="Plan" id="Plan" class="form-control">
      <option value="0">--</option>
      <?php foreach($plans as $p){?>
       <option value="<?=$p['invoice']?>"><?=$p['invoice']*12?></option>
      <?php }?>
      </select>
      <br>
      <input type="submit" value="submit" class="form-control btn btn-primary">
      </form>
      </div>
      </main>
  </div>
</div>