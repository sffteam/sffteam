<div class="page-content">
<?php 

$i = 1;
foreach($participants as $p){
 
 ?>
<div class="row Share sz1" style="border-bottom:1px solid">
 <div class="col-10" style="border-right:1px solid"><?=$i?></div>
 <div class="col-20" style="border-right:1px solid"><?=$p['mcaNumber']?></div>
 <div class="col-40" style="border-right:1px solid"><?=$p['Name']?></div>
 <div class="col-20" style="border-right:1px solid"><?php
 foreach($mobiles as $m){
  if($p['mcaNumber']===$m['mcaNumber']){
   $mobile =  $m['Mobile'];
   
  }
 }
 echo '<a class="link external" target="_blank" href="https://wa.me/?91'.trim($mobile).urlencode('?text=Mission%202L21%20Registration%20Link:%20https://sffteam/m2l21/event/').$p['mcaNumber'].'">'.$mobile.'</a>';
 ?></div>
 <div class="col-10" style="border-right:1px solid"><?=$p['Payment']?></div>
</div>
<?php 
$i++;
}?>

</div>