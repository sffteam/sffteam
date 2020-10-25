<?php
/**
 * 
 *
 * DO NOT CHANGE THIS FILE.. IT HAS BEEN ACHIVED BY A LOT OF RESEARCH
 * -----------NILAM DOCTOR-------------------------------------------
 * 
 */

?>
<!doctype html>
<html>
<head>
	<?php echo $this->html->charset();?>
	<title>Outline &gt; <?php echo $this->title(); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui, viewport-fit=cover">
	<link href="https://fonts.googleapis.com/css?family=Bebas+Neue|Montserrat|Raleway|Roboto+Mono&display=swap" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
 <link href="/framework7/css/framework7.bundle.min.css" rel="stylesheet" type="text/css">
	<link href="/css/icons.css" rel="stylesheet" type="text/css">
	<link href="/css/app.css" rel="stylesheet" type="text/css">
	<link href="/favicon.ico" title="Icon" type="image/x-icon" rel="icon" />  
</head>
<body>
<div id="app">
		<div class="view  view-main">
		 <div data-name="home" class="page">
				<div class="block">
					<?php if($this->_request->controller!="Pages"){?>
					<?php //echo $this->_render('element', 'header', compact('pagetotaltime'));?>	
					<?php }?>
				</div>
				<div class="page-content block">
					<?php echo $this->content(); ?>
					<hr>
					<div class="footer Rale">
						<p>&copy; EnglishToLead <?php echo date('Y') ?></p>
					</div>
				</div>
			</div>
		</div>
</div>
	<script src="/framework7/js/framework7.bundle.js"></script>
	<script src="/js/outline.js"></script>
</body>
</html>

<script>
outlineTitle();
</script>