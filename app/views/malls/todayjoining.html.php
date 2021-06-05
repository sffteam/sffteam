<table>
 <tr>
  <td>Name</td>
  <td>Mobile</td>
  <td>mcaNumber</td>
  <td>Refer Mobile</td>
  <td>ReferName</td>
  <td>DateJoin</td>
 </tr>

<?php foreach($todayJoining as $t){?>
 <tr>
  <td><?=$t['mcaName']?></td>
  <td>+91<?=$t['Mobile']?></td>
  <td><?=$t['mcaNumber']?></td>
  <td>+91<?=$t['refer']?></td>
  <td><?=$t['referName']?></td>
  <td><?=$t['DateJoin']?></td>
 </tr>
<?php  }?>
</table>