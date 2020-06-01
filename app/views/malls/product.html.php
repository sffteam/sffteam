<div class="block ">
	<div class="row">
		<div class="col">Code:</div>
		<div class="col"><?=$product['Code']?></div>
	</div>
	<div class="row">
		<div class="col">Name:</div>
		<div class="col"><?=$product['Name']?></div>
	</div>
	<div class="row">
		<div class="col">MRP:</div>
		<div class="col"><strike style='color:red'><?=number_format($product['MRP'],2)?></strike></div>
	</div>
	<div class="row">
		<div class="col">DP:</div>
		<div class="col"><font style='color:green'><?=number_format($product['DP'],2)?></font></div>
	</div>
	<div class="row">
		<div class="col">BV:</div>
		<div class="col"><font style='color:black'><?=number_format($product['BV'],2)?></font></div>
	</div>
	<div class="row">
		<div class="col">PV:</div>
		<div class="col"><font style='color:blue'><?=number_format($product['PV'],2)?></font></div>
	</div>
	<div class="row">
		<div class="col">%</div>
		<div class="col"><font style='color:blue'><?=number_format($product['BV']/$product['DP']*100,0)?>%</font></div>
	</div>
	<div class="row">
		<div class="col"><img src="https://sff.team/img/products/<?=$product['Code']?>.jpg" width="80%"></div>
	</div>
	<div class="row">
		<iframe id="StepVideo"  src="https://www.youtube.com/embed/<?=$product['Video']?>"></iframe> 
	</div>
	<p>&nbsp;</p>	
</div>