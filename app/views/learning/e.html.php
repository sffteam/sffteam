<p>&nbsp;</p>
<?php

$Learning = array(

				'Sapne'=>'Azadi-Sapne',
    'Business'=>'Azadi-BusinessPlan',
    'Arogya'=>'Arogya Booklet Hindi',
    'Parivartan'=>'Parivartan Sapno Ko Jeene ki Azadi',
    'Raftaar'=>'Raftaar',
    'Shuruaat'=>'Shuruaat for LMS',
);

?>
<div class="container">
<div class="row">
	<div class="col-3">
		<h4>Learnings</h4>
		<ul class="list-unstyled">
			<?php foreach($Learning as $k => $v){?>
			<li><a class="text-muted" href="/learning/e/<?=$k?>"><?=$v?><br>
			<img src="/img/documents/Images/<?=str_replace(" ","%20",$v);?>_Page_01.jpg" width="200">
			
			</a>
			
			</li>
			
			<?php }?>
		</ul>

	</div>
	<div class="col-9"> <h4>Fill in the form to download</h4>
	<iframe src="https://docs.google.com/forms/d/e/1FAIpQLSeBKG3f5TFhfvTjaaWNd_ks0mGkGyMyUdfaTeA76Dv1ZA5ocA/viewform?embedded=true" width="640" height="935" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
	</div>
</div>
</div>
</div>
