<!DOCTYPE HTML>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes">
  <meta http-equiv="Content-Security-Policy" content="default-src * data: gap: content: https://ssl.gstatic.com; style-src * 'unsafe-inline'; script-src * 'unsafe-inline' 'unsafe-eval'">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400&?family=Bebas+Neue&Raleway:wght@100;300;400&family=Share&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/framework7/css/framework7.bundle.min.css">
  <link rel="stylesheet" href="/css/icons.css">
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/app.css">
  <script src="/framework7/js/framework7.bundle.min.js"></script>
  <script src="/js/mcaapp.js"></script>

  </head>

<body>
		<div class="page">
   <?php echo $this->_render('element', 'mca_header');?>	
   <div class="page-content">
			<?php echo $this->content(); ?>
   </div>
   </div>
  </div>
</body>
<!-- JS code -->
 <script src="/js/mcaroutes.js"></script>
</html>
