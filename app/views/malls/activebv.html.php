<table class="Roboto" border=1>
 <tr>
  <th>Name</th>
  <th>VAR1</th>
  <th>VAR2</th>
  <th>VAR3</th>
  <th>VAR4</th>
  <th>VAR5</th>
  <th>VAR6</th>
 </tr>
<?php foreach($todayJoining as $t){?>
 <tr>
  <td class="align-left"><?=$t['fullname']?></td>
  <td><?=$t['VAR1']?></td>
  <td><?=$t['VAR2']?></td>
  <td><?=$t['VAR3']?></td>
  <td><?=$t['VAR4']?></td>
  <td><?=$t['VAR5']?></td>
  <td><?=$t['VAR6']?></td>
 </tr>
<?php  }?>
</table>