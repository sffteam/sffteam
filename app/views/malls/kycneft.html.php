<table>
 <tr>
  <td>Name</td>
  <td>Mobile</td>
  <td>Refer Mobile</td>
  <td>ReferName</td>
  <td>KYC</td>
  <td>NEFT</td>  
 </tr>
<?php foreach($todayJoining as $t){?>
 <tr>
  <td><?=$t['name']?></td>
  <td>+91<?=$t['Mobile']?></td>
  <td>+91<?=$t['refer']?></td>
  <td><?=$t['referName']?></td>
  <td><?=$t['KYC']?></td>
  <td><?=$t['NEFT']?></td>
 </tr>
<?php  }?>
</table>