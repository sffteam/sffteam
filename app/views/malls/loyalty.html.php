<?php 
 $yyyymm = date('Y-m');
 $p1yyyymm = date("Y-m", strtotime("-1 month", strtotime(date("F") . "1")) );
 $p2yyyymm = date("Y-m", strtotime("-2 month", strtotime(date("F") . "1")) );
 $p3yyyymm = date("Y-m", strtotime("-3 month", strtotime(date("F") . "1")) );
 $p4yyyymm = date("Y-m", strtotime("-4 month", strtotime(date("F") . "1")) );
 $p5yyyymm = date("Y-m", strtotime("-5 month", strtotime(date("F") . "1")) );
 $p6yyyymm = date("Y-m", strtotime("-6 month", strtotime(date("F") . "1")) );
?>
<table  border="1" class="Roboto">
<tr>
 <th class="col top left" ><small>#</small></th>
 <th class="col top left" ><small>Loyalty BV</small></th>
 <th class="col top left" ><small>MCA No</small></th>
 <th class="col top left" ><small>Mobile</small></th>
 <th class="col top left"><?=$p6yyyymm?></th>
 <th class="col top left"><?=$p5yyyymm?></th>
 <th class="col top left"><?=$p4yyyymm?></th>
 <th class="col top left"><?=$p3yyyymm?></th>
 <th class="col top left"><?=$p2yyyymm?></th>
 <th class="col top left"><?=$p1yyyymm?></th>
 <th class="col top left right"><?=$yyyymm?></th>
</tr>
<?php 
  $i=1;
 foreach($team as $t){
  
  if(
     $t[$p6yyyymm]['BV']>900 &&
     $t[$p5yyyymm]['BV']>900 &&
     $t[$p4yyyymm]['BV']>900 &&
     $t[$p3yyyymm]['BV']>900 &&
     $t[$p2yyyymm]['BV']>900 &&
     $t[$p1yyyymm]['BV']>900 &&
     $t[$yyyymm]['BV']>900
    ){
     
     
 ?>
<tr>
 <td class="col top left"><small><?=$i?></small></td>
 <td class="col top left"><small><a href="/malls/loyalty/<?=$t['mcaNumber']?>" class="external link"><?=$t['mcaName']?></a></small></td>
 <td class="col top left"><small><a href="/tree/index/<?=$t['mcaNumber']?>/<?=$yyyymm?>/D/" target="_blank" class="external link"><?=$t['mcaNumber']?></a></small></td>
 <td class="col top left"><small>+91<?=$t['Mobile']?></small></td>
 <td class="col top left"><?=$t[$p6yyyymm]['BV']?></td>
 <td class="col top left"><?=$t[$p5yyyymm]['BV']?></td>
 <td class="col top left"><?=$t[$p4yyyymm]['BV']?></td>
 <td class="col top left"><?=$t[$p3yyyymm]['BV']?></td>
 <td class="col top left"><?=$t[$p2yyyymm]['BV']?></td>
 <td class="col top left"><?=$t[$p1yyyymm]['BV']?></td>
 <td class="col top left right"><?=$t[$yyyymm]['BV']?></td>
</tr> 
   <?php 
   $i++;
   }
   
   }?>
</table>

