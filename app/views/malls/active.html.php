<table>
 <tr>
  <td>Name</td>
  <td>Mobile</td>
  <td>Refer Mobile</td>
  <td>ReferName</td>
  <td>DateJoin</td>
  <td>Info</td>
 </tr>
<?php foreach($todayJoining as $t){?>
 <tr>
  <td><?=$t['name']?></td>
  <td>+91<?=$t['Mobile']?></td>
  <td><?=$t['refer']?></td>
  <td><?=$t['KYCNEFT']?></td>
  <td><?=$t['DateJoin']?></td>
  <td><?=$t['Info']?></td>
 </tr>
<?php  }?>
</table>