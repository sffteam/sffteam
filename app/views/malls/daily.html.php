<div class="block page-content">
<?php
 $yyyymm = date('Y-m');
 $yyyymmdays=date(d)-1;
 $p1yyyymmdays=cal_days_in_month(CAL_GREGORIAN,date('m', strtotime("-1 month", strtotime(date("F") . "1"))),date('Y', strtotime("-1 month", strtotime(date("F") . "1"))));
 $totalDays = $yyyymmdays + $p1yyyymmdays;
?>
<h1 class="Raleway sz1"><strong><?=$self['mcaName']?> - (<a href="/tree/index/<?=$self['mcaNumber']?>/<?=$yyyymm?>/d" class="external links" title="Open Tree Structure" target="_blank"><?=$self['mcaNumber']?></a>) <?=$self[$yyyymm]['PaidTitle']?> - <?=$self['DateJoin']?> <br><small>KYC: <?=$self['KYC']?>, NEFT: <?=$self['NEFT']?>  <a href="/malls/snapshot/<?=$self['mcaNumber']?>" class="external link">Snapshot</a> - <a href="/malls/daily/<?=$self['mcaNumber']?>" class="external link">Daily</a></small> Daily GPV report <a href="/malls/growth/<?=$self['mcaNumber']?>" class="external link">Monthly Growth</a> <a href="/malls/loyalty/<?=$self['mcaNumber']?>" class="external link">Loyalty</a></small> </strong></h1>
<table cellspacing=0 cellpadding=0 class="Roboto szhalf">
 <tr>
 <th class="right left">#</th>
 <th class="right left">Name</th>
 <th class="right left">Today</th>
 <?php for($i=1;$i<=13;$i++){
  $prevDate = date("M-d", strtotime('today - '.$i.' days') );
  $yyyymm = date("Y-m", strtotime('today - '.$i.' days') );
  ?>
  <th class="right"><?=$prevDate?></th>
 <?php }?>
 </tr>
 <tr class="">
 <td class="right left bottom">0</td>
 <td class="right left bottom"><?=$self['mcaName']?></td>
 <?php 
 $yyyymm = date("Y-m", strtotime('today - 1 days') );
 $prevDate = date("Y-m-d", strtotime('today - 0 days') );
 $pprevDate = date("Y-m-d", strtotime('today - 1 days') );
 ?> 
 <td class="bottom right left"><?=$self[$yyyymm][$prevDate]['GPV']-$self[$yyyymm][$pprevDate]['GPV'];?><br>
	<?=$self[$yyyymm][$prevDate]['GBV']-$self[$yyyymm][$pprevDate]['GBV'];?></td>
 <?php for($i=0;$i<=12;$i++){
  $prevDate = date("Y-m-d", strtotime('today - '.$i.' days') );
  $yyyymm = date("Y-m", strtotime('today - '.$i.' days') );
  ?>
 <td class="bottom right"><?=$self[$yyyymm][$prevDate]['GPV']?:0;?><br><?=$self[$yyyymm][$prevDate]['GBV']?:0;?></td>
 <?php }?>
 </tr>
 <?php $x=1;foreach($team as $t){?>
 <tr>
 <td class="bottom right left"><?=$x?></td>
 <td  class="bottom right left"><a href="/malls/daily/<?=$t['mcaNumber']?>" class="external link"><?=$t['mcaName']?></a></td>
 <?php 
 $yyyymm = date("Y-m", strtotime('today - 1 days') );
 $prevDate = date("Y-m-d", strtotime('today - 0 days') );
 $pprevDate = date("Y-m-d", strtotime('today - 1 days') );
 ?>
 <td class="bottom right left"><?=$t[$yyyymm][$prevDate]['GPV']-$t[$yyyymm][$pprevDate]['GPV'];?><br><?=$t[$yyyymm][$prevDate]['GBV']-$t[$yyyymm][$pprevDate]['GBV'];?></td>
 <?php for($i=0;$i<=12;$i++){
  $prevDate = date("Y-m-d", strtotime('today - '.$i.' days') );
  $yyyymm = date("Y-m", strtotime('today - '.$i.' days') );
  ?>
 <td class="bottom right"><?=$t[$yyyymm][$prevDate]['GPV']?:0;?><br><?=$t[$yyyymm][$prevDate]['GBV']?:0;?></td>
 <?php 
 
 }$x++;
 ?>
 </tr>
 <?php }
 ?>
</table>

<br>
<hr>
<div id="GPVChart" style="width: 100%; height: 600px"></div>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<br>
<hr>

</div>
