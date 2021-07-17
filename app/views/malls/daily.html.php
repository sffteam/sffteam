<div class="block page-content">
<?php
 $yyyymm = date('Y-m');
 $yyyymmdays=date(d)-1;
 $p1yyyymmdays=cal_days_in_month(CAL_GREGORIAN,date('m', strtotime("-1 month", strtotime(date("F") . "1"))),date('Y', strtotime("-1 month", strtotime(date("F") . "1"))));
 $totalDays = $yyyymmdays + $p1yyyymmdays;
?>
<h1 class="Raleway sz1"><strong><?=$self['mcaName']?> - (<a href="/tree/index/<?=$self['mcaNumber']?>/<?=$yyyymm?>/d" class="external links" title="Open Tree Structure" target="_blank"><?=$self['mcaNumber']?></a>) <?=$self[$yyyymm]['PaidTitle']?> - <?=$self['DateJoin']?> <br><small>KYC: <?=$self['KYC']?>, NEFT: <?=$self['NEFT']?>  <a href="/malls/snapshot/<?=$self['mcaNumber']?>" class="external link">Snapshot</a> - <a href="/malls/daily/<?=$self['mcaNumber']?>" class="external link">Daily</a></small></strong></h1>
<table cellspacing=0 cellpadding=0>
 <tr>
 <th class="right left">Name</th>
 <?php for($i=$totalDays;$i>=0;$i--){
  $prevDate = date("M-d", strtotime('today - '.$i.' days') );
  ?>
  <th class="right"><?=$prevDate?></th>
 <?php }?>
 </tr>
 <?php foreach($team as $t){?>
 <tr>
 <td  class="bottom right left"><?=$t['mcaName']?></td>
    <?php for($i=$totalDays;$i>=0;$i--){
     $prevDate = date("M-d", strtotime('today - '.$i.' days') );
    ?>
 <td  class="bottom right"></td>
    <?php }?>
 </tr>
 <?php }?>
</table>
<br>
<hr>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<br>
<hr>

</div>
