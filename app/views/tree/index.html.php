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
	$refer = $user['refer'];
//if($user['PV']>0){
	$mcaNumber = $user['mcaNumber'];
	$refer = $user['refer'];
	//print_r($user['ValidTitle']);
 ?>
							[{v:'<?=$mcaNumber?>', f:'\
							<?php if($user['PV']>0){?>\
								<b class="<?php if($user['PV']>0){echo " red ";}else{echo " blue ";}?>">\
									<?=$user['mcaName']?></b><br>\
									PV: <?=$user['PV']?><br>\
									PGPV: <?=$user['PGPV']?><br>\
									RollUpPV: <?=$user['RollUpPV']?><br>\
									PGBV: <?=$user['PGBV']?><br>\
									GBV: <?=$user['GBV']?><br>\
									GPV: <?=$user['GPV']?><br>\
									CGPV: <?=$user['GrossPV']?><br>\
									<b style="color:red"><?php if(strpos($user['PaidTitle'], "Non") !== false){}else{echo $user['PaidTitle'];}?></b>\
									<a href="/tree/index/<?=$mcaNumber?>/<?=$yyyymm?>/<?=$D?>"><?=$mcaNumber?></a>\
								<?php }else{?>\
									<?=$i?><br>\
									<?=$user['mcaName']?><br>\
									PGPV: <?=$user['PGPV']?><br>\
									PGBV: <?=$user['PGBV']?><br>\
									GPV: <?=$user['GPV']?><br>\
									CGPV: <?=$user['GrossPV']?><br>\
									<?=$mcaNumber?><?php }?>\
									'}, '<?=$refer?>',''],
<?php
//}else{
//	$refer = $user['mcaNumber'];
//}
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
   <style>
			.red {color:red}
			</style>
<div style="padding:10px;margin:auto;width:100vw">
<div style="margin:auto;border:1px solid gray">
<!-- <a href="/tree/index/<?=$selfline['refer']?>/<?=$yyyymm?>/<?=$D?>"><?=$selfline['refer']?></a> -->
  <div id="chart_div" style="font-size:12px"></div>
</div>
<ul>
<?php foreach($allusers as $user) {?>
	<?php if(strpos($user['PaidTitle'], "Non") !== false){}elseif($user['PaidTitle']!=""){echo "<li>". $user['mcaName'] . "-" . $user['PaidTitle'] . "</li>";}?>
<?php }?>
</ul>
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