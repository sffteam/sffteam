<table>
<?php
//print_r($pendingmobiles);
$i = 0;
foreach($pendingmobiles as $m){?>
	<tr>
	<td><?=$i+1?></td>
		<td><?=$m['mcaNumber']?></td>
		<td><?=$m['mcaName']?></td>
	</tr>
<?php 
$i++;
} ?>
</table