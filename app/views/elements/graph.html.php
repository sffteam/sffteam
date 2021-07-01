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
          title: '<?=$self['mcaName']?> - (<?=$self['mcaNumber']?>) <?=$self[$p1yyyymm]['ValidTitle']?>- GBV Growth',
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
          title: '<?=$self['mcaName']?> - (<?=$self['mcaNumber']?>) - <?=$self[$p1yyyymm]['ValidTitle']?> GBV/GPV ratio and % Increase',
          curveType: 'function',
          legend: { position: 'bottom' }
        };
        var GPVchart = new google.visualization.LineChart(document.getElementById('GPVChart'));
        GPVchart.draw(data, options);
      }
    </script>
