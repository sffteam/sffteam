<div class="block">
<?php 

foreach($allaudios as $a){
	
	if($code==$a['Code']){
	
	?>

	<img src="https://sff.team/img/products/<?=$a['Code']?>.jpg" sizes="50vw" 		srcset="
		https://sff.team/img/products/<?=$a['Code']?>_100.jpg 100w,
		https://sff.team/img/products/<?=$a['Code']?>_200.jpg 200w,
		https://sff.team/img/products/<?=$a['Code']?>_400.jpg 400w,
		https://sff.team/img/products/<?=$a['Code']?>_800.jpg 800w,
		https://sff.team/img/products/<?=$a['Code']?>_1000.jpg 1000w,
		"
		class="lazy lazy-fade-in demo-lazy"/><br>
		<h2><?=$a['Code']?> - <?=$a['Name']?></h2>
		<span style="color:red">MRP: <strike><?=number_format($a['MRP'],2)?></strike></span> <span style="color:green">DP: <?=number_format($a['DP'],2)?></span> <span style="color:blue">BV: <?=number_format($a['PV'],2)?></span> PV: <?=number_format($a['BV'],2)?><br>
		<audio controls class="padding">
			<source src="<?=$a['URL']?>" type="audio/mp3">
			Your browser does not support the audio element.
		</audio> 

	<?php }
	}?>
</div>