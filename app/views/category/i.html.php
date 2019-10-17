<p>&nbsp;</p>
<div class="container">
<div class="row">
	<div class="col-2">
		<h4>Categories</h4>
		<ul class="list-unstyled">
			<?php foreach($CategoriesArray as $k => $v){?>
			<li><a class="text-muted" href="/category/i/<?=$k?>"><?=$v?></a></li>
			<?php }?>
		</ul>
	</div>
	<div class="col-6">
		<h4>Products</h4>
		<div class="row">
			
			<?php $count = 1;?>
			<?php foreach($AllProducts as $p){?>
				<?php if ($count % 2 == 0){ ?>
					<div class="col-5 mb-2" style="border:1px solid black;padding:2px;margin:2px">
						<b><?=$p['Code']?>:
						<small><?=$p['Name']?></small></b><br>
						<img src="/img/products/<?=$p['Code']?>.jpg" width="150"></br>
						<hr>
						<div style="text-align:right">
							<font style="color:red"> MRP: <strike><?=number_format($p['MRP'],2)?></strike></font><br>
							<font style="color:green"><strong>DP: <?=number_format($p['DP'],2)?></strong></font><br>
							BV: <?=number_format($p['BV'],2)?><br>
							DP: <?=number_format($p['DP'],2)?><br>
						</div>
				</div>
			<?php } ?>
			<?php 	if ($count % 2 == 1){ ?>
					<div class="col-5 mb-2" style="border:1px solid black;padding:2px;margin:2px">
						<b><?=$p['Code']?>:
						<small><?=$p['Name']?></small></b><br>
						<img src="/img/products/<?=$p['Code']?>.jpg" width="150"></br>
						<hr>
						<div style="text-align:right">
							<font style="color:red"> MRP: <strike><?=number_format($p['MRP'],2)?></strike></font><br>
							<font style="color:green"><strong>DP: <?=number_format($p['DP'],2)?></strong></font><br>
							BV: <?=number_format($p['BV'],2)?><br>
							DP: <?=number_format($p['DP'],2)?><br>
						</div>
				</div>
				<?php }	?>
				<?php $count++;?>
			<?php }?>
		</div>
</div>
</div>
</div>