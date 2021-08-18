
<div class="block page-content">

<?php
 $yyyymm = date('Y-m');
 
 $yyyymmdays=date(d)-1;

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
 
 $n1yyyymmdays=cal_days_in_month(CAL_GREGORIAN,date('m', strtotime("1 month", strtotime(date("F") . "1"))),date('Y', strtotime("1 month", strtotime(date("F") . "1"))));
 $n2yyyymmdays=cal_days_in_month(CAL_GREGORIAN,date('m', strtotime("2 month", strtotime(date("F") . "1"))),date('Y', strtotime("2 month", strtotime(date("F") . "1"))));
 $n3yyyymmdays=cal_days_in_month(CAL_GREGORIAN,date('m', strtotime("3 month", strtotime(date("F") . "1"))),date('Y', strtotime("3 month", strtotime(date("F") . "1"))));
 $n4yyyymmdays=cal_days_in_month(CAL_GREGORIAN,date('m', strtotime("4 month", strtotime(date("F") . "1"))),date('Y', strtotime("4 month", strtotime(date("F") . "1"))));
 $n5yyyymmdays=cal_days_in_month(CAL_GREGORIAN,date('m', strtotime("5 month", strtotime(date("F") . "1"))),date('Y', strtotime("5 month", strtotime(date("F") . "1"))));
 $n6yyyymmdays=cal_days_in_month(CAL_GREGORIAN,date('m', strtotime("6 month", strtotime(date("F") . "1"))),date('Y', strtotime("6 month", strtotime(date("F") . "1"))));
 $n7yyyymmdays=cal_days_in_month(CAL_GREGORIAN,date('m', strtotime("7 month", strtotime(date("F") . "1"))),date('Y', strtotime("7 month", strtotime(date("F") . "1"))));
 $n8yyyymmdays=cal_days_in_month(CAL_GREGORIAN,date('m', strtotime("8 month", strtotime(date("F") . "1"))),date('Y', strtotime("8 month", strtotime(date("F") . "1"))));
 $n9yyyymmdays=cal_days_in_month(CAL_GREGORIAN,date('m', strtotime("9 month", strtotime(date("F") . "1"))),date('Y', strtotime("9 month", strtotime(date("F") . "1"))));
 $n10yyyymmdays=cal_days_in_month(CAL_GREGORIAN,date('m', strtotime("10 month", strtotime(date("F") . "1"))),date('Y', strtotime("10 month", strtotime(date("F") . "1"))));
 $n11yyyymmdays=cal_days_in_month(CAL_GREGORIAN,date('m', strtotime("11 month", strtotime(date("F") . "1"))),date('Y', strtotime("11 month", strtotime(date("F") . "1"))));



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

 $n1yyyymm = date("Y-m", strtotime("1 month", strtotime(date("F") . "1")) );
 $n2yyyymm = date("Y-m", strtotime("2 month", strtotime(date("F") . "1")) );
 $n3yyyymm = date("Y-m", strtotime("3 month", strtotime(date("F") . "1")) );
 $n4yyyymm = date("Y-m", strtotime("4 month", strtotime(date("F") . "1")) );
 $n5yyyymm = date("Y-m", strtotime("5 month", strtotime(date("F") . "1")) );
 $n6yyyymm = date("Y-m", strtotime("6 month", strtotime(date("F") . "1")) );
 $n7yyyymm = date("Y-m", strtotime("7 month", strtotime(date("F") . "1")) );
 $n8yyyymm = date("Y-m", strtotime("8 month", strtotime(date("F") . "1")) );
 $n9yyyymm = date("Y-m", strtotime("9 month", strtotime(date("F") . "1")) );
 $n10yyyymm = date("Y-m", strtotime("10 month", strtotime(date("F") . "1")) );
 $n11yyyymm = date("Y-m", strtotime("11 month", strtotime(date("F") . "1")) );
?>
<h1 class="Raleway sz1"><strong><?=$self['mcaName']?> - (<a href="/tree/index/<?=$self['mcaNumber']?>/<?=$yyyymm?>/d" class="external " title="Open Tree Structure" target="_blank"><?=$self['mcaNumber']?></a>) <?=$self[$yyyymm]['PaidTitle']?> - <?=$self['DateJoin']?> <br><small>KYC: <?=$self['KYC']?>, NEFT: <?=$self['NEFT']?>  <a href="/malls/snapshot/<?=$self['mcaNumber']?>" class="external ">Snapshot</a> - <a href="/malls/daily/<?=$self['mcaNumber']?>" class="external ">Daily</a></small></strong></h1>

<table  border=0 cellspacing=0 cellpadding=0 class="Roboto szhalf">
<tr>
 <th class="col top left"><small>YYYY-MM</small></th>
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
<tr>
 <th class="col top left">PV</th>
 <td class="col top left"><?=$self[$p10yyyymm]['PV']?:0?></td>
 <td class="col top left"><?=$self[$p9yyyymm]['PV']?:0?></td>
 <td class="col top left"><?=$self[$p8yyyymm]['PV']?:0?></td>
 <td class="col top left"><?=$self[$p7yyyymm]['PV']?:0?></td>
 <td class="col top left"><?=$self[$p6yyyymm]['PV']?:0?></td>
 <td class="col top left"><?=$self[$p5yyyymm]['PV']?:0?></td>
 <td class="col top left"><?=$self[$p4yyyymm]['PV']?:0?></td>
 <td class="col top left"><?=$self[$p3yyyymm]['PV']?:0?></td>
 <td class="col top left"><?=$self[$p2yyyymm]['PV']?:0?></td>
 <td class="col top left"><?=$self[$p1yyyymm]['PV']?:0?></td>
 <td class="col top left right"><?=$self[$yyyymm]['PV']?:0?></td>
</tr>
<tr>
 <th class="col top left">BV</th>
 <td class="col top left"><?=$self[$p10yyyymm]['BV']?:0?></td>
 <td class="col top left"><?=$self[$p9yyyymm]['BV']?:0?></td>
 <td class="col top left"><?=$self[$p8yyyymm]['BV']?:0?></td>
 <td class="col top left"><?=$self[$p7yyyymm]['BV']?:0?></td>
 <td class="col top left"><?=$self[$p6yyyymm]['BV']?:0?></td>
 <td class="col top left"><?=$self[$p5yyyymm]['BV']?:0?></td>
 <td class="col top left"><?=$self[$p4yyyymm]['BV']?:0?></td>
 <td class="col top left"><?=$self[$p3yyyymm]['BV']?:0?></td>
 <td class="col top left"><?=$self[$p2yyyymm]['BV']?:0?></td>
 <td class="col top left"><?=$self[$p1yyyymm]['BV']?:0?></td>
 <td class="col top left right"><?=$self[$yyyymm]['BV']?:0?></td>
</tr>
<tr >
 <th class="col top left bg-color-red">GPV</th>
 <td class="col top left"><?=$self[$p10yyyymm]['GPV']?:0?></td>
 <td class="col top left"><?=$self[$p9yyyymm]['GPV']?:0?></td>
 <td class="col top left"><?=$self[$p8yyyymm]['GPV']?:0?></td>
 <td class="col top left"><?=$self[$p7yyyymm]['GPV']?:0?></td>
 <td class="col top left"><?=$self[$p6yyyymm]['GPV']?:0?></td>
 <td class="col top left"><?=$self[$p5yyyymm]['GPV']?:0?></td>
 <td class="col top left"><?=$self[$p4yyyymm]['GPV']?:0?></td>
 <td class="col top left"><?=$self[$p3yyyymm]['GPV']?:0?></td>
 <td class="col top left"><?=$self[$p2yyyymm]['GPV']?:0?></td>
 <td class="col top left"><?=$self[$p1yyyymm]['GPV']?:0?></td>
 <td class="col top left right bg-color-pink"><?=$self[$yyyymm]['GPV']?:0?></td>
</tr>
<tr >
 <th class="col top left bg-color-red">TEPV</th>
 <td class="col top left"><?=$self[$p10yyyymm]['TotalEPV']?:0?></td>
 <td class="col top left"><?=$self[$p9yyyymm]['TotalEPV']?:0?></td>
 <td class="col top left"><?=$self[$p8yyyymm]['TotalEPV']?:0?></td>
 <td class="col top left"><?=$self[$p7yyyymm]['TotalEPV']?:0?></td>
 <td class="col top left"><?=$self[$p6yyyymm]['TotalEPV']?:0?></td>
 <td class="col top left"><?=$self[$p5yyyymm]['TotalEPV']?:0?></td>
 <td class="col top left"><?=$self[$p4yyyymm]['TotalEPV']?:0?></td>
 <td class="col top left"><?=$self[$p3yyyymm]['TotalEPV']?:0?></td>
 <td class="col top left"><?=$self[$p2yyyymm]['TotalEPV']?:0?></td>
 <td class="col top left"><?=$self[$p1yyyymm]['TotalEPV']?:0?></td>
 <td class="col top left right bg-color-pink"><?=$self[$yyyymm]['TotalEPV']?:0?></td>
</tr>
<tr>
 <th class="col top left">CGPV</th>
 <td class="col top left"><?=$self[$p10yyyymm]['GrossPV']?:0?></td>
 <td class="col top left"><?=$self[$p9yyyymm]['GrossPV']?:0?></td>
 <td class="col top left"><?=$self[$p8yyyymm]['GrossPV']?:0?></td>
 <td class="col top left"><?=$self[$p7yyyymm]['GrossPV']?:0?></td>
 <td class="col top left"><?=$self[$p6yyyymm]['GrossPV']?:0?></td>
 <td class="col top left"><?=$self[$p5yyyymm]['GrossPV']?:0?></td>
 <td class="col top left"><?=$self[$p4yyyymm]['GrossPV']?:0?></td>
 <td class="col top left"><?=$self[$p3yyyymm]['GrossPV']?:0?></td>
 <td class="col top left"><?=$self[$p2yyyymm]['GrossPV']?:0?></td>
 <td class="col top left"><?=$self[$p1yyyymm]['GrossPV']?:0?></td>
 <td class="col top left right"><?=$self[$yyyymm]['GrossPV']?:0?></td>
</tr>
<tr>
 <th class="col top left">GBV</th>
 <td class="col top left"><?=$self[$p10yyyymm]['GBV']?:0?></td>
 <td class="col top left"><?=$self[$p9yyyymm]['GBV']?:0?></td>
 <td class="col top left"><?=$self[$p8yyyymm]['GBV']?:0?></td>
 <td class="col top left"><?=$self[$p7yyyymm]['GBV']?:0?></td>
 <td class="col top left"><?=$self[$p6yyyymm]['GBV']?:0?></td>
 <td class="col top left"><?=$self[$p5yyyymm]['GBV']?:0?></td>
 <td class="col top left"><?=$self[$p4yyyymm]['GBV']?:0?></td>
 <td class="col top left"><?=$self[$p3yyyymm]['GBV']?:0?></td>
 <td class="col top left"><?=$self[$p2yyyymm]['GBV']?:0?></td>
 <td class="col top left"><?=$self[$p1yyyymm]['GBV']?:0?></td>
 <td class="col top left right bg-color-black text-color-white"><?=$self[$yyyymm]['GBV']?:0?></td>
</tr>
<tr>
 <th class="col top left">GBV/day</th>
 <td class="col top left"><?=number_format($self[$p10yyyymm]['GBV']/$p10yyyymmdays,0,".","")?></td>
 <td class="col top left"><?=number_format($self[$p9yyyymm]['GBV']/$p9yyyymmdays,0,".","")?></td>
 <td class="col top left"><?=number_format($self[$p8yyyymm]['GBV']/$p8yyyymmdays,0,".","")?></td>
 <td class="col top left"><?=number_format($self[$p7yyyymm]['GBV']/$p7yyyymmdays,0,".","")?></td>
 <td class="col top left"><?=number_format($self[$p6yyyymm]['GBV']/$p6yyyymmdays,0,".","")?></td>
 <td class="col top left"><?=number_format($self[$p5yyyymm]['GBV']/$p5yyyymmdays,0,".","")?></td>
 <td class="col top left"><?=number_format($self[$p4yyyymm]['GBV']/$p4yyyymmdays,0,".","")?></td>
 <td class="col top left"><?=number_format($self[$p3yyyymm]['GBV']/$p3yyyymmdays,0,".","")?></td>
 <td class="col top left"><?=number_format($self[$p2yyyymm]['GBV']/$p2yyyymmdays,0,".","")?></td>
 <td class="col top left"><?=number_format($self[$p1yyyymm]['GBV']/$p1yyyymmdays,0,".","")?></td>
 <td class="col top left right"><?=number_format($self[$yyyymm]['GBV']/$yyyymmdays,0,".","")?></td>
</tr>
<tr>
 <th class="col top left"><small>GBV/PGV</small></th>
 <td class="col top left"><?=number_format( $self[$p10yyyymm]['GBV']/$self[$p10yyyymm]['GPV'],0)?></td>
 <td class="col top left"><?=number_format( $self[$p9yyyymm]['GBV']/$self[$p9yyyymm]['GPV'],0)?></td>
 <td class="col top left"><?=number_format( $self[$p8yyyymm]['GBV']/$self[$p8yyyymm]['GPV'],0)?></td>
 <td class="col top left"><?=number_format( $self[$p7yyyymm]['GBV']/$self[$p7yyyymm]['GPV'],0)?></td>
 <td class="col top left"><?=number_format( $self[$p6yyyymm]['GBV']/$self[$p6yyyymm]['GPV'],0)?></td>
 <td class="col top left"><?=number_format( $self[$p5yyyymm]['GBV']/$self[$p5yyyymm]['GPV'],0)?></td>
 <td class="col top left"><?=number_format( $self[$p4yyyymm]['GBV']/$self[$p4yyyymm]['GPV'],0)?></td>
 <td class="col top left"><?=number_format( $self[$p3yyyymm]['GBV']/$self[$p3yyyymm]['GPV'],0)?></td>
 <td class="col top left"><?=number_format( $self[$p2yyyymm]['GBV']/$self[$p2yyyymm]['GPV'],0)?></td>
 <td class="col top left"><?=number_format( $self[$p1yyyymm]['GBV']/$self[$p1yyyymm]['GPV'],0)?></td>
 <td class="col top left right"><?=number_format( $self[$yyyymm]['GBV']/$self[$yyyymm]['GPV'],0)?></td>
</tr>
<tr>
 <th class="col top left bg-color-red"><small>PGPV</small></th>
 <td class="col top left"><?=number_format($self[$p10yyyymm]['PGPV'],0)?></td>
 <td class="col top left"><?=number_format($self[$p9yyyymm]['PGPV'],0)?></td>
 <td class="col top left"><?=number_format($self[$p8yyyymm]['PGPV'],0)?></td>
 <td class="col top left"><?=number_format($self[$p7yyyymm]['PGPV'],0)?></td>
 <td class="col top left"><?=number_format($self[$p6yyyymm]['PGPV'],0)?></td>
 <td class="col top left"><?=number_format($self[$p5yyyymm]['PGPV'],0)?></td>
 <td class="col top left"><?=number_format($self[$p4yyyymm]['PGPV'],0)?></td>
 <td class="col top left"><?=number_format($self[$p3yyyymm]['PGPV'],0)?></td>
 <td class="col top left"><?=number_format($self[$p2yyyymm]['PGPV'],0)?></td>
 <td class="col top left"><?=number_format($self[$p1yyyymm]['PGPV'],0)?></td>
 <td class="col top left right bg-color-pink"><?=number_format($self[$yyyymm]['PGPV'],0)?></td>
</tr>
<tr>
 <th class="col top left bg-color-red"><small>PGBV</small></th>
 <td class="col top left"><?=number_format($self[$p10yyyymm]['PGBV'],0)?></td>
 <td class="col top left"><?=number_format($self[$p9yyyymm]['PGBV'],0)?></td>
 <td class="col top left"><?=number_format($self[$p8yyyymm]['PGBV'],0)?></td>
 <td class="col top left"><?=number_format($self[$p7yyyymm]['PGBV'],0)?></td>
 <td class="col top left"><?=number_format($self[$p6yyyymm]['PGBV'],0)?></td>
 <td class="col top left"><?=number_format($self[$p5yyyymm]['PGBV'],0)?></td>
 <td class="col top left"><?=number_format($self[$p4yyyymm]['PGBV'],0)?></td>
 <td class="col top left"><?=number_format($self[$p3yyyymm]['PGBV'],0)?></td>
 <td class="col top left"><?=number_format($self[$p2yyyymm]['PGBV'],0)?></td>
 <td class="col top left"><?=number_format($self[$p1yyyymm]['PGBV'],0)?></td>
 <td class="col top left right bg-color-pink"><?=number_format($self[$yyyymm]['PGBV'],0)?></td>
</tr>
<tr>
 <th class="col top left"><small>Roll Up</small></th>
 <td class="col top left"><?=number_format($self[$p10yyyymm]['RollUpPV'],0)?></td>
 <td class="col top left"><?=number_format($self[$p9yyyymm]['RollUpPV'],0)?></td>
 <td class="col top left"><?=number_format($self[$p8yyyymm]['RollUpPV'],0)?></td>
 <td class="col top left"><?=number_format($self[$p7yyyymm]['RollUpPV'],0)?></td>
 <td class="col top left"><?=number_format($self[$p6yyyymm]['RollUpPV'],0)?></td>
 <td class="col top left"><?=number_format($self[$p5yyyymm]['RollUpPV'],0)?></td>
 <td class="col top left"><?=number_format($self[$p4yyyymm]['RollUpPV'],0)?></td>
 <td class="col top left"><?=number_format($self[$p3yyyymm]['RollUpPV'],0)?></td>
 <td class="col top left"><?=number_format($self[$p2yyyymm]['RollUpPV'],0)?></td>
 <td class="col top left"><?=number_format($self[$p1yyyymm]['RollUpPV'],0)?></td>
 <td class="col top left right"><?=number_format($self[$yyyymm]['RollUpPV'],0)?></td>
</tr>
<tr>
 <th class="col top left bottom"><small>BV &#8593;%</small></th>
 <td class="col top left bottom"><?=number_format((($self[$p10yyyymm]['GBV']/$p10yyyymmdays)-($self[$p11yyyymm]['GBV']/$p11yyyymmdays))/($self[$p11yyyymm]['GBV']/$p11yyyymmdays)*100,0)?>%</td>
 <td class="col top left bottom"><?=number_format((($self[$p9yyyymm]['GBV']/$p9yyyymmdays)-($self[$p10yyyymm]['GBV']/$p10yyyymmdays))/($self[$p10yyyymm]['GBV']/$p10yyyymmdays)*100,0)?>%</td>
 <td class="col top left bottom"><?=number_format((($self[$p8yyyymm]['GBV']/$p8yyyymmdays)-($self[$p9yyyymm]['GBV']/$p9yyyymmdays))/($self[$p9yyyymm]['GBV']/$p9yyyymmdays)*100,0)?>%</td>
 <td class="col top left bottom"><?=number_format((($self[$p7yyyymm]['GBV']/$p7yyyymmdays)-($self[$p8yyyymm]['GBV']/$p8yyyymmdays))/($self[$p8yyyymm]['GBV']/$p8yyyymmdays)*100,0)?>%</td>
 <td class="col top left bottom"><?=number_format((($self[$p6yyyymm]['GBV']/$p6yyyymmdays)-($self[$p7yyyymm]['GBV']/$p7yyyymmdays))/($self[$p7yyyymm]['GBV']/$p7yyyymmdays)*100,0)?>%</td>
 <td class="col top left bottom"><?=number_format((($self[$p5yyyymm]['GBV']/$p5yyyymmdays)-($self[$p6yyyymm]['GBV']/$p6yyyymmdays))/($self[$p6yyyymm]['GBV']/$p6yyyymmdays)*100,0)?>%</td>
 <td class="col top left bottom"><?=number_format((($self[$p4yyyymm]['GBV']/$p4yyyymmdays)-($self[$p5yyyymm]['GBV']/$p5yyyymmdays))/($self[$p5yyyymm]['GBV']/$p5yyyymmdays)*100,0)?>%</td>
 <td class="col top left bottom"><?=number_format((($self[$p3yyyymm]['GBV']/$p3yyyymmdays)-($self[$p4yyyymm]['GBV']/$p4yyyymmdays))/($self[$p4yyyymm]['GBV']/$p4yyyymmdays)*100,0)?>%</td>
 <td class="col top left bottom"><?=number_format((($self[$p2yyyymm]['GBV']/$p2yyyymmdays)-($self[$p3yyyymm]['GBV']/$p3yyyymmdays))/($self[$p3yyyymm]['GBV']/$p3yyyymmdays)*100,0)?>%</td>
 <td class="col top left bottom"><?=number_format((($self[$p1yyyymm]['GBV']/$p1yyyymmdays)-($self[$p2yyyymm]['GBV']/$p2yyyymmdays))/($self[$p2yyyymm]['GBV']/$p2yyyymmdays)*100,0)?>%</td>
 <td class="col top left bottom right"><?=number_format((($self[$yyyymm]['GBV']/$yyyymmdays)-($self[$p1yyyymm]['GBV']/$p1yyyymmdays))/($self[$p1yyyymm]['GBV']/$p1yyyymmdays)*100,0)?>%</td>
</tr>
<tr>
 <th class="col  left bottom">Title</th>
 <td class="col  left bottom"><small><?=str_replace("r(N","r (N",str_replace("r(Q","r (Q",$self[$p10yyyymm]['PaidTitle']))?:"-"?></small></td>
 <td class="col  left bottom"><small><?=str_replace("r(N","r (N",str_replace("r(Q","r (Q",$self[$p9yyyymm]['PaidTitle']))?:"-"?></small></td>
 <td class="col  left bottom"><small><?=str_replace("r(N","r (N",str_replace("r(Q","r (Q",$self[$p8yyyymm]['PaidTitle']))?:"-"?></small></td>
 <td class="col  left bottom"><small><?=str_replace("r(N","r (N",str_replace("r(Q","r (Q",$self[$p7yyyymm]['PaidTitle']))?:"-"?></small></td>
 <td class="col  left bottom"><small><?=str_replace("r(N","r (N",str_replace("r(Q","r (Q",$self[$p6yyyymm]['PaidTitle']))?:"-"?></small></td>
 <td class="col  left bottom"><small><?=str_replace("r(N","r (N",str_replace("r(Q","r (Q",$self[$p5yyyymm]['PaidTitle']))?:"-"?></small></td>
 <td class="col  left bottom"><small><?=str_replace("r(N","r (N",str_replace("r(Q","r (Q",$self[$p4yyyymm]['PaidTitle']))?:"-"?></small></td>
 <td class="col  left bottom bg-color-red"><small><?=str_replace("r(N","r (N",str_replace("r(Q","r (Q",$self[$p3yyyymm]['PaidTitle']))?:"-"?></small></td>
 <td class="col  left bottom"><small><?=str_replace("r(N","r (N",str_replace("r(Q","r (Q",$self[$p2yyyymm]['PaidTitle']))?:"-"?></small></td>
 <td class="col  left bottom"><small><?=str_replace("r(N","r (N",str_replace("r(Q","r (Q",$self[$p1yyyymm]['PaidTitle']))?:"-"?></small></td>
 <td class="col  left bottom right"><small><?=str_replace("r(N","r (N",str_replace("r(Q","r (Q",$self[$yyyymm]['PaidTitle']))?:"-"?></small></td>
</tr>
<tr>
 <th class="col bottom left"><small>Gross</small></th>
 <td class="col bottom left"><?=number_format($self[$p10yyyymm]['Gross'],0)?></td>
 <td class="col bottom left"><?=number_format($self[$p9yyyymm]['Gross'],0)?></td>
 <td class="col bottom left"><?=number_format($self[$p8yyyymm]['Gross'],0)?></td>
 <td class="col bottom left"><?=number_format($self[$p7yyyymm]['Gross'],0)?></td>
 <td class="col bottom left"><?=number_format($self[$p6yyyymm]['Gross'],0)?></td>
 <td class="col bottom left"><?=number_format($self[$p5yyyymm]['Gross'],0)?></td>
 <td class="col bottom left"><?=number_format($self[$p4yyyymm]['Gross'],0)?></td>
 <td class="col bottom left"><?=number_format($self[$p3yyyymm]['Gross'],0)?></td>
 <td class="col bottom left"><?=number_format($self[$p2yyyymm]['Gross'],0)?></td>
 <td class="col bottom left"><?=number_format($self[$p1yyyymm]['Gross'],0)?></td>
 <td class="col bottom left right"><?=number_format($self[$yyyymm]['Gross'],0)?></td>
</tr>
</table>
<p  class="Raleway szhalf">GBV/GPV is BV to PV ratio. This ratio is ideally 27. It reduces when you take advantage of Extra PV. Without Extra PV this ratio is always 27. </p>
<h1 class="Raleway sz1"><strong>My Leaders</strong></h1>
<p  class="Roboto szhalf">
<?php
foreach($MyAncestor as $key=>$val){
 print_r($val[0]."<br>");
};
?></p>

<h1 class="Raleway sz1">PGPV Contributors <?=$yyyymm?></h1>
<table border=0 cellspacing=0 cellpadding=1 class="Roboto szhalf">
 <tr>
 <th class="szhalf col top left ">#</th>
 <th class="szhalf col top left ">Name</th>
 <th class="szhalf col top left ">MCA No</th>
 <th class=" szhalf col top left ">PV</th>
 <th class=" szhalf col top left bg-color-red ">GPV</th>
 <th class=" szhalf col top left ">TEPV</th>
 <th class=" szhalf col top left ">PGPV</th>
 <th class=" szhalf col top left ">GBV</th>
 <th class=" szhalf col top left ">GBV/GPV %</th>
 <th class=" szhalf col top left right">Growth</th>
 </tr>
<?php $i=1;foreach($PGPVContributors as $t){?>
 <tr>
 <td class="szhalf col top left  bottom"><?=$i?></td>
 <td class="text-align-left col top left  bottom">
 <?php if($t['refer_id']==$self['mcaNumber']){
  echo "&#9728;";
 }
 ?>
 <a href="/malls/ytdgpv/<?=$t['mcaNumber']?>" title="Open <?=$t['mcaName']?> report" class=" external"><small><?=$t['mcaName']?></small></a> <small><a href="tel:+91<?=$t['Mobile']?>" class="external ">(+91<?=$t['Mobile']?>)</a> <?=$t[$yyyymm]['ValidTitle']?> <?=$t[$yyyymm]['Percent']?>%</small></td>
 <td class="  top left text-align-left bottom"><a href="/tree/index/<?=$t['mcaNumber']?>/<?=$yyyymm?>/d" class="external" title="Open Tree Structure" target="_blank"><?=$t['mcaNumber']?></a>
 <?php if($t['KYC']=='Approved'){?>
 <span class="Roboto badge color-green tooltip-init" data-tooltip="KYC Approved" >A</span>
 <?php }else{?>
 <span class="Roboto badge color-red">A</span>
 <?php }?>
 <?php if($t['NEFT']=='Y'){?>
 <span class="Roboto badge color-green">N</span>
 <?php }else{?>
 <span class="Roboto badge color-red">N</span>
 <?php }?>
 </td>
 <td class="szhalf  top left bottom "><?=$t[$yyyymm]['PV']?></td>
 <td class="szhalf  top left bottom bg-color-pink"><?=$t[$yyyymm]['GPV']?></td>
 <td class="szhalf  top left bottom "><?=$t[$yyyymm]['TotalEPV']?></td>
 <td class="szhalf  top left bottom "><?=$t[$yyyymm]['PGPV']?></td>
 <td class="szhalf  top left bottom "><?=$t[$yyyymm]['GBV']?></td>
 <td class="szhalf  top left bottom"><?=number_format($t[$yyyymm]['GBV']/$t[$yyyymm]['GPV'],0)?></td>
 <td class="szhalf  top left bottom right"><?=number_format((($t[$yyyymm]['GBV']/$yyyymmdays)-($t[$p1yyyymm]['GBV']/$p1yyyymmdays))/($t[$p1yyyymm]['GBV']/$p1yyyymmdays)*100,0)?>%</td> 
 </tr>
<?php $i++;} ?>
</table>

<div id="GBVChart" style="width: 100%; height: 300px"></div>
<div id="GPVChart" style="width: 100%; height: 300px"></div>
<hr>
<h1 class="Raleway sz1">New Directors <?=$yyyymm?></h1>
<table border=0 cellspacing=0 cellpadding=1 class="Roboto szhalf">
 <tr>
 <th class="szhalf col top left ">#</th>
 <th class="szhalf col top left ">Name</th>
 <th class="szhalf col top left ">MCA No</th>
 <th class=" szhalf col top left ">PV</th>
 <th class=" szhalf col top left ">GPV</th>
 <th class=" szhalf col top left ">CGPV</th>
 <th class=" szhalf col top left ">TEPV</th>
 <th class=" szhalf col top left ">PGPV</th>
 <th class=" szhalf col top left ">GBV</th>
 <th class=" szhalf col top left ">GBV/GPV %</th>
 <th class=" szhalf col top left right">Growth</th>
 </tr>
<?php $i=1;foreach($newDirectors as $t){?>
 <tr>
 <td class="szhalf col top left  bottom"><?=$i?></td>
 <td class="text-align-left col top left  bottom">
 <?php if($t['refer_id']==$self['mcaNumber']){
  echo "&#9728;";
 }
 ?>
 <a href="/malls/ytdgpv/<?=$t['mcaNumber']?>" title="Open <?=$t['mcaName']?> report" class=" external"><small><?=$t['mcaName']?></small></a> <small><a href="tel:+91<?=$t['Mobile']?>" class="external ">(+91<?=$t['Mobile']?>)</a> <?=$t[$yyyymm]['ValidTitle']?> <?=$t[$yyyymm]['Percent']?>%</small></td>
 <td class="  top left text-align-left bottom"><a href="/tree/index/<?=$t['mcaNumber']?>/<?=$yyyymm?>/d" class="external" title="Open Tree Structure" target="_blank"><?=$t['mcaNumber']?></a>
 <?php if($t['KYC']=='Approved'){?>
 <span class="Roboto badge color-green tooltip-init" data-tooltip="KYC Approved" >A</span>
 <?php }else{?>
 <span class="Roboto badge color-red">A</span>
 <?php }?>
 <?php if($t['NEFT']=='Y'){?>
 <span class="Roboto badge color-green">N</span>
 <?php }else{?>
 <span class="Roboto badge color-red">N</span>
 <?php }?>

 </td>
 <td class="szhalf  top left bottom "><?=$t[$yyyymm]['PV']?></td>
 <td class="szhalf  top left bottom "><?=$t[$yyyymm]['GPV']?></td>
 <td class="szhalf  top left bottom "><?=$t[$yyyymm]['GrossPV']?></td>
 <td class="szhalf  top left bottom "><?=$t[$yyyymm]['TotalEPV']?></td>
 <td class="szhalf  top left bottom "><?=$t[$yyyymm]['PGPV']?></td>
 <td class="szhalf  top left bottom "><?=$t[$yyyymm]['GBV']?></td>
 <td class="szhalf  top left bottom"><?=number_format($t[$yyyymm]['GBV']/$t[$yyyymm]['GPV'],0)?></td>
 <td class="szhalf  top left bottom right"><?=number_format((($t[$yyyymm]['GBV']/$yyyymmdays)-($t[$p1yyyymm]['GBV']/$p1yyyymmdays))/($t[$p1yyyymm]['GBV']/$p1yyyymmdays)*100,0)?>%</td> </tr>

<?php $i++;} ?>
</table>
 
 

<p class="Roboto szhalf">Your team who have completed PV in this month. &#9728; are your Direct Team, Your Direct Team who have not completed this month PV is not included. Total Team Size <?=$countteam?> ACTIVE <?=count($team)?>.</p>
<table border=0 cellspacing=0 cellpadding=1 class="Roboto szhalf">
 <tr>
 <th class="szhalf col top left ">#</th>
 <th class="szhalf col top left ">Name</th>
 <th class="szhalf col top left ">MCA No</th>
 <th class=" szhalf col top left ">PV</th>
 <th class=" szhalf col top left ">GPV</th>
 <th class=" szhalf col top left ">TEPV</th>
 <th class=" szhalf col top left ">PGPV</th>
 <th class=" szhalf col top left ">GBV</th>
 <th class=" szhalf col top left ">GBV/GPV %</th>
 <th class=" szhalf col top left right">Growth</th>
 </tr>
<?php 
$i = 0;foreach($team as $t){
 $i++;
 ?>
<tr>
 <td class="szhalf col top left "><?=$i?></td>
 <td class="text-align-left col top left ">
 <?php if($t['refer_id']==$self['mcaNumber']){
  echo "&#9728;";
 }
 ?>
 <a href="/malls/ytdgpv/<?=$t['mcaNumber']?>" title="Open <?=$t['mcaName']?> report" class=" external"><small><?=$t['mcaName']?></small></a> <small><a href="tel:+91<?=$t['Mobile']?>" class="external ">(+91<?=$t['Mobile']?>)</a> <?=$t[$yyyymm]['ValidTitle']?> <?=$t[$yyyymm]['Percent']?>%</small></td>
 <td class="  top left text-align-left"><a href="/tree/index/<?=$t['mcaNumber']?>/<?=$yyyymm?>/d" class="external" title="Open Tree Structure" target="_blank"><?=$t['mcaNumber']?></a>
 <?php if($t['KYC']=='Approved'){?>
 <span class="Roboto badge color-green tooltip-init" data-tooltip="KYC Approved" >A</span>
 <?php }else{?>
 <span class="Roboto badge color-red">A</span>
 <?php }?>
 <?php if($t['NEFT']=='Y'){?>
 <span class="Roboto badge color-green">N</span>
 <?php }else{?>
 <span class="Roboto badge color-red">N</span>
 <?php }?>

 
 </td>
 <td class="szhalf  top left "><?=$t[$yyyymm]['PV']?></td>
 <td class="szhalf  top left "><?=$t[$yyyymm]['GPV']?></td>
 <td class="szhalf  top left "><?=$t[$yyyymm]['TotalEPV']?></td>
 <td class="szhalf  top left "><?=$t[$yyyymm]['PGPV']?></td>
 <td class="szhalf  top left "><?=$t[$yyyymm]['GBV']?></td>
 <td class="szhalf  top left "><?=number_format($t[$yyyymm]['GBV']/$t[$yyyymm]['GPV'],0)?></td>
 <td class="szhalf  top left  right"><?=number_format((($t[$yyyymm]['GBV']/$yyyymmdays)-($t[$p1yyyymm]['GBV']/$p1yyyymmdays))/($t[$p1yyyymm]['GBV']/$p1yyyymmdays)*100,0)?>%</td>
</tr>
<?php 
}
?> 
</table>
<?php
$rate = 1+number_format((($self[$yyyymm]['GBV']/$yyyymmdays)-($self[$p1yyyymm]['GBV']/$p1yyyymmdays))/($self[$p1yyyymm]['GBV']/$p1yyyymmdays)*100,0)/100;

$nrate = 1.2;
?>
<hr>
<p class="Roboto szhalf">If you do business at the current rate of this month in the next month and maintain 20% in subsequent months. You will have to your own PV and build your team along with title. Your GPV and GBV will grow and your Cheque will be 10% commission based on your GBV.</p>
<table  border="0" cellspacing=0 cellpadding=1 class="Roboto szhalf">
<tr>
 <th  class="szhalf  top left "><small>YYYY-MM</small></th>
 <th  class="szhalf  top left "><small><?=$n1yyyymm?></small></th>
 <th  class="szhalf  top left "><small><?=$n2yyyymm?></small></th>
 <th  class="szhalf  top left "><small><?=$n3yyyymm?></small></th>
 <th  class="szhalf  top left "><small><?=$n4yyyymm?></small></th>
 <th  class="szhalf  top left "><small><?=$n5yyyymm?></small></th>
 <th  class="szhalf  top left "><small><?=$n6yyyymm?></small></th>
 <th  class="szhalf  top left "><small><?=$n7yyyymm?></small></th>
 <th  class="szhalf  top left "><small><?=$n9yyyymm?></small></th>
 <th  class="szhalf  top left "><small><?=$n10yyyymm?></small></th>
 <th  class="szhalf  top left right"><small><?=$n11yyyymm?></small></th>
</tr>
<tr>
 <td  class="szhalf  top left "><small>GPV</small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$self[$yyyymm]['GPV']/$yyyymmdays*$n1yyyymmdays,0)?></small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$nrate*$self[$yyyymm]['GPV']/$yyyymmdays*$n2yyyymmdays,0)?></small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$nrate*$nrate*$self[$yyyymm]['GPV']/$yyyymmdays*$n3yyyymmdays,0)?></small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$nrate*$nrate*$nrate*$self[$yyyymm]['GPV']/$yyyymmdays*$n4yyyymmdays,0)?></small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$self[$yyyymm]['GPV']/$yyyymmdays*$n5yyyymmdays,0)?></small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$nrate*$self[$yyyymm]['GPV']/$yyyymmdays*$n6yyyymmdays,0)?></small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$self[$yyyymm]['GPV']/$yyyymmdays*$n7yyyymmdays,0)?></small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$self[$yyyymm]['GPV']/$yyyymmdays*$n8yyyymmdays,0)?></small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$self[$yyyymm]['GPV']/$yyyymmdays*$n9yyyymmdays,0)?></small></td>
 <td  class="szhalf  top left right"><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$self[$yyyymm]['GPV']/$yyyymmdays*$n10yyyymmdays,0)?></small></td>
</tr>
<tr>
 <td  class="szhalf  top left "><small>GBV</small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$self[$yyyymm]['GBV'],0)?></small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$nrate*$self[$yyyymm]['GBV'],0)?></small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$nrate*$nrate*$self[$yyyymm]['GBV'],0)?></small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$nrate*$nrate*$nrate*$self[$yyyymm]['GBV'],0)?></small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$self[$yyyymm]['GBV'],0)?></small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$nrate*$self[$yyyymm]['GBV'],0)?></small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$self[$yyyymm]['GBV'],0)?></small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$self[$yyyymm]['GBV'],0)?></small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$self[$yyyymm]['GBV'],0)?></small></td>
 <td  class="szhalf  top left right"><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$self[$yyyymm]['GBV'],0)?></small></td>
</tr>
<tr>
 <td  class="szhalf  top left "><small>Commission (Approx) Last Month</small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$self[$yyyymm]['GBV']*.1,0)?></small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$nrate*$self[$yyyymm]['GBV']*.1,0)?></small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$nrate*$nrate*$self[$yyyymm]['GBV']*.1,0)?></small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$nrate*$nrate*$nrate*$self[$yyyymm]['GBV']*.1,0)?></small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$self[$yyyymm]['GBV']*.1,0)?></small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$nrate*$self[$yyyymm]['GBV']*.1,0)?></small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$self[$yyyymm]['GBV']*.1,0)?></small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$self[$yyyymm]['GBV']*.1,0)?></small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$self[$yyyymm]['GBV']*.1,0)?></small></td>
 <td  class="szhalf  top left right"><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$self[$yyyymm]['GBV']*.1,0)?></small></td>
</tr>
<?php
$average = 0;
$totalGBV = 0;
$months = 0;
 if($self[$p11yyyymm]['GBV']>0){
  $months++;
  $totalGBV = $totalGBV + $self[$p11yyyymm]['GBV'];
 }
 if($self[$p10yyyymm]['GBV']>0){
  $months++;
  $totalGBV = $totalGBV + $self[$p10yyyymm]['GBV'];
 }
 if($self[$p9yyyymm]['GBV']>0){
  $months++;
  $totalGBV = $totalGBV + $self[$p9yyyymm]['GBV'];
 }
 if($self[$p8yyyymm]['GBV']>0){
  $months++;
  $totalGBV = $totalGBV + $self[$p8yyyymm]['GBV'];
 }
 if($self[$p7yyyymm]['GBV']>0){
  $months++;
  $totalGBV = $totalGBV + $self[$p7yyyymm]['GBV'];
 }
 if($self[$p6yyyymm]['GBV']>0){
  $months++;
  $totalGBV = $totalGBV + $self[$p6yyyymm]['GBV'];
 }
 if($self[$p5yyyymm]['GBV']>0){
  $months++;
  $totalGBV = $totalGBV + $self[$p5yyyymm]['GBV'];
 }
 if($self[$p4yyyymm]['GBV']>0){
  $months++;
  $totalGBV = $totalGBV + $self[$p4yyyymm]['GBV'];
 }
 if($self[$p3yyyymm]['GBV']>0){
  $months++;
  $totalGBV = $totalGBV + $self[$p3yyyymm]['GBV'];
 }
 if($self[$p2yyyymm]['GBV']>0){
  $months++;
  $totalGBV = $totalGBV + $self[$p2yyyymm]['GBV'];
 }
 if($self[$p1yyyymm]['GBV']>0){
  $months++;
  $totalGBV = $totalGBV + $self[$p1yyyymm]['GBV'];
 }
 if($self[$pyyyymm]['GBV']>0){
  $months++;
  $totalGBV = $totalGBV + $self[$pyyyymm]['GBV'];
 }
 $average = number_format($totalGBV / $months,0,".","");
?>
<tr>
 <td  class="szhalf  top left "><small>Commission (Approx) Average</small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$average*.1,0)?></small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$nrate*$average*.1,0)?></small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$nrate*$nrate*$average*.1,0)?></small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$nrate*$nrate*$nrate*$average*.1,0)?></small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$average*.1,0)?></small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$nrate*$average*.1,0)?></small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$average*.1,0)?></small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$average*.1,0)?></small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$average*.1,0)?></small></td>
 <td  class="szhalf  top left "><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$average*.1,0)?></small></td>
</tr>
</table>
<hr>
<h1 class="Raleway szhalf">Team Zero this month</h1>
<table border=0 cellpadding=1 cellspacing=0 class="Roboto szhalf">
 <tr>
 <th class="szhalf top left">#</th>
 <th class="szhalf top left">Name</th>
 <th class="szhalf top left">MCA No</th>
 <th class=" szhalf top left">PV</th>
 <th class=" szhalf top left">GPV</th>
 <th class=" szhalf top left">TEPV</th>
 <th class=" szhalf top left">PGPV</th>
 <th class=" szhalf top left">GBV</th>
 <th class=" szhalf top left">GBV/GPV %</th>
 <th class=" szhalf top left right">Growth</th>
 </tr>
<?php 
$i = 0;foreach($teamzero as $t){
 $i++;
 ?>
<tr>
 <td class="szhalf left bottom"><?=$i?></td>
 <td class="text-align-left  left bottom">
 <?php 
 if($t['refer_id']==$self['mcaNumber']){
  echo "&#9728;";
 }
 ?>
 <a href="/malls/ytdgpv/<?=$t['mcaNumber']?>"  title="Open <?=$t['mcaName']?> report" class="external"><small><?=$t['mcaName']?></small></a> <small><a href="tel:+91<?=$t['Mobile']?>" class="external ">(+91<?=$t['Mobile']?>)</a> <?=$t[$yyyymm]['ValidTitle']?> <?=$t[$yyyymm]['Percent']?>%</small></td>
 <td class="text-align-center  left bottom"><a href="/tree/index/<?=$t['mcaNumber']?>/<?=$yyyymm?>/d"  title="Open tree structure report" class="external" target="_blank"><?=$t['mcaNumber']?></a>
 <?php if($t['KYC']=='Approved'){?>
 <span class="Roboto badge color-green tooltip-init" data-tooltip="KYC Approved" >A</span>
 <?php }else{?>
 <span class="Roboto badge color-red">A</span>
 <?php }?>
 <?php if($t['NEFT']=='Y'){?>
 <span class="Roboto badge color-green">N</span>
 <?php }else{?>
 <span class="Roboto badge color-red">N</span>
 <?php }?>

 </td>
 <td class="  left bottom"><?=$t[$yyyymm]['PV']?></td>
 <td class="  left bottom"><?=$t[$yyyymm]['GPV']?></td>
 <td class="  left bottom"><?=$t[$yyyymm]['TotalEPV']?></td>
 <td class="  left bottom"><?=$t[$yyyymm]['PGPV']?></td>
 <td class="  left bottom"><?=$t[$yyyymm]['GBV']?></td>
 <td class="  left bottom"><?=number_format($t[$yyyymm]['GBV']/$t[$yyyymm]['GPV'],0)?></td>
 <td class="  left right bottom"><?=number_format((($t[$yyyymm]['GBV']/$yyyymmdays)-($t[$p1yyyymm]['GBV']/$p1yyyymmdays))/($t[$p1yyyymm]['GBV']/$p1yyyymmdays)*100,0)?>%</td>
</tr>
<?php 
}
?> 
</table>
<br>
<hr>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<br>
<hr>

</div>
