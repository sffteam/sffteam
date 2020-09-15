<table border="1" cellpadding="2" cellspacing="2">
 <tr>
 <th>Category</th>
 <th>Name</th>
 <th>GTIN</th>
 <th>Bar Code</th>
 </tr>
<?php foreach($products as $p){ ?>
 <tr>
 <td><?=$p['MarwarCategory']?></td>
 <td><?=$p['Product Description']?></td>
 <td><?=$p['GTIN']?></td>
 <td><img src="/img/navpallavan/ean-13_<?=$p['GTIN']?>.png" width="100"></td>
 </tr>
<?php } ?>
</table>