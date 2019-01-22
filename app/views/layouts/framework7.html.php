<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Security-Policy" content="default-src * data: gap: content: https://ssl.gstatic.com; style-src * 'unsafe-inline'; script-src * 'unsafe-inline' 'unsafe-eval'">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui, viewport-fit=cover">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="default">
  <meta name="theme-color" content="#2196f3">
  <meta name="format-detection" content="telephone=no">
  <meta name="msapplication-tap-highlight" content="no">

  <link rel="stylesheet" href="/framework7/css/framework7.min.css">
  <link rel="stylesheet" href="/css/icons.css">
  <link rel="stylesheet" href="/css/app.css">
  <link rel="stylesheet" href="/components/loader.css">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>
  <div id="app">
    <div class="statusbar"></div>
    <div class="view view-main ios-edges">
    <?php echo $this->content(); ?>
    </div>
    </div>
    <!-- Framework7 library -->
  <script src="/framework7/js/framework7.min.js"></script>
  <!-- Monaca JS library -->
  <script src="/js/routes.js"></script>
  <!-- Your custom app scripts -->
  <script src="/js/app.js"></script>
  <script>
  
  </script>
</body>
</html>
