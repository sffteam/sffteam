<!DOCTYPE HTML>
<html>
<?php $yyyymm = date('Y-m-d');?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes">
  <meta http-equiv="Content-Security-Policy" content="default-src * data: gap: content: https://ssl.gstatic.com; style-src * 'unsafe-inline'; script-src * 'unsafe-inline' 'unsafe-eval'">
  <link href="https://fonts.googleapis.com/css2?family=?family=Roboto+Mono:wght@400;Poppins:wght@100;300;400&family=Raleway:wght@100;300;400&family=Share&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/framework7/css/framework7.bundle.min.css">
  <link rel="stylesheet" href="/css/icons.css">
  <title><?=$self['mcaName']?> - <?=$self['mcaNumber']?> - <?=$yyyymm?></title>
<!--  <link rel="stylesheet" href="/css/style.css">-->
  <link rel="stylesheet" href="/css/app.css">
  <script src="/framework7/js/framework7.bundle.min.js"></script>
<script src="/js/ytd.js"></script>
<script>
 initiate();
</script>
  <?php echo $this->_render('element', 'graph');?>
  </head>

<body>
  <div id="mcaNumber"><?=$self['mcaNumber']?></div>
		<div class="page page-content">
  <?php echo $this->_render('element', 'mca_menu');?>
  <?php echo $this->content(); ?>
  </div>
</body>
<!-- JS code -->
</html>
