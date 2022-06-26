<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= SITE_TITLE ?></title>
    <link href="<?= SITE_URL ?>/assets/bootstrap-5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= SITE_URL ?>/assets/bootstrap-icons-1.8.3/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/style.css?a=<?= time() ?>">
    <script>
      var $siteUrl = "<?= SITE_URL ?>";  
    </script>
  </head>
  <body>    
    <div class="container-fluid">
      <div class="row header">
        <div class="col">
          <ul class="nav nav-pills p-2 bg-light">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="<?= SITE_URL ?>"><?= SITE_TITLE ?></a>
            </li>            
          </ul>
        </div>
      </div>      
      <div class="row">      
          <div class="col left-content">
          <?= show_message(); ?>