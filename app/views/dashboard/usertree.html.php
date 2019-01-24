<?php 
use lithium\storage\Session;
$session = Session::read('session');
setlocale(LC_MONETARY, 'hi_IN');
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load('current', {packages:["orgchart"]});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Number');
        data.addColumn('string', 'Name');
        data.addColumn('string', 'ToolTip');
	data.addRows([
 
<?php 




$i = 1; $j = 0;
foreach($allusers as $user) {
//print_r($user);
 ?>
							[{v:'<?=$user['mcaNumber']?>', f:'<?=$i;?><br><b style="font-size:14px;color:red"><a href="/dashboard/users/<?=$user['mcaNumber']?>"><?=$user['mcaName']?></a></b><br>GBV: <?=$user['GBV']?><br>PBV: <?=$user['PBV']?><br><a href="/dashboard/updateuser/<?=$user['mcaNumber']?>">DP. <?=$user['DP']?></a><br><a href="/dashboard/usertree/<?=$user['mcaNumber']?>"><?=$user['mcaNumber']?></a>'}, '<?=$user['refer']?>',''],
<?php
$i++;
} ?>
     ]);   
        
        
        // For each orgchart box, provide the name, manager, and tooltip to show.
/*
        data.addRows([
          [{v:'Mike', f:'Mike<div style="color:red; font-style:italic">President</div>'},
           '', 'The President'],
          [{v:'Jim', f:'Jim<div style="color:red; font-style:italic">Vice President</div>'},
           'Mike', 'VP'],
          ['Alice', 'Mike', ''],
          ['Bob', 'Jim', 'Bob Sponge'],
          ['Carol', 'Bob', '']
        ]);
*/
        // Create the chart.
        var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
        // Draw the chart, setting the allowHtml option to true for the tooltips.
        chart.draw(data, {allowHtml:true});
      }
   </script>
   
<div style="padding:10px;margin:auto;width:300%">
<div style="margin:auto;border:1px solid gray">
  <div id="chart_div" style="font-size:12px"></div>
</div>
</div>
<?php
function moneyFormatIndia($num){
	
    $explrestunits = "" ;
    if(strlen($num)>3){
        $lastthree = substr($num, strlen($num)-3, strlen($num));
        $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
        $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
        $expunit = str_split($restunits, 2);
        for($i=0; $i<sizeof($expunit); $i++){
            // creates each of the 2's group and adds a comma to the end
            if($i==0)
            {
                $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
            }else{
                $explrestunits .= $expunit[$i].",";
            }
        }
        $thecash = $explrestunits.$lastthree;
    } else {
        $thecash = $num;
    }
    return $thecash; // writes the final format where $currency is the currency symbol.
}
?>