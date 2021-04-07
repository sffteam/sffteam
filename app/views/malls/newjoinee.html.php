<table>
  <tr>
  <td class="col">Name</td>
  <td class="col">Mobile</td>
  <td class="col">#</td>
  <td class="col">mcaNumber</td>
  <td class="col">DateJoin</td>
  <td class="col">KYC</td>
  <td class="col">NEFT</td>
  <td class="col">PV</td>
  <td class="col">GPV</td>
  <td class="col">Upline</td>
  </tr>

<?php
$i=0;
foreach($joineeUsers as $j){
 $i++;
 ?>
  <tr>
  <td class="col"><?=$j['mcaName']?></td>
  <td class="col">+91<?=$j['Mobile']?></td>
  <td class="col"><?=$i?></td>
  <td class="col"><?=$j['mcaNumber']?></td>
  <td class="col"><?=$j['DateJoin']?></td>
  <td class="col"><?=$j['KYC']?></td>
  <td class="col"><?=$j['NEFT']?></td>
  <td class="col"><?=$j['PV']?></td>
  <td class="col"><?=$j['GPV']?></td>
  <td class="col"><?=$j['Upline']?></td>
  </tr>
 
<?php 
 }
?>
</table>