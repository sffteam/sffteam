<div class="page-content">
<?php 

$i = 1;
foreach($participants as $p){
 
 ?>
<div class="row Share sz1">
<div class="col"><?=$i?></div>
 <div class="col"><?=$p['mcaNumber']?></div>
 <div class="col"><?=$p['Name']?></div>
 <div class="col"><?php
 foreach($mobiles as $m){
  if($p['mcaNumber']===$m['mcaNumber']){
   $mobile =  $m['Mobile'];
   
  }
 }
 echo '<a class="link external" target="_blank" href="https://wa.me/?91'.trim($mobile).'?text=Mission%202L21%20Registration%20Link:%20https://sffteam/m2l21/event/'.$p['mcaNumber'].'">'.$mobile.'</a>';
 ?></div>
 <div class="col"><?=$p['Payment']?></div>
</div>
<?php 
$i++;
}?>

</div>