<table>
 <tr>
  <td>Name</td>
  <td>VAR1</td>
  <td>VAR2</td>
  <td>VAR3</td>
  <td>VAR4</td>
  <td>VAR5</td>
  <td>VAR6</td>
 </tr>
<?php foreach($todayJoining as $t){?>
 <tr>
  <td><?=$t['fullname']?></td>
  <td><?=$t['VAR1']?></td>
  <td><?=$t['VAR2']?></td>
  <td><?=$t['VAR3']?></td>
  <td><?=$t['VAR4']?></td>
  <td><?=$t['VAR5']?></td>
  <td><?=$t['VAR6']?></td>
 </tr>
<?php  }?>
</table>