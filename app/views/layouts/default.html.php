<!DOCTYPE html><?php 
	$mtime = microtime();
	$mtime = explode(" ",$mtime);
	$mtime = $mtime[1] + $mtime[0];
	$pagestarttime = $mtime;
?><html amp>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="<?=COMPANY_URL?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="<?php echo 'https://' . $_SERVER['SERVER_NAME']. '/img/logo.png';?>" type="image/x-icon">
  <meta name="description" content="">
  <title><?=COMPANY_URL?> - </title>
		<!-- Canonical URL -->
  <link rel="canonical" href="<?php echo 'https://' . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ; ?>">
		<!-- Canonical URL -->
		 <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style>
  
		<noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
		<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:&display=swap" rel="stylesheet">
  <!-- Google Fonts -->
		<!-- Server Style Sheet CSS file -->
  <style amp-custom><?php readfile( getcwd() . "/css/style.css"); ?></style>

		<!-- Server Style Sheet CSS file -->

		<script async  src="https://cdn.ampproject.org/v0.js"></script>
		<script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>
  <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
  <script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
  <script async custom-element="amp-iframe" src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js"></script>
  <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
		
  
		
</head>
<body>
<!-- Server Script file -->
<!-- Server Script file -->
<?php 
	$mtime = microtime();
	$mtime = explode(" ",$mtime);
	$mtime = $mtime[1] + $mtime[0];
	$pageendtime = $mtime;
	$pagetotaltime = ($pageendtime - $pagestarttime);
?>
		<?php echo $this->_render('element', 'header', compact('pagetotaltime'));?>	
		<div class="content">
			<?php echo $this->content(); ?>
		</div>
<?php 
	$mtime = microtime();
	$mtime = explode(" ",$mtime);
	$mtime = $mtime[1] + $mtime[0];
	$pageendtime = $mtime;
	$pagetotaltime = ($pageendtime - $pagestarttime);
?>
<?php echo $this->_render('element', 'footer', compact('pagetotaltime'));?>	

  </body>
</html>
