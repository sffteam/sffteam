<?php
  $yyyymm = date("Y-m", strtotime(-1 ." month", strtotime(date("F") . "1")) );
  ?>
<style>
.date{
  position: absolute;
  top: 15%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size:12px;
}
.title{
  position: absolute;
  top: 38%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size:12px;
}

.paid{
  position: absolute;
  top: 43%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size:12px;
}
.name{
  position: absolute;
  top: 55%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size:12px;
}

.number{
  position: absolute;
  top: 95%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size:12px;
}
</style>
<div class="date "><?=$yyyymm?></div>
<div class="title "><?=$user[$yyyymm]['ValidTitle']?></div>
<div class="paid "><?=$user[$yyyymm]['PaidTitle']?></div>
<div class="name "><?=$user['mcaName']?></div>
<div class="number "><?=$user['mcaNumber']?></div>
<img src="/img/Certificate.png">