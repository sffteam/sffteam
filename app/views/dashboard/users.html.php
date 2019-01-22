<div class="container-fluid">
  <div class="row">
		<?php echo $this->_render('element', 'nav');?>	
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
      <div style="margin:auto">
      <?=$this->form->create('',array('url'=>'/dashboard/users')); ?>
      MCA Number:
      <input type="text" value="" id="mcaNumber" name="mcaNumber" class="form-control">
      MCA Name:
      <input type="text" value="" id="mcaName" name="mcaName" class="form-control">
      DateJoin:
      <input type="text" class="form-control" id="DateJoin" placeholder="1985-12-31" name="DateJoin" value="">
      Plan:
      <select name="Plan" id="Plan" class="form-control">
      <option value="0">--</option>
      <?php foreach($plans as $p){?>
       <option value="<?=$p['invoice']?>"><?=$p['invoice']*12?></option>
      <?php }?>
      </select>
      Sponsor:
      <select class="form-control" name="refer" id="refer">
      <?php foreach($users as $user){?>
      <option value="<?=$user['mcaNumber']?>" <?php if($sponsor==$user['mcaNumber']){echo " selected ";}?>><?=$user['mcaName']?> - <?=$user['mcaNumber']?></option>
      <?php }?>
      </select><br>
      <input type="submit" value="submit" class="form-control btn btn-primary">
      </form>
      </div>
      </main>
  </div>
</div>