<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{pagetitle}
    </title>
    <meta name="description" content="{pagemetadescription}" />
    <script data-source="mautic">
      var mauticForms = {
      };
    </script>
				<link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Text:wght@100;400;800&family=Notable&family=Share&display=swap" rel="stylesheet"> 
				<link href="https://sff.team/framework7/css/framework7.bundle.min.css" rel="stylesheet">
				<style>
				.Big {font-family: 'Big Shoulders Text', cursive;}
    .Noteble {font-family: 'Notable', sans-serif;}
    .Share {font-family: 'Share', cursive;}
				.sz1{font-size:calc(1em + 1vw)}
				.szhalf{font-size:calc(1em + 0.5vw)}
				.sz2{font-size:calc(1em + 2vw)}
				.sz3{font-size:calc(1em + 3vw)}
				.sz4{font-size:calc(1em + 4vw)}
				.sz5{font-size:calc(1em + 5vw)}
				.sz6{font-size:calc(1em + 6vw)}
				.sz7{font-size:calc(1em + 7vw)}
				</style>
  </head>
  <body class="page-content" style="background-color:#eee">
    <div data-section-wrapper="1" style="text-align:center">
				<h1 class="Big sz6">Product Categories</h1>
				<div class="row responsive block">
				<?php foreach($categories as $c){?>
					<div class=" col-50 Share sz1 "><a  style="color-black" href="/page/preview/<?=$c->id?>"><?=$c->title?></a></div>
				<?php } ?>
				</div>
				<hr>
				<h3 class="Noteble sz1"><?=$category?></h3>
				<div class="row responsive block ">
				
				<?php
				foreach($products as $p){?>
					<div class="card col-50 Share szhalf margin-bottom">
						<div class="card-header"><?=$p->title?></div>
						<div class="card-content card-content-padding"><img src="https://sff.team/img/products/<?=$p->alias?>_200.jpg" width="100vw" /><br><?=$p->alias?></div>
						<div class="card-footer"><?=$p->description?></div>
					</div>
				<?php } ?>
				</div>
				
    </div>
  </body>
</html>