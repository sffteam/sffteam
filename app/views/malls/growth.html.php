<div class="block page-content">
<?php
 $yyyymm = date('Y-m');
 $yyyymmdays=date(d)-1;
	$p0yyyymmdays=cal_days_in_month(CAL_GREGORIAN,date('m', strtotime("0 month", strtotime(date("F") . "1"))),date('Y', strtotime("0 month", strtotime(date("F") . "1"))));
 $p1yyyymmdays=cal_days_in_month(CAL_GREGORIAN,date('m', strtotime("-1 month", strtotime(date("F") . "1"))),date('Y', strtotime("-1 month", strtotime(date("F") . "1"))));
 $p2yyyymmdays=cal_days_in_month(CAL_GREGORIAN,date('m', strtotime("-2 month", strtotime(date("F") . "1"))),date('Y', strtotime("-2 month", strtotime(date("F") . "1"))));
 $p3yyyymmdays=cal_days_in_month(CAL_GREGORIAN,date('m', strtotime("-3 month", strtotime(date("F") . "1"))),date('Y', strtotime("-3 month", strtotime(date("F") . "1"))));
 $p4yyyymmdays=cal_days_in_month(CAL_GREGORIAN,date('m', strtotime("-4 month", strtotime(date("F") . "1"))),date('Y', strtotime("-4 month", strtotime(date("F") . "1"))));
 $p5yyyymmdays=cal_days_in_month(CAL_GREGORIAN,date('m', strtotime("-5 month", strtotime(date("F") . "1"))),date('Y', strtotime("-5 month", strtotime(date("F") . "1"))));
 $p6yyyymmdays=cal_days_in_month(CAL_GREGORIAN,date('m', strtotime("-6 month", strtotime(date("F") . "1"))),date('Y', strtotime("-6 month", strtotime(date("F") . "1"))));
 $p7yyyymmdays=cal_days_in_month(CAL_GREGORIAN,date('m', strtotime("-7 month", strtotime(date("F") . "1"))),date('Y', strtotime("-7 month", strtotime(date("F") . "1"))));
 $p8yyyymmdays=cal_days_in_month(CAL_GREGORIAN,date('m', strtotime("-8 month", strtotime(date("F") . "1"))),date('Y', strtotime("-8 month", strtotime(date("F") . "1"))));
 $p9yyyymmdays=cal_days_in_month(CAL_GREGORIAN,date('m', strtotime("-9 month", strtotime(date("F") . "1"))),date('Y', strtotime("-9 month", strtotime(date("F") . "1"))));
 $p10yyyymmdays=cal_days_in_month(CAL_GREGORIAN,date('m', strtotime("-10 month", strtotime(date("F") . "1"))),date('Y', strtotime("-10 month", strtotime(date("F") . "1"))));
 $p11yyyymmdays=cal_days_in_month(CAL_GREGORIAN,date('m', strtotime("-11 month", strtotime(date("F") . "1"))),date('Y', strtotime("-11 month", strtotime(date("F") . "1"))));
 $p12yyyymmdays=cal_days_in_month(CAL_GREGORIAN,date('m', strtotime("-12 month", strtotime(date("F") . "1"))),date('Y', strtotime("-12 month", strtotime(date("F") . "1"))));
 $totalDays = $yyyymmdays + $p1yyyymmdays;

 $p1yyyymm = date("Y-m", strtotime("-1 month", strtotime(date("F") . "1")) );
 $p2yyyymm = date("Y-m", strtotime("-2 month", strtotime(date("F") . "1")) );
 $p3yyyymm = date("Y-m", strtotime("-3 month", strtotime(date("F") . "1")) );
 $p4yyyymm = date("Y-m", strtotime("-4 month", strtotime(date("F") . "1")) );
 $p5yyyymm = date("Y-m", strtotime("-5 month", strtotime(date("F") . "1")) );
 $p6yyyymm = date("Y-m", strtotime("-6 month", strtotime(date("F") . "1")) );
 $p7yyyymm = date("Y-m", strtotime("-7 month", strtotime(date("F") . "1")) );
 $p8yyyymm = date("Y-m", strtotime("-8 month", strtotime(date("F") . "1")) );
 $p9yyyymm = date("Y-m", strtotime("-9 month", strtotime(date("F") . "1")) );
 $p10yyyymm = date("Y-m", strtotime("-10 month", strtotime(date("F") . "1")) );
 $p11yyyymm = date("Y-m", strtotime("-11 month", strtotime(date("F") . "1")) );
 $p12yyyymm = date("Y-m", strtotime("-12 month", strtotime(date("F") . "1")) );

?>
<h1 class="Raleway sz1"><strong><?=$self['mcaName']?> - (<a href="/tree/index/<?=$self['mcaNumber']?>/<?=$yyyymm?>/d" class="external links" title="Open Tree Structure" target="_blank"><?=$self['mcaNumber']?></a>) <?=$self[$yyyymm]['PaidTitle']?> - <?=$self['DateJoin']?> <br><small>KYC: <?=$self['KYC']?>, NEFT: <?=$self['NEFT']?>  <a href="/malls/snapshot/<?=$self['mcaNumber']?>" class="external link">Snapshot</a> - <a href="/malls/daily/<?=$self['mcaNumber']?>" class="external link">Daily</a></small> Daily GPV report <a href="/malls/growth/<?=$self['mcaNumber']?>" class="external link">Monthly</a></small> Growth</strong></h1>
<table cellspacing=0 cellpadding=0 class="Roboto szhalf">
<tr>
 <th class="col top left"><small>YYYY-MM</small></th>
	<th class="col top left"><?=$p12yyyymm?></th>
	<th class="col top left"><?=$p11yyyymm?></th>
 <th class="col top left"><?=$p10yyyymm?></th>
 <th class="col top left"><?=$p9yyyymm?></th>
 <th class="col top left"><?=$p8yyyymm?></th>
 <th class="col top left"><?=$p7yyyymm?></th>
 <th class="col top left"><?=$p6yyyymm?></th>
 <th class="col top left"><?=$p5yyyymm?></th>
 <th class="col top left"><?=$p4yyyymm?></th>
 <th class="col top left"><a href="/malls/prevmonth/<?=$self['mcaNumber']?>/<?=$p3yyyymm?>/" class="external text-color-white" target="_blank"><?=$p3yyyymm?></a></th>
 <th class="col top left"><a href="/malls/prevmonth/<?=$self['mcaNumber']?>/<?=$p2yyyymm?>/" class="external text-color-white" target="_blank"><?=$p2yyyymm?></a></th>
 <th class="col top left"><a href="/malls/prevmonth/<?=$self['mcaNumber']?>/<?=$p1yyyymm?>/" class="external text-color-white" target="_blank"><?=$p1yyyymm?></a></th>
  <th class="col top left"><a href="/malls/prevmonth/<?=$self['mcaNumber']?>/<?=$yyyymm?>/" class="external text-color-white" target="_blank"><?=$yyyymm?></a></th>
</tr>
<tr >
	<td class="left right bottom">Days</td>
	<td class="right bottom"><?=$p12yyyymmdays?></td>
	<td class="right bottom"><?=$p11yyyymmdays?></td>
	<td class="right bottom"><?=$p10yyyymmdays?></td>
	<td class="right bottom"><?=$p9yyyymmdays?></td>
	<td class="right bottom"><?=$p8yyyymmdays?></td>
	<td class="right bottom"><?=$p7yyyymmdays?></td>
	<td class="right bottom"><?=$p6yyyymmdays?></td>
	<td class="right bottom"><?=$p5yyyymmdays?></td>
	<td class="right bottom"><?=$p4yyyymmdays?></td>
	<td class="right bottom"><?=$p3yyyymmdays?></td>
	<td class="right bottom"><?=$p2yyyymmdays?></td>
	<td class="right bottom"><?=$p1yyyymmdays?></td>
	<td class="right bottom"><?=$yyyymmdays?></td>
</tr>
<tr >
<td class="left right bottom" colspan=14>GBV / Day<br>Increase / Decrease</td>
</tr>
<tr >
	<td class="left right bottom"><?=$self['mcaName']?></td>
	<td class="right bottom"><?=number_format($self[$p12yyyymm]['GBV']/$p12yyyymmdays,0)?><br></td>
	<td class="right bottom"><?=number_format($self[$p11yyyymm]['GBV']/$p11yyyymmdays,0)?><br><?=number_format($self[$p11yyyymm]['GBV']/$p11yyyymmdays-$self[$p12yyyymm]['GBV']/$p12yyyymmdays,0)?></td>
	<td class="right bottom"><?=number_format($self[$p10yyyymm]['GBV']/$p10yyyymmdays,0)?><br><?=number_format($self[$p10yyyymm]['GBV']/$p10yyyymmdays-$self[$p11yyyymm]['GBV']/$p11yyyymmdays,0)?></td>
	<td class="right bottom"><?=number_format($self[$p9yyyymm]['GBV']/$p9yyyymmdays,0)?><br><?=number_format($self[$p9yyyymm]['GBV']/$p9yyyymmdays-$self[$p10yyyymm]['GBV']/$p10yyyymmdays,0)?></td>
	<td class="right bottom"><?=number_format($self[$p8yyyymm]['GBV']/$p8yyyymmdays,0)?><br><?=number_format($self[$p8yyyymm]['GBV']/$p8yyyymmdays-$self[$p9yyyymm]['GBV']/$p9yyyymmdays,0)?></td>
	<td class="right bottom"><?=number_format($self[$p7yyyymm]['GBV']/$p7yyyymmdays,0)?><br><?=number_format($self[$p7yyyymm]['GBV']/$p7yyyymmdays-$self[$p8yyyymm]['GBV']/$p8yyyymmdays,0)?></td>
	<td class="right bottom"><?=number_format($self[$p6yyyymm]['GBV']/$p6yyyymmdays,0)?><br><?=number_format($self[$p6yyyymm]['GBV']/$p6yyyymmdays-$self[$p7yyyymm]['GBV']/$p7yyyymmdays,0)?></td>
	<td class="right bottom"><?=number_format($self[$p5yyyymm]['GBV']/$p5yyyymmdays,0)?><br><?=number_format($self[$p5yyyymm]['GBV']/$p5yyyymmdays-$self[$p6yyyymm]['GBV']/$p6yyyymmdays,0)?></td>
	<td class="right bottom"><?=number_format($self[$p4yyyymm]['GBV']/$p4yyyymmdays,0)?><br><?=number_format($self[$p4yyyymm]['GBV']/$p4yyyymmdays-$self[$p5yyyymm]['GBV']/$p5yyyymmdays,0)?></td>
	<td class="right bottom"><?=number_format($self[$p3yyyymm]['GBV']/$p3yyyymmdays,0)?><br><?=number_format($self[$p3yyyymm]['GBV']/$p3yyyymmdays-$self[$p4yyyymm]['GBV']/$p4yyyymmdays,0)?></td>
	<td class="right bottom"><?=number_format($self[$p2yyyymm]['GBV']/$p2yyyymmdays,0)?><br><?=number_format($self[$p2yyyymm]['GBV']/$p2yyyymmdays-$self[$p3yyyymm]['GBV']/$p3yyyymmdays,0)?></td>
	<td class="right bottom"><?=number_format($self[$p1yyyymm]['GBV']/$p1yyyymmdays,0)?><br><?=number_format($self[$p1yyyymm]['GBV']/$p1yyyymmdays-$self[$p2yyyymm]['GBV']/$p2yyyymmdays,0)?></td>
	<td class="right bottom"><?=number_format($self[$yyyymm]['GBV']/$yyyymmdays,0)?><br><?=number_format($self[$yyyymm]['GBV']/$p0yyyymmdays-$self[$p1yyyymm]['GBV']/$p1yyyymmdays,0)?></td>
</tr>
<?php foreach ($team as $t){?>
<tr>
	<td class="left right bottom"><?=$t['mcaName']?></td>
	<td class="right bottom"><?=number_format($t[$p12yyyymm]['GBV']/$p12yyyymmdays,0)?><br></td>
	<td class="right bottom"><?=number_format($t[$p11yyyymm]['GBV']/$p11yyyymmdays,0)?><br><?=number_format($t[$p11yyyymm]['GBV']/$p11yyyymmdays-$t[$p12yyyymm]['GBV']/$p12yyyymmdays,0)?></td>
	<td class="right bottom"><?=number_format($t[$p10yyyymm]['GBV']/$p10yyyymmdays,0)?><br><?=number_format($t[$p10yyyymm]['GBV']/$p10yyyymmdays-$t[$p11yyyymm]['GBV']/$p11yyyymmdays,0)?></td>
	<td class="right bottom"><?=number_format($t[$p9yyyymm]['GBV']/$p9yyyymmdays,0)?><br><?=number_format($t[$p9yyyymm]['GBV']/$p9yyyymmdays-$t[$p10yyyymm]['GBV']/$p10yyyymmdays,0)?></td>
	<td class="right bottom"><?=number_format($t[$p8yyyymm]['GBV']/$p8yyyymmdays,0)?><br><?=number_format($t[$p8yyyymm]['GBV']/$p8yyyymmdays-$t[$p9yyyymm]['GBV']/$p9yyyymmdays,0)?></td>
	<td class="right bottom"><?=number_format($t[$p7yyyymm]['GBV']/$p7yyyymmdays,0)?><br><?=number_format($t[$p7yyyymm]['GBV']/$p7yyyymmdays-$t[$p8yyyymm]['GBV']/$p8yyyymmdays,0)?></td>
	<td class="right bottom"><?=number_format($t[$p6yyyymm]['GBV']/$p6yyyymmdays,0)?><br><?=number_format($t[$p6yyyymm]['GBV']/$p6yyyymmdays-$t[$p7yyyymm]['GBV']/$p7yyyymmdays,0)?></td>
	<td class="right bottom"><?=number_format($t[$p5yyyymm]['GBV']/$p5yyyymmdays,0)?><br><?=number_format($t[$p5yyyymm]['GBV']/$p5yyyymmdays-$t[$p6yyyymm]['GBV']/$p6yyyymmdays,0)?></td>
	<td class="right bottom"><?=number_format($t[$p4yyyymm]['GBV']/$p4yyyymmdays,0)?><br><?=number_format($t[$p4yyyymm]['GBV']/$p4yyyymmdays-$t[$p5yyyymm]['GBV']/$p5yyyymmdays,0)?></td>
	<td class="right bottom"><?=number_format($t[$p3yyyymm]['GBV']/$p3yyyymmdays,0)?><br><?=number_format($t[$p3yyyymm]['GBV']/$p3yyyymmdays-$t[$p4yyyymm]['GBV']/$p4yyyymmdays,0)?></td>
	<td class="right bottom"><?=number_format($t[$p2yyyymm]['GBV']/$p2yyyymmdays,0)?><br><?=number_format($t[$p2yyyymm]['GBV']/$p2yyyymmdays-$t[$p3yyyymm]['GBV']/$p3yyyymmdays,0)?></td>
	<td class="right bottom"><?=number_format($t[$p1yyyymm]['GBV']/$p1yyyymmdays,0)?><br><?=number_format($t[$p1yyyymm]['GBV']/$p1yyyymmdays-$t[$p2yyyymm]['GBV']/$p2yyyymmdays,0)?></td>
	<td class="right bottom"><?=number_format($t[$yyyymm]['GBV']/$yyyymmdays,0)?><br><?=number_format($t[$yyyymm]['GBV']/$p0yyyymmdays-$t[$p1yyyymm]['GBV']/$p1yyyymmdays,0)?></td>
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
