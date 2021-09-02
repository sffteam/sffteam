<div class="block sz1">
<?php foreach($trainings as $key=>$val){?>
<div class="row">
	<div class="col">
<a href="/mca/certificates/<?=urlencode($val['training'])?>" class="external link"><?=$val['training']?> <?=$val['date']?></a>
</div>
</div>
<?php }?>
</div>

<div class="block sz1">
<?php $i = 1;foreach($participants as $key=>$val){?>
<div class="row">
	<div class="col">
<a href="/app/webroot/img/certificates/<?=str_replace(' ','_',$val['commando'])?>_Page_<?=str_pad($i,3,'0',STR_PAD_LEFT)?>.jpg" class="external link"><?=$val['Name']?></a>
</div>
</div>
<?php $i++;}?>
</div>

