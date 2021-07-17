<table>
 <tr>
  <td>Name</td>
  <td>Mobile</td>
  <td>Refer Mobile</td>
  
  <td>DateJoin</td>
  
 </tr>
<?php foreach($users as $t){
 if($t['Mobile']!=""){
 ?>
 <tr>
  <td><?=$t['mcaName']?></td>
  <td>+91<?=$t['Mobile']?></td>
  <td><?=$t['refer']?></td>
  <td><?=$t['DateJoin']?></td>
  
 </tr>
 <?php  }}?>
</table>