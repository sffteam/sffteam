<?php 
 $yyyymm = date('Y-m');
 $p1yyyymm = date("Y-m", strtotime("-1 month", strtotime(date("F") . "1")) );
 $p2yyyymm = date("Y-m", strtotime("-2 month", strtotime(date("F") . "1")) );
 $p3yyyymm = date("Y-m", strtotime("-3 month", strtotime(date("F") . "1")) );
 $p4yyyymm = date("Y-m", strtotime("-4 month", strtotime(date("F") . "1")) );
 $p5yyyymm = date("Y-m", strtotime("-5 month", strtotime(date("F") . "1")) );
 $p6yyyymm = date("Y-m", strtotime("-6 month", strtotime(date("F") . "1")) );
?>
<h1 class="Raleway sz1"><strong><?=$self['mcaName']?> - (<a href="/tree/index/<?=$self['mcaNumber']?>/<?=$yyyymm?>/d" class="external links" title="Open Tree Structure" target="_blank"><?=$self['mcaNumber']?></a>) <?=$self[$yyyymm]['PaidTitle']?> - <?=$self['DateJoin']?> <br><small>KYC: <?=$self['KYC']?>, NEFT: <?=$self['NEFT']?>  <a href="/malls/snapshot/<?=$self['mcaNumber']?>" class="external link">Snapshot</a> - <a href="/malls/daily/<?=$self['mcaNumber']?>" class="external link">Daily</a></small> Daily GPV report <a href="/malls/growth/<?=$self['mcaNumber']?>" class="external link">Monthly Growth</a> <a href="/malls/loyalty/<?=$self['mcaNumber']?>" class="external link">Loyalty</a></small> </strong></h1>
<table  border="1" class="Roboto">
<tr>
 <th class="col top left" ><small>#</small></th>
 <th class="col top left" ><small>Loyalty DP</small></th>
 <th class="col top left" ><small>MCA No</small></th>
	<th class="col top left" ><small>Leader</small></th>
 <th class="col top left" ><small>Mobile</small></th>
 <th class="col top left"><?=$p6yyyymm?></th>
 <th class="col top left"><?=$p5yyyymm?></th>
 <th class="col top left"><?=$p4yyyymm?></th>
 <th class="col top left"><?=$p3yyyymm?></th>
 <th class="col top left"><?=$p2yyyymm?></th>
 <th class="col top left"><?=$p1yyyymm?></th>
 <th class="col top left right"><?=$yyyymm?></th>
</tr>
<tr>
 <td class="col top left" ><small>0</small></td>
 <td class="col top left" ><small><?=$self['mcaName']?></small></td>
<td class="col top left"><small><a href="/malls/ytdgpv/<?=$self['mcaNumber']?>/<?=$yyyymm?>/D/" target="_blank" class="external link"><?=$self['mcaNumber']?></a></small></td>
	<td class="col top left"><small><a href="/malls/ytdgpv/<?=$self['refer']?>/<?=$yyyymm?>/D/" target="_blank" class="external link"><?=$self['refer']?></a></small></td>
 <td class="col top left"><small>+91<?=$self['Mobile']?></small></td>
 <td class="col top left"><?=$self[$p6yyyymm]['BV']*2?></td>
 <td class="col top left"><?=$self[$p5yyyymm]['BV']*2?></td>
 <td class="col top left"><?=$self[$p4yyyymm]['BV']*2?></td>
 <td class="col top left"><?=$self[$p3yyyymm]['BV']*2?></td>
 <td class="col top left"><?=$self[$p2yyyymm]['BV']*2?></td>
 <td class="col top left"><?=$self[$p1yyyymm]['BV']*2?></td>
 <td class="col top left right"><?=$self[$yyyymm]['BV']*2?></td>
</tr>
<?php 
  $i=1;
 foreach($team as $t){
  
  if(
     $t[$p6yyyymm]['BV']>900 ||
     $t[$p5yyyymm]['BV']>900 ||
     $t[$p4yyyymm]['BV']>900 ||
     $t[$p3yyyymm]['BV']>900 ||
     $t[$p2yyyymm]['BV']>900 ||
     $t[$p1yyyymm]['BV']>900 ||
     $t[$yyyymm]['BV']>900
    ){
     
     
 ?>
<tr>
 <td class="col top left"><small><?=$i?></small></td>
 <td class="col top left"><small><a href="/malls/loyalty/<?=$t['mcaNumber']?>" class="external link"><?=$t['mcaName']?></a></small></td>
 <td class="col top left"><small><a href="/malls/ytdgpv/<?=$t['mcaNumber']?>/<?=$yyyymm?>/D/" target="_blank" class="external link"><?=$t['mcaNumber']?></a></small></td>
	<td class="col top left"><small><a href="/malls/ytdgpv/<?=$t['refer']?>/<?=$yyyymm?>/D/" target="_blank" class="external link"><?=$t['refer']?></a></small></td>
 <td class="col top left"><small>+91<?=$t['Mobile']?></small></td>
 <td class="col top left"><?=$t[$p6yyyymm]['BV']*2?></td>
 <td class="col top left"><?=$t[$p5yyyymm]['BV']*2?></td>
 <td class="col top left"><?=$t[$p4yyyymm]['BV']*2?></td>
 <td class="col top left"><?=$t[$p3yyyymm]['BV']*2?></td>
 <td class="col top left"><?=$t[$p2yyyymm]['BV']*2?></td>
 <td class="col top left"><?=$t[$p1yyyymm]['BV']*2?></td>
 <td class="col top left right"><?=$t[$yyyymm]['BV']*2?></td>
</tr> 
   <?php 
   $i++;
   }
   
   }?>
</table>

