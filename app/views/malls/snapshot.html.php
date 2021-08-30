
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
<h1 class="Raleway sz1"><strong><?=$self['mcaName']?> - (<a href="/tree/index/<?=$self['mcaNumber']?>/<?=$yyyymm?>/d" class="external links" title="Open Tree Structure" target="_blank"><?=$self['mcaNumber']?></a>) <?=$self[$yyyymm]['PaidTitle']?> - <?=$self['DateJoin']?> <br><small>KYC: <?=$self['KYC']?>, NEFT: <?=$self['NEFT']?>  <a href="/malls/snapshot/<?=$self['mcaNumber']?>" class="external link">Snapshot</a> - <a href="/malls/daily/<?=$self['mcaNumber']?>" class="external link">Daily</a></small> Daily GPV report <a href="/malls/growth/<?=$self['mcaNumber']?>" class="external link">Monthly</a></small> Growth</strong></h1>

<table  border=0 cellspacing=0 cellpadding=0 class="Roboto szhalf">
<tr>
 <th class="col top left"><small>YYYY-MM</small></th>
 <th class="col top left"><?=$p3yyyymm?></th>
 <th class="col top left"><?=$p2yyyymm?></th>
 <th class="col top left"><?=$p1yyyymm?></th>
 <th class="col top left right"><?=$yyyymm?></th>
</tr>
<tr>
 <th class="col top left">Team</th>
 <td class="col top left right"><?=$snapshot[$p3yyyymm.'.Team']?:0?></td>
 <td class="col top left right"><?=$snapshot[$p2yyyymm.'.Team']?:0?></td>
 <td class="col top left right"><?=$snapshot[$p1yyyymm.'.Team']?:0?></td>
 <td class="col top left right"><?=$snapshot[$yyyymm.'.Team']?:0?></td>
</tr>
<tr>
 <th class="col top left">GPV</th>
 <td class="col top left right"><?=$snapshot[$p3yyyymm.'.GPV']?:0?></td>
 <td class="col top left right"><?=$snapshot[$p2yyyymm.'.GPV']?:0?></td>
 <td class="col top left right"><?=$snapshot[$p1yyyymm.'.GPV']?:0?></td>
 <td class="col top left right"><?=$snapshot[$yyyymm.'.GPV']?:0?></td>
</tr>
<tr>
 <th class="col top left">GBV</th>
 <td class="col top left right"><?=$snapshot[$p3yyyymm.'.GBV']?:0?></td>
 <td class="col top left right"><?=$snapshot[$p2yyyymm.'.GBV']?:0?></td>
 <td class="col top left right"><?=$snapshot[$p1yyyymm.'.GBV']?:0?></td>
 <td class="col top left right"><?=$snapshot[$yyyymm.'.GBV']?:0?></td>
</tr>
<tr>
 <th class="col top left">GBV/GPV Ratio</th>
 <td class="col top left right"><?=number_format($snapshot[$p3yyyymm.'.GBV']/$snapshot[$p3yyyymm.'.GPV']?:0,0)?></td>
 <td class="col top left right"><?=number_format($snapshot[$p2yyyymm.'.GBV']/$snapshot[$p2yyyymm.'.GPV']?:0,0)?></td>
 <td class="col top left right"><?=number_format($snapshot[$p1yyyymm.'.GBV']/$snapshot[$p1yyyymm.'.GPV']?:0,0)?></td>
 <td class="col top left right"><?=number_format($snapshot[$yyyymm.'.GBV']/$snapshot[$yyyymm.'.GPV']?:0,0)?></td>
</tr>
<tr>
 <th class="col top left">Active</th>
 <td class="col top left right"><?=$snapshot[$p3yyyymm.'.Active']?:0?></td>
 <td class="col top left right"><?=$snapshot[$p2yyyymm.'.Active']?:0?></td>
 <td class="col top left right"><?=$snapshot[$p1yyyymm.'.Active']?:0?></td>
 <td class="col top left right"><?=$snapshot[$yyyymm.'.Active']?:0?></td>
</tr>
<tr>
 <th class="col top left">PV/Active</th>
 <td class="col top left right"><?=number_format($snapshot[$p3yyyymm.'.GPV']/$snapshot[$p3yyyymm.'.Active']?:0,1)?></td>
 <td class="col top left right"><?=number_format($snapshot[$p2yyyymm.'.GPV']/$snapshot[$p2yyyymm.'.Active']?:0,1)?></td>
 <td class="col top left right"><?=number_format($snapshot[$p1yyyymm.'.GPV']/$snapshot[$p1yyyymm.'.Active']?:0,1)?></td>
 <td class="col top left right"><?=number_format($snapshot[$yyyymm.'.GPV']/$snapshot[$yyyymm.'.Active']?:0,1)?></td>
</tr>
<tr>
 <th class="col top left">Active All</th>
 <td class="col top left right"><?=$snapshot[$p3yyyymm.'.ActiveAll']?:0?></td>
 <td class="col top left right"><?=$snapshot[$p2yyyymm.'.ActiveAll']?:0?></td>
 <td class="col top left right"><?=$snapshot[$p1yyyymm.'.ActiveAll']?:0?></td>
 <td class="col top left right"><?=$snapshot[$yyyymm.'.ActiveAll']?:0?></td>
</tr>
<tr>
 <th class="col top left">PV/Active All</th>
 <td class="col top left right"><?=number_format($snapshot[$p3yyyymm.'.GPV']/$snapshot[$p3yyyymm.'.ActiveAll']?:0,1)?></td>
 <td class="col top left right"><?=number_format($snapshot[$p2yyyymm.'.GPV']/$snapshot[$p2yyyymm.'.ActiveAll']?:0,1)?></td>
 <td class="col top left right"><?=number_format($snapshot[$p1yyyymm.'.GPV']/$snapshot[$p1yyyymm.'.ActiveAll']?:0,1)?></td>
 <td class="col top left right"><?=number_format($snapshot[$yyyymm.'.GPV']/$snapshot[$yyyymm.'.ActiveAll']?:0,1)?></td>
</tr><tr>
 <th class="col top left">Percent 0<br>No Shopping</th>
 <td class="col top left right"><?=$snapshot[$p3yyyymm.'.Level']?:0?></td>
 <td class="col top left right"><?=$snapshot[$p2yyyymm.'.Level']?:0?></td>
 <td class="col top left right"><?=$snapshot[$p1yyyymm.'.Level']?:0?></td>
 <td class="col top left right"><?=$snapshot[$yyyymm.'.Level']?:0?></td>
</tr>
<tr>
 <th class="col top left">Percent 7%<br>1 - 300</th>
 <td class="col top left right"><?=$snapshot[$p3yyyymm.'.Percent7']?:0?></td>
 <td class="col top left right"><?=$snapshot[$p2yyyymm.'.Percent7']?:0?></td>
 <td class="col top left right"><?=$snapshot[$p1yyyymm.'.Percent7']?:0?></td>
 <td class="col top left right"><?=$snapshot[$yyyymm.'.Percent7']?:0?></td>
</tr>
<tr>
 <th class="col top left">Percent 10%<br>301 - 1200</th>
 <td class="col top left right"><?=$snapshot[$p3yyyymm.'.Percent10']?:0?></td>
 <td class="col top left right"><?=$snapshot[$p2yyyymm.'.Percent10']?:0?></td>
 <td class="col top left right"><?=$snapshot[$p1yyyymm.'.Percent10']?:0?></td>
 <td class="col top left right"><?=$snapshot[$yyyymm.'.Percent10']?:0?></td>
</tr>
<tr>
 <th class="col top left">Percent 13%<br>1201 - 2700</th>
 <td class="col top left right"><?=$snapshot[$p3yyyymm.'.Percent13']?:0?></td>
 <td class="col top left right"><?=$snapshot[$p2yyyymm.'.Percent13']?:0?></td>
 <td class="col top left right"><?=$snapshot[$p1yyyymm.'.Percent13']?:0?></td>
 <td class="col top left right"><?=$snapshot[$yyyymm.'.Percent13']?:0?></td>
</tr>
<tr>
 <th class="col top left">Percent 15%<br>2701 - 4000</th>
 <td class="col top left right"><?=$snapshot[$p3yyyymm.'.Percent15']?:0?></td>
 <td class="col top left right"><?=$snapshot[$p2yyyymm.'.Percent15']?:0?></td>
 <td class="col top left right"><?=$snapshot[$p1yyyymm.'.Percent15']?:0?></td>
 <td class="col top left right"><?=$snapshot[$yyyymm.'.Percent15']?:0?></td>
</tr>
<tr>
 <th class="col top left">Percent 16%<br>4000+</th>
 <td class="col top left right"><?=$snapshot[$p3yyyymm.'.Percent16']?:0?></td>
 <td class="col top left right"><?=$snapshot[$p2yyyymm.'.Percent16']?:0?></td>
 <td class="col top left right"><?=$snapshot[$p1yyyymm.'.Percent16']?:0?></td>
 <td class="col top left right"><?=$snapshot[$yyyymm.'.Percent16']?:0?></td>
</tr>
<tr>
 <th class="col top left">Supervisor<br>Valid/Paid</th>
 <td class="col top left right"><?=$snapshot[$p3yyyymm.'.Supervisor']?:"-"?>/<?=$snapshot[$p3yyyymm.'.SupervisorPaid']?:"-"?></td>
 <td class="col top left right"><?=$snapshot[$p2yyyymm.'.Supervisor']?:"-"?>/<?=$snapshot[$p2yyyymm.'.SupervisorPaid']?:"-"?></td>
 <td class="col top left right"><?=$snapshot[$p1yyyymm.'.Supervisor']?:"-"?>/<?=$snapshot[$p1yyyymm.'.SupervisorPaid']?:"-"?></td>
 <td class="col top left right"><?=$snapshot[$yyyymm.'.Supervisor']?:"-"?>/<?=$snapshot[$yyyymm.'.SupervisorPaid']?:"-"?></td>
</tr>
<tr>
 <th class="col top left">Director<br>Valid/Paid</th>
 <td class="col top left right"><?=$snapshot[$p3yyyymm.'.Director']?:"-"?>/<?=$snapshot[$p3yyyymm.'.DirectorPaid']?:"-"?></td>
 <td class="col top left right"><?=$snapshot[$p2yyyymm.'.Director']?:"-"?>/<?=$snapshot[$p2yyyymm.'.DirectorPaid']?:"-"?></td>
 <td class="col top left right"><?=$snapshot[$p1yyyymm.'.Director']?:"-"?>/<?=$snapshot[$p1yyyymm.'.DirectorPaid']?:"-"?></td>
 <td class="col top left right"><?=$snapshot[$yyyymm.'.Director']?:"-"?>/<?=$snapshot[$yyyymm.'.DirectorPaid']?:"-"?></td>
</tr>
<tr>
 <th class="col top left">Director NQ<br>Valid/Paid</th>
 <td class="col top left right"><?=$snapshot[$p3yyyymm.'.DirectorNQ']?:"-"?>/<?=$snapshot[$p3yyyymm.'.DirectorNQPaid']?:"-"?></td>
 <td class="col top left right"><?=$snapshot[$p2yyyymm.'.DirectorNQ']?:"-"?>/<?=$snapshot[$p2yyyymm.'.DirectorNQPaid']?:"-"?></td>
 <td class="col top left right"><?=$snapshot[$p1yyyymm.'.DirectorNQ']?:"-"?>/<?=$snapshot[$p1yyyymm.'.DirectorNQPaid']?:"-"?></td>
 <td class="col top left right"><?=$snapshot[$yyyymm.'.DirectorNQ']?:"-"?>/<?=$snapshot[$yyyymm.'.DirectorNQPaid']?:"-"?></td>
</tr>
<tr>
 <th class="col top left">Director QD<br>Valid/Paid</th>
 <td class="col top left right"><?=$snapshot[$p3yyyymm.'.DirectorQD']?:"-"?>/<?=$snapshot[$p3yyyymm.'.DirectorQDPaid']?:"-"?></td>
 <td class="col top left right"><?=$snapshot[$p2yyyymm.'.DirectorQD']?:"-"?>/<?=$snapshot[$p2yyyymm.'.DirectorQDPaid']?:"-"?></td>
 <td class="col top left right"><?=$snapshot[$p1yyyymm.'.DirectorQD']?:"-"?>/<?=$snapshot[$p1yyyymm.'.DirectorQDPaid']?:"-"?></td>
 <td class="col top left right"><?=$snapshot[$yyyymm.'.DirectorQD']?:"-"?>/<?=$snapshot[$yyyymm.'.DirectorQDPaid']?:"-"?></td>
</tr>
<tr>
 <th class="col top left">Senior Director<br>Valid/Paid</th>
 <td class="col top left right"><?=$snapshot[$p3yyyymm.'.DirectorSD']?:"-"?>/<?=$snapshot[$p3yyyymm.'.DirectorSDPaid']?:"-"?></td>
 <td class="col top left right"><?=$snapshot[$p2yyyymm.'.DirectorSD']?:"-"?>/<?=$snapshot[$p2yyyymm.'.DirectorSDPaid']?:"-"?></td>
 <td class="col top left right"><?=$snapshot[$p1yyyymm.'.DirectorSD']?:"-"?>/<?=$snapshot[$p1yyyymm.'.DirectorSDPaid']?:"-"?></td>
 <td class="col top left right"><?=$snapshot[$yyyymm.'.DirectorSD']?:"-"?>/<?=$snapshot[$yyyymm.'.DirectorSDPaid']?:"-"?></td>
</tr>
<tr>
 <th class="col top left">Executive Director<br>Valid/Paid</th>
 <td class="col top left right"><?=$snapshot[$p3yyyymm.'.DirectorED']?:"-"?>/<?=$snapshot[$p3yyyymm.'.DirectorEDPaid']?:"-"?></td>
 <td class="col top left right"><?=$snapshot[$p2yyyymm.'.DirectorED']?:"-"?>/<?=$snapshot[$p2yyyymm.'.DirectorEDPaid']?:"-"?></td>
 <td class="col top left right"><?=$snapshot[$p1yyyymm.'.DirectorED']?:"-"?>/<?=$snapshot[$p1yyyymm.'.DirectorEDPaid']?:"-"?></td>
 <td class="col top left right"><?=$snapshot[$yyyymm.'.DirectorED']?:"-"?>/<?=$snapshot[$yyyymm.'.DirectorEDPaid']?:"-"?></td>
</tr>
<tr>
 <th class="col top left">Senior Executive Director<br>Valid/Paid</th>
 <td class="col top left right"><?=$snapshot[$p3yyyymm.'.DirectorSED']?:"-"?>/<?=$snapshot[$p3yyyymm.'.DirectorSEDPaid']?:"-"?></td>
 <td class="col top left right"><?=$snapshot[$p2yyyymm.'.DirectorSED']?:"-"?>/<?=$snapshot[$p2yyyymm.'.DirectorSEDPaid']?:"-"?></td>
 <td class="col top left right"><?=$snapshot[$p1yyyymm.'.DirectorSED']?:"-"?>/<?=$snapshot[$p1yyyymm.'.DirectorSEDPaid']?:"-"?></td>
 <td class="col top left right"><?=$snapshot[$yyyymm.'.DirectorSED']?:"-"?>/<?=$snapshot[$yyyymm.'.DirectorSEDPaid']?:"-"?></td>
</tr>
<tr>
 <th class="col top left">Platinum Director<br>Valid/Paid</th>
 <td class="col top left right"><?=$snapshot[$p3yyyymm.'.DirectorPLD']?:"-"?>/<?=$snapshot[$p3yyyymm.'.DirectorPLDPaid']?:"-"?></td>
 <td class="col top left right"><?=$snapshot[$p2yyyymm.'.DirectorPLD']?:"-"?>/<?=$snapshot[$p2yyyymm.'.DirectorPLDPaid']?:"-"?></td>
 <td class="col top left right"><?=$snapshot[$p1yyyymm.'.DirectorPLD']?:"-"?>/<?=$snapshot[$p1yyyymm.'.DirectorPLDPaid']?:"-"?></td>
 <td class="col top left right"><?=$snapshot[$yyyymm.'.DirectorPLD']?:"-"?>/<?=$snapshot[$yyyymm.'.DirectorPLDPaid']?:"-"?></td>
</tr>
<tr>
 <th class="col top left">Presidential Director<br>Valid/Paid</th>
 <td class="col top left right"><?=$snapshot[$p3yyyymm.'.DirectorPRD']?:"-"?>/<?=$snapshot[$p3yyyymm.'.DirectorPRDPaid']?:"-"?></td>
 <td class="col top left right"><?=$snapshot[$p2yyyymm.'.DirectorPRD']?:"-"?>/<?=$snapshot[$p2yyyymm.'.DirectorPRDPaid']?:"-"?></td>
 <td class="col top left right"><?=$snapshot[$p1yyyymm.'.DirectorPRD']?:"-"?>/<?=$snapshot[$p1yyyymm.'.DirectorPRDPaid']?:"-"?></td>
 <td class="col top left right"><?=$snapshot[$yyyymm.'.DirectorPRD']?:"-"?>/<?=$snapshot[$yyyymm.'.DirectorPRDPaid']?:"-"?></td>
</tr>
<tr>
 <th class="col top left">Crown Diamond Director<br>Valid/Paid</th>
 <td class="col top left right"><?=$snapshot[$p3yyyymm.'.DirectorCDD']?:"-"?>/<?=$snapshot[$p3yyyymm.'.DirectorCDDPaid']?:"-"?></td>
 <td class="col top left right"><?=$snapshot[$p2yyyymm.'.DirectorCDD']?:"-"?>/<?=$snapshot[$p2yyyymm.'.DirectorCDDPaid']?:"-"?></td>
 <td class="col top left right"><?=$snapshot[$p1yyyymm.'.DirectorCDD']?:"-"?>/<?=$snapshot[$p1yyyymm.'.DirectorCDDPaid']?:"-"?></td>
 <td class="col top left right"><?=$snapshot[$yyyymm.'.DirectorCDD']?:"-"?>/<?=$snapshot[$yyyymm.'.DirectorCDDPaid']?:"-"?></td>
</tr>
<tr>
 <th class="col top left">Royal Black Diamond Director<br>Valid/Paid</th>
 <td class="col top left right"><?=$snapshot[$p3yyyymm.'.DirectorRBD']?:"-"?>/<?=$snapshot[$p3yyyymm.'.DirectorRBDPaid']?:"-"?></td>
 <td class="col top left right"><?=$snapshot[$p2yyyymm.'.DirectorRBD']?:"-"?>/<?=$snapshot[$p2yyyymm.'.DirectorRBDPaid']?:"-"?></td>
 <td class="col top left right"><?=$snapshot[$p1yyyymm.'.DirectorRBD']?:"-"?>/<?=$snapshot[$p1yyyymm.'.DirectorRBDPaid']?:"-"?></td>
 <td class="col top left right"><?=$snapshot[$yyyymm.'.DirectorRBD']?:"-"?>/<?=$snapshot[$yyyymm.'.DirectorRBDPaid']?:"-"?></td>
</tr>
<tr>
 <th class="col top left">Global Black Diamond Director<br>Valid/Paid</th>
 <td class="col top left right"><?=$snapshot[$p3yyyymm.'.DirectorGBD']?:"-"?>/<?=$snapshot[$p3yyyymm.'.DirectorGBDPaid']?:"-"?></td>
 <td class="col top left right"><?=$snapshot[$p2yyyymm.'.DirectorGBD']?:"-"?>/<?=$snapshot[$p2yyyymm.'.DirectorGBDPaid']?:"-"?></td>
 <td class="col top left right"><?=$snapshot[$p1yyyymm.'.DirectorGBD']?:"-"?>/<?=$snapshot[$p1yyyymm.'.DirectorGBDPaid']?:"-"?></td>
 <td class="col top left right"><?=$snapshot[$yyyymm.'.DirectorGBD']?:"-"?>/<?=$snapshot[$yyyymm.'.DirectorGBDPaid']?:"-"?></td>
</tr>

</table>
<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
</div>
