<?php $yyyymm = date('Y-m');?>
<table border="1" class="Roboto">
 <tr>
  <th>Name</th>
  <th>Mobile</th>
  <th>MCA</th>
  <th>PV</th>
  <th>GPV</th>
  <th>CGPV</th>
  <th>GBV</th>
 </tr>
<?php foreach($team as $t){?>
 <tr>
  <td class="align-left"><?=$t['mcaName']?></td>
  <td>+91<?=$t['Mobile']?></td>
  <td><?=$t['mcaNumber']?></td>
  <td><?=$t[$yyyymm]['PV']?></td>
  <td><?=$t[$yyyymm]['GPV']?></td>
  <td><?=$t[$yyyymm]['GrossPV']?></td>
  <td><?=$t[$yyyymm]['GBV']?></td>
 </tr>
<?php  }?>
</table>