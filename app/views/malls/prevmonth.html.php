<div class="block page-content">
<h1 class="Raleway sz1"><strong><?=$self['mcaName']?> - (<a href="/tree/index/<?=$self['mcaNumber']?>/<?=$yyyymm?>/d" class="external links" title="Open Tree Structure" target="_blank"><?=$self['mcaNumber']?></a>) <?=$self[$yyyymm]['PaidTitle']?> - <?=$self['DateJoin']?> <br><small>KYC: <?=$self['KYC']?>, NEFT: <?=$self['NEFT']?>  <a href="/malls/snapshot/<?=$self['mcaNumber']?>" class="external link">Snapshot</a></small></strong></h1>

<h1 class="Raleway sz1">Team PV for <?=$yyyymm?></h1>
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
 <th class=" szhalf col top left ">RollUpPV</th>
 </tr>

 <tr>
 <td class="szhalf col top left ">0</td>
 <td class="szhalf col top left "><?=$self['mcaName']?></td>
 <td class="szhalf col top left "><?=$self['mcaNumber']?></td>
 <td class=" szhalf col top left "><?=$self[$yyyymm]['PV']?></td>
 <td class=" szhalf col top left bg-color-red "><?=$self[$yyyymm]['GPV']?></td>
 <td class=" szhalf col top left "><?=$self[$yyyymm]['TotalEPV']?></td>
 <td class=" szhalf col top left "><?=$self[$yyyymm]['PGPV']?></td>
 <td class=" szhalf col top left "><?=$self[$yyyymm]['GBV']?></td>
 <td class=" szhalf col top left "><?=$self[$yyyymm]['RollUpPV']?></td>
 </tr>

<?php $i=1;foreach($team as $t){?>
 <tr>
 <td class="szhalf col top left  bottom"><?=$i?></td>
 <td class="text-align-left col top left  bottom">
 <?php if($t['refer_id']==$self['mcaNumber']){
  echo "&#9728;";
 }
 ?>
 <a href="/malls/ytdgpv/<?=$t['mcaNumber']?>" title="Open <?=$t['mcaName']?> report" class="link external"><small><?=$t['mcaName']?></small></a> <small><a href="tel:+91<?=$t['Mobile']?>" class="external link">(+91<?=$t['Mobile']?>)</a> <?=$t[$yyyymm]['ValidTitle']?> <?=$t[$yyyymm]['Percent']?>%</small></td>
 <td class="  top left text-align-left bottom"><a href="/tree/index/<?=$t['mcaNumber']?>/<?=$yyyymm?>/d" class="external" title="Open Tree Structure" target="_blank"><?=$t['mcaNumber']?></a></td>
 <td class="szhalf  top left bottom "><?=$t[$yyyymm]['PV']?></td>
 <td class="szhalf  top left bottom bg-color-pink"><?=$t[$yyyymm]['GPV']?></td>
 <td class="szhalf  top left bottom "><?=$t[$yyyymm]['TotalEPV']?></td>
 <td class="szhalf  top left bottom "><?=$t[$yyyymm]['PGPV']?></td>
 <td class="szhalf  top left bottom "><?=$t[$yyyymm]['GBV']?></td>
 <td class="szhalf  top left bottom"><?=$t[$yyyymm]['RollUpPV']?></td>
 
 </tr>

<?php $i++;} ?>
</table>


</div>