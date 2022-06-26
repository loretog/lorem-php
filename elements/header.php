<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= SITE_TITLE ?></title>
    <link href="<?= SITE_URL ?>/assets/bootstrap-5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= SITE_URL ?>/assets/bootstrap-icons-1.8.3/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/style.css">
    <script>
      var $siteUrl = "<?= SITE_URL ?>";  
    </script>
  </head>
  <body>    
    <div class="container-fluid">
      <div class="row header" style="background-color: #d0c971;">
        <div class="col">
          <ul class="nav nav-pills p-2">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="<?= SITE_URL ?>">TRADEAN</a>
            </li>            
          </ul>
        </div>
      </div>      
      <div class="row">
      <div class="col-2">
        <div class="list-group">
          <a href="<?= SITE_URL ?>/" class="list-group-item list-group-item-action <?= !isset($_GET[ 'page' ]) || empty($_GET[ 'page' ]) || $_GET[ 'page' ] == "" ? 'active' : '' ?>" aria-current="true">
            Dashboard
          </a>
          <a href="<?= SITE_URL ?>/?page=to-do-list" class="list-group-item list-group-item-action <?= isset($_GET[ 'page' ]) && $_GET[ 'page' ] == "to-do-list" ? 'active' : '' ?>">To-Do List</a>
          <a href="<?= SITE_URL ?>/?page=topics" class="list-group-item list-group-item-action <?= isset($_GET[ 'page' ]) && $_GET[ 'page' ] == "topics" ? 'active' : '' ?>">Topics</a>
          <a href="<?= SITE_URL ?>/?page=activities" class="list-group-item list-group-item-action <?= isset($_GET[ 'page' ]) && ($_GET[ 'page' ] == "activities" || $_GET[ 'page' ] == "view-activity" || $_GET[ 'page' ] == "new-activity-file" ) ? 
          'active' : '' ?>">Activities</a>
          <?php if( is_usertype( "professor" ) ) { ?>          		
          <a href="<?= SITE_URL ?>/?page=students" class="list-group-item list-group-item-action <?= isset($_GET[ 'page' ]) && ($_GET[ 'page' ] == "students" ) ? 
          'active' : '' ?>">Students</a>
          <a href="<?= SITE_URL ?>/?page=professors" class="list-group-item list-group-item-action <?= isset($_GET[ 'page' ]) && ($_GET[ 'page' ] == "professors" || $_GET[ 'page' ] == "new-professor" ) ? 
          'active' : '' ?>">Professors</a>
          <?php } ?>

          <a href="<?= SITE_URL ?>/?page=profile" class="list-group-item list-group-item-action <?= isset($_GET[ 'page' ]) && ($_GET[ 'page' ] == "profile" ) ? 
          'active' : '' ?>">Profile</a>		

          <?php if( is_usertype( "professor" ) ) { ?>          
          <?php } else { ?>          
          <?php } ?>
          <a href="<?= SITE_URL ?>/?action=logout" class="list-group-item list-group-item-action">Logout</a>

        </div>
        <div class="m-2 text-light">
          Welcome back <span class="fw-bold text-uppercase"><?= $_SESSION[ AUTH_NAME ] ?></span><br>
          Logged in as <span class="fw-bold text-uppercase"><?= $_SESSION[ AUTH_TYPE ] ?></span>
        </div>        
      </div>
          <div class="col left-content">
          <?= show_message(); ?>