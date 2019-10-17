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
	<div class="col-12">
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
</div>
</div>
</div>
