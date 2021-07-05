<div class="block page-content">
<h1 class="Raleway sz1"><strong><?=$self['mcaName']?> - (<a href="/tree/index/<?=$self['mcaNumber']?>/<?=$yyyymm?>/d" class="external links" title="Open Tree Structure" target="_blank"><?=$self['mcaNumber']?></a>) <?=$self[$yyyymm]['PaidTitle']?> - <?=$self['DateJoin']?> <br><small>KYC: <?=$self['KYC']?>, NEFT: <?=$self['NEFT']?>  </small></strong></h1>

<table class="table szhalf">
 <tr>
  <th> #</th>
  <th> Name</th>
  <th> MCA</th>
  <th> DateJoin</th>
  <th> PV</th>
  <th> BV</th>  
  <th> GPV</th>
  <th> GBV</th>
  <th> KYC</th>
  <th> NEFT</th>
 </tr>
 <tr>
  <td> 1</td>
  <td> <?=$self['mcaName']?></td>
  <td> <?=$self['mcaNumber']?></td>
  <td> <?=$self['DateJoin']?></td>
  <td> <?=$self[$yyyymm]['PV']?></td>
  <td> <?=$self[$yyyymm]['BV']?></td>
  <td> <?=$self[$yyyymm]['GPV']?></td>
  <td> <?=$self[$yyyymm]['GBV']?></td>
  <td> <?=$self['KYC']?></td>
  <td> <?=$self['NEFT']?></td>
 </tr>
<?php $i = 1;
$totalGPV = 0; $totalPV = 0;$totalBV = 0; $totalGBV = 0;
foreach($team as $t){
 $i++;
?>
<?php if(date('M',strtotime($t['DateJoin']))==date('M',strtotime($yyyymm))){ ?>
 <tr class="bg-color-pink">
<?php }else{?>
 <tr>
<?php }?> 
  <td> <?=$i?></td>
  <td> <a  href="/malls/qualifiers/<?=$t['mcaNumber']?>/<?=$yyyymm?>" class="text-color-black external link"><?=$t['mcaName']?></a></td>
  <td> <?=$t['mcaNumber']?></td>
  <td> <?=$t['DateJoin']?></td>
<?php  if(date('M',strtotime($t['DateJoin']))==date('M',strtotime($yyyymm))){
  $totalPV = $totalPV + $t[$yyyymm]['PV'];
  $totalBV = $totalBV + $t[$yyyymm]['BV'];
  $totalGPV = $totalGPV + $t[$yyyymm]['GPV'];
  $totalGBV = $totalGBV + $t[$yyyymm]['GBV'];
}
?>  
  <td> <?=$t[$yyyymm]['PV']?></td>
  <td> <?=$t[$yyyymm]['GPV']?></td>
  <td> <?=$t[$yyyymm]['GPV']?></td>
  <td> <?=$t[$yyyymm]['GBV']?></td>
  <td> <?=$t['KYC']?></td>
  <td> <?=$t['NEFT']?></td>
 </tr>
<?php 
}
?>
 <tr>
  <td></td>
  <td></td>
  <td></td>
  <td>Total</td>
  <td> <?=$totalPV + $self[$yyyymm]['PV']?></td>
  <td> <?=$totalBV + $self[$yyyymm]['BV']?></td>
  <td> <?=$totalGPV?></td>
  <td> <?=$totalGBV + $self[$yyyymm]['GBV']?></td>
 </tr>

</table>
</div>