<?php
 $yyyymm = date('Y-m');
 $yyyymmdays=date(d)-1;
?>
<script  src="https://www.gstatic.com/charts/loader.js"></script>
    <script >
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawGPVChart);

      function drawGPVChart() {
        var data = google.visualization.arrayToDataTable([
        <?php 
        $yyyymm = date("Y-m", strtotime('today - 1 days') );
        $prevDate = date("Y-m-d", strtotime('today - 0 days') );
        $nameString = "['MMM-DD',";
        echo $nameString;
        foreach($team as $t){
         if($t[$yyyymm][$prevDate]['GPV']!=0){
           echo "'".$t['mcaName']."',";
         }
        }
         echo "''],\n";
         $nameString = "[";
         for($i=6;$i>=0;$i--){ // change to number of days max 40
           $prevDate = date("Y-m-d", strtotime('today - '.$i.' days') );
           $XprevDate = date("M-d", strtotime('today - '.$i.' days') );
           $yyyymm = date("Y-m", strtotime('today - '.$i.' days') );
           $nameString = $nameString . "'".$XprevDate."'";
           foreach($team as $t){
            if($t[$yyyymm][$prevDate]['GPV']!=0){
             $nameString = $nameString .  ',';
             if($t[$yyyymm][$prevDate]['GPV']==="" || $t[$yyyymm][$prevDate]['GPV']===null){
              $nameString = $nameString .  "0";
             }else{
              $nameString = $nameString . $t[$yyyymm][$prevDate]['GPV']?:0;
             }
            }
           }
          $nameString = $nameString .  ",0],\n[";
        }
          $nameString = $nameString .  "]\n";
          echo substr($nameString,0,-3);
        ?>
        ]);
        var options = {
          title: '<?=$self['mcaName']?> - (<?=$self['mcaNumber']?>) - <?=$self[$p1yyyymm]['ValidTitle']?> Team GPV Increase',
          curveType: 'function',
          legend: { position: 'bottom' }
        };
        var GPVchart = new google.visualization.LineChart(document.getElementById('GPVChart'));
        GPVchart.draw(data, options);
      }
    </script>
