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

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawGBVChart);
      google.charts.setOnLoadCallback(drawGPVChart);

      function drawGBVChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'GBV','GPV'],
          ['<?=$p10yyyymm?>', <?=$self[$p10yyyymm]['GBV']?:0?>, <?=$self[$p10yyyymm]['GPV']?:0?> ],
          ['<?=$p9yyyymm?>', <?=$self[$p9yyyymm]['GBV']?:0?>, <?=$self[$p9yyyymm]['GPV']?:0?> ],
          ['<?=$p8yyyymm?>', <?=$self[$p8yyyymm]['GBV']?:0?>, <?=$self[$p8yyyymm]['GPV']?:0?> ],
          ['<?=$p7yyyymm?>', <?=$self[$p7yyyymm]['GBV']?:0?>, <?=$self[$p7yyyymm]['GPV']?:0?> ],
          ['<?=$p6yyyymm?>', <?=$self[$p6yyyymm]['GBV']?:0?>, <?=$self[$p6yyyymm]['GPV']?:0?> ],
          ['<?=$p5yyyymm?>', <?=$self[$p5yyyymm]['GBV']?:0?>, <?=$self[$p5yyyymm]['GPV']?:0?> ],
          ['<?=$p4yyyymm?>', <?=$self[$p4yyyymm]['GBV']?:0?>, <?=$self[$p4yyyymm]['GPV']?:0?> ],
          ['<?=$p3yyyymm?>', <?=$self[$p3yyyymm]['GBV']?:0?>, <?=$self[$p3yyyymm]['GPV']?:0?> ],
          ['<?=$p2yyyymm?>', <?=$self[$p2yyyymm]['GBV']?:0?>, <?=$self[$p2yyyymm]['GPV']?:0?> ],
          ['<?=$p1yyyymm?>', <?=$self[$p1yyyymm]['GBV']?:0?>, <?=$self[$p1yyyymm]['GPV']?:0?> ],
          ['<?=$yyyymm?>', <?=$self[$yyyymm]['GBV']?:0?>, <?=$self[$yyyymm]['GPV']?:0?> ],
        ]);

        var options = {
          title: '<?=$self['mcaName']?> - (<?=$self['mcaNumber']?>) - GBV Growth',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var GBVchart = new google.visualization.LineChart(document.getElementById('GBVChart'));

        GBVchart.draw(data, options);
      }
      function drawGPVChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'GBV/GPV Ratio','% Increase'],
          ['<?=$p10yyyymm?>', <?=number_format( $self[$p10yyyymm]['GBV']/$self[$p10yyyymm]['GPV'],0)?>, <?=number_format((($self[$p10yyyymm]['GBV']/$p10yyyymmdays)-($self[$p11yyyymm]['GBV']/$p11yyyymmdays))/($self[$p11yyyymm]['GBV']/$p11yyyymmdays)*100,0,".","")?> ],
          ['<?=$p9yyyymm?>', <?=number_format( $self[$p9yyyymm]['GBV']/$self[$p9yyyymm]['GPV'],0)?>, <?=number_format((($self[$p9yyyymm]['GBV']/$p9yyyymmdays)-($self[$p10yyyymm]['GBV']/$p10yyyymmdays))/($self[$p10yyyymm]['GBV']/$p10yyyymmdays)*100,0,".","")?> ],
          ['<?=$p8yyyymm?>', <?=number_format( $self[$p8yyyymm]['GBV']/$self[$p8yyyymm]['GPV'],0)?>, <?=number_format((($self[$p8yyyymm]['GBV']/$p8yyyymmdays)-($self[$p9yyyymm]['GBV']/$p9yyyymmdays))/($self[$p9yyyymm]['GBV']/$p9yyyymmdays)*100,0,".","")?> ],
          ['<?=$p7yyyymm?>', <?=number_format( $self[$p7yyyymm]['GBV']/$self[$p7yyyymm]['GPV'],0)?>, <?=number_format((($self[$p7yyyymm]['GBV']/$p7yyyymmdays)-($self[$p8yyyymm]['GBV']/$p8yyyymmdays))/($self[$p8yyyymm]['GBV']/$p8yyyymmdays)*100,0,".","")?> ],
          ['<?=$p6yyyymm?>', <?=number_format( $self[$p6yyyymm]['GBV']/$self[$p6yyyymm]['GPV'],0)?>, <?=number_format((($self[$p6yyyymm]['GBV']/$p6yyyymmdays)-($self[$p7yyyymm]['GBV']/$p7yyyymmdays))/($self[$p7yyyymm]['GBV']/$p7yyyymmdays)*100,0,".","")?> ],
          ['<?=$p5yyyymm?>', <?=number_format( $self[$p5yyyymm]['GBV']/$self[$p5yyyymm]['GPV'],0)?>, <?=number_format((($self[$p5yyyymm]['GBV']/$p5yyyymmdays)-($self[$p6yyyymm]['GBV']/$p6yyyymmdays))/($self[$p6yyyymm]['GBV']/$p6yyyymmdays)*100,0,".","")?> ],
          ['<?=$p4yyyymm?>', <?=number_format( $self[$p4yyyymm]['GBV']/$self[$p4yyyymm]['GPV'],0)?>, <?=number_format((($self[$p4yyyymm]['GBV']/$p4yyyymmdays)-($self[$p5yyyymm]['GBV']/$p5yyyymmdays))/($self[$p5yyyymm]['GBV']/$p5yyyymmdays)*100,0,".","")?> ],
          ['<?=$p3yyyymm?>', <?=number_format( $self[$p3yyyymm]['GBV']/$self[$p3yyyymm]['GPV'],0)?>, <?=number_format((($self[$p3yyyymm]['GBV']/$p3yyyymmdays)-($self[$p4yyyymm]['GBV']/$p4yyyymmdays))/($self[$p4yyyymm]['GBV']/$p4yyyymmdays)*100,0,".","")?> ],
          ['<?=$p2yyyymm?>', <?=number_format( $self[$p2yyyymm]['GBV']/$self[$p2yyyymm]['GPV'],0)?>, <?=number_format((($self[$p2yyyymm]['GBV']/$p2yyyymmdays)-($self[$p3yyyymm]['GBV']/$p3yyyymmdays))/($self[$p3yyyymm]['GBV']/$p3yyyymmdays)*100,0,".","")?> ],
          ['<?=$p1yyyymm?>', <?=number_format( $self[$p1yyyymm]['GBV']/$self[$p1yyyymm]['GPV'],0)?>, <?=number_format((($self[$p1yyyymm]['GBV']/$p1yyyymmdays)-($self[$p2yyyymm]['GBV']/$p2yyyymmdays))/($self[$p2yyyymm]['GBV']/$p2yyyymmdays)*100,0,".","")?> ],
          ['<?=$yyyymm?>', <?=number_format( $self[$yyyymm]['GBV']/$self[$yyyymm]['GPV'],0)?>, <?=number_format((($self[$yyyymm]['GBV']/$yyyymmdays)-($self[$p1yyyymm]['GBV']/$p1yyyymmdays))/($self[$p1yyyymm]['GBV']/$p1yyyymmdays)*100,0,".","")?> ],
        ]);

        var options = {
          title: '<?=$self['mcaName']?> - (<?=$self['mcaNumber']?>) - GBV/GPV ratio and % Increase',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        
        var GPVchart = new google.visualization.LineChart(document.getElementById('GPVChart'));
        
        GPVchart.draw(data, options);
      }
    </script>
<table  border="1">
<tr>
 <td class="col top left"><small>YYYY-MM</small></td>
 <td class="col top left"><?=$p10yyyymm?></td>
 <td class="col top left"><?=$p9yyyymm?></td>
 <td class="col top left"><?=$p8yyyymm?></td>
 <td class="col top left"><?=$p7yyyymm?></td>
 <td class="col top left"><?=$p6yyyymm?></td>
 <td class="col top left"><?=$p5yyyymm?></td>
 <td class="col top left"><?=$p4yyyymm?></td>
 <td class="col top left"><?=$p3yyyymm?></td>
 <td class="col top left"><?=$p2yyyymm?></td>
 <td class="col top left"><?=$p1yyyymm?></td>
 <td class="col top left right"><?=$yyyymm?></td>
</tr>
<tr>
 <td class="col top left">PV</td>
 <td class="col top left"><?=$self[$p10yyyymm]['PV']?></td>
 <td class="col top left"><?=$self[$p9yyyymm]['PV']?></td>
 <td class="col top left"><?=$self[$p8yyyymm]['PV']?></td>
 <td class="col top left"><?=$self[$p7yyyymm]['PV']?></td>
 <td class="col top left"><?=$self[$p6yyyymm]['PV']?></td>
 <td class="col top left"><?=$self[$p5yyyymm]['PV']?></td>
 <td class="col top left"><?=$self[$p4yyyymm]['PV']?></td>
 <td class="col top left"><?=$self[$p3yyyymm]['PV']?></td>
 <td class="col top left"><?=$self[$p2yyyymm]['PV']?></td>
 <td class="col top left"><?=$self[$p1yyyymm]['PV']?></td>
 <td class="col top left right"><?=$self[$yyyymm]['PV']?></td>
</tr>
<tr >
 <td class="col top left">GPV</td>
 <td class="col top left"><?=$self[$p10yyyymm]['GPV']?></td>
 <td class="col top left"><?=$self[$p9yyyymm]['GPV']?></td>
 <td class="col top left"><?=$self[$p8yyyymm]['GPV']?></td>
 <td class="col top left"><?=$self[$p7yyyymm]['GPV']?></td>
 <td class="col top left"><?=$self[$p6yyyymm]['GPV']?></td>
 <td class="col top left"><?=$self[$p5yyyymm]['GPV']?></td>
 <td class="col top left"><?=$self[$p4yyyymm]['GPV']?></td>
 <td class="col top left"><?=$self[$p3yyyymm]['GPV']?></td>
 <td class="col top left"><?=$self[$p2yyyymm]['GPV']?></td>
 <td class="col top left"><?=$self[$p1yyyymm]['GPV']?></td>
 <td class="col top left right"><?=$self[$yyyymm]['GPV']?></td>
</tr>
<tr>
 <td class="col top left">GBV</td>
 <td class="col top left"><?=$self[$p10yyyymm]['GBV']?></td>
 <td class="col top left"><?=$self[$p9yyyymm]['GBV']?></td>
 <td class="col top left"><?=$self[$p8yyyymm]['GBV']?></td>
 <td class="col top left"><?=$self[$p7yyyymm]['GBV']?></td>
 <td class="col top left"><?=$self[$p6yyyymm]['GBV']?></td>
 <td class="col top left"><?=$self[$p5yyyymm]['GBV']?></td>
 <td class="col top left"><?=$self[$p4yyyymm]['GBV']?></td>
 <td class="col top left"><?=$self[$p3yyyymm]['GBV']?></td>
 <td class="col top left"><?=$self[$p2yyyymm]['GBV']?></td>
 <td class="col top left"><?=$self[$p1yyyymm]['GBV']?></td>
 <td class="col top left right"><?=$self[$yyyymm]['GBV']?></td>
</tr>
<tr>
 <td class="col top left">GBV/day</td>
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
 <td class="col top left"><small>GBV/PGV</small></td>
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
 <td class="col top left bottom"><small>BV &#8593;%</small></td>
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
 <td class="col top left bottom"><?=number_format((($self[$yyyymm]['GBV']/$yyyymmdays)-($self[$p1yyyymm]['GBV']/$p1yyyymmdays))/($self[$p1yyyymm]['GBV']/$p1yyyymmdays)*100,0)?>%</td>
</tr>
<tr>
 <td>Title</td>
 <td><small><?=$self[$p10yyyymm]['PaidTitle']?></small></td>
 <td><small><?=$self[$p9yyyymm]['PaidTitle']?></small></td>
 <td><small><?=$self[$p8yyyymm]['PaidTitle']?></small></td>
 <td><small><?=$self[$p7yyyymm]['PaidTitle']?></small></td>
 <td><small><?=$self[$p6yyyymm]['PaidTitle']?></small></td>
 <td><small><?=$self[$p5yyyymm]['PaidTitle']?></small></td>
 <td><small><?=$self[$p4yyyymm]['PaidTitle']?></small></td>
 <td><small><?=$self[$p3yyyymm]['PaidTitle']?></small></td>
 <td><small><?=$self[$p2yyyymm]['PaidTitle']?></small></td>
 <td><small><?=$self[$p1yyyymm]['PaidTitle']?></small></td>
 <td><small></small></td>
</tr>
</table>
<p>GBV/GPV is BV to PV ratio. This ratio is ideally 27. It reduces when you take advantage of Extra PV. Without Extra PV this ratio is always 27.</p>
<div id="GBVChart" style="width: 100%; height: 300px"></div>
<div id="GPVChart" style="width: 100%; height: 300px"></div>
<hr>
Your team who have completed PV in this month
<table border=1>
 <tr>
 <td class="szhalf">Name</td>
 <td class="szhalf">MCA No</td>
 <td class=" szhalf">PV</td>
 <td class=" szhalf">GPV</td>
 <td class=" szhalf">GBV</td>
 <td class=" szhalf">GBV/GPV %</td>
 <td class=" szhalf">Growth</td>
 </tr>
<?php 
foreach($team as $t){
 ?>
<tr>
 <td class="align-left">
 <?php if($t['refer_id']==$self['mcaNumber']){
  echo "&#9728;";
 }
 ?>
 <a href="/malls/ytdgpv/<?=$t['mcaNumber']?>" class="link external"><?=$t['mcaName']?></a> (+91<?=$t['Mobile']?>) <?=$t[$yyyymm]['ValidTitle']?> <?=$t[$yyyymm]['Percent']?>%</td>
 <td class="align-left"><?=$t['mcaNumber']?></td>
 <td><?=$t[$yyyymm]['PV']?></td>
 <td><?=$t[$yyyymm]['GPV']?></td>
 <td><?=$t[$yyyymm]['GBV']?></td>
 <td><?=number_format($t[$yyyymm]['GBV']/$t[$yyyymm]['GPV'],0)?></td>
 <td><?=number_format((($t[$yyyymm]['GBV']/$yyyymmdays)-($t[$p1yyyymm]['GBV']/$p1yyyymmdays))/($t[$p1yyyymm]['GBV']/$p1yyyymmdays)*100,0)?>%</td>
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
<p>If you do business at the current rate of this month in the next month and maintain 20% in subsequent months. You will have to your own PV and build your team along with title. Your GPV and GBV will grow and your Cheque will be 10% commission based on your GBV.</p>
<table  border="1">
<tr>
 <td ><small>YYYY-MM</small></td>
 <td ><small><?=$n1yyyymm?></small></td>
 <td ><small><?=$n2yyyymm?></small></td>
 <td ><small><?=$n3yyyymm?></small></td>
 <td ><small><?=$n4yyyymm?></small></td>
 <td ><small><?=$n5yyyymm?></small></td>
 <td ><small><?=$n6yyyymm?></small></td>
 <td ><small><?=$n7yyyymm?></small></td>
 <td ><small><?=$n9yyyymm?></small></td>
 <td ><small><?=$n10yyyymm?></small></td>
 <td ><small><?=$n11yyyymm?></small></td>
</tr>
<tr>
 <td ><small>GPV</small></td>
 <td ><small><?=number_format($rate*$self[$yyyymm]['GPV']/$yyyymmdays*$n1yyyymmdays,0)?></small></td>
 <td ><small><?=number_format($rate*$nrate*$self[$yyyymm]['GPV']/$yyyymmdays*$n2yyyymmdays,0)?></small></td>
 <td ><small><?=number_format($rate*$nrate*$nrate*$self[$yyyymm]['GPV']/$yyyymmdays*$n3yyyymmdays,0)?></small></td>
 <td ><small><?=number_format($rate*$nrate*$nrate*$nrate*$self[$yyyymm]['GPV']/$yyyymmdays*$n4yyyymmdays,0)?></small></td>
 <td ><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$self[$yyyymm]['GPV']/$yyyymmdays*$n5yyyymmdays,0)?></small></td>
 <td ><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$nrate*$self[$yyyymm]['GPV']/$yyyymmdays*$n6yyyymmdays,0)?></small></td>
 <td ><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$self[$yyyymm]['GPV']/$yyyymmdays*$n7yyyymmdays,0)?></small></td>
 <td ><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$self[$yyyymm]['GPV']/$yyyymmdays*$n8yyyymmdays,0)?></small></td>
 <td ><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$self[$yyyymm]['GPV']/$yyyymmdays*$n9yyyymmdays,0)?></small></td>
 <td ><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$self[$yyyymm]['GPV']/$yyyymmdays*$n10yyyymmdays,0)?></small></td>
</tr>
<tr>
 <td ><small>GBV</small></td>
 <td ><small><?=number_format($rate*$self[$yyyymm]['GBV'],0)?></small></td>
 <td ><small><?=number_format($rate*$nrate*$self[$yyyymm]['GBV'],0)?></small></td>
 <td ><small><?=number_format($rate*$nrate*$nrate*$self[$yyyymm]['GBV'],0)?></small></td>
 <td ><small><?=number_format($rate*$nrate*$nrate*$nrate*$self[$yyyymm]['GBV'],0)?></small></td>
 <td ><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$self[$yyyymm]['GBV'],0)?></small></td>
 <td ><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$nrate*$self[$yyyymm]['GBV'],0)?></small></td>
 <td ><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$self[$yyyymm]['GBV'],0)?></small></td>
 <td ><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$self[$yyyymm]['GBV'],0)?></small></td>
 <td ><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$self[$yyyymm]['GBV'],0)?></small></td>
 <td ><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$self[$yyyymm]['GBV'],0)?></small></td>
</tr>
<tr>
 <td ><small>Your Cheque (Approx)</small></td>
 <td ><small><?=number_format($rate*$self[$yyyymm]['GBV']*.1,0)?></small></td>
 <td ><small><?=number_format($rate*$nrate*$self[$yyyymm]['GBV']*.1,0)?></small></td>
 <td ><small><?=number_format($rate*$nrate*$nrate*$self[$yyyymm]['GBV']*.1,0)?></small></td>
 <td ><small><?=number_format($rate*$nrate*$nrate*$nrate*$self[$yyyymm]['GBV']*.1,0)?></small></td>
 <td ><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$self[$yyyymm]['GBV']*.1,0)?></small></td>
 <td ><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$nrate*$self[$yyyymm]['GBV']*.1,0)?></small></td>
 <td ><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$self[$yyyymm]['GBV']*.1,0)?></small></td>
 <td ><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$self[$yyyymm]['GBV']*.1,0)?></small></td>
 <td ><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$self[$yyyymm]['GBV']*.1,0)?></small></td>
 <td ><small><?=number_format($rate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$nrate*$self[$yyyymm]['GBV']*.1,0)?></small></td>
</tr>
</table>
<br>
<br>
<hr>