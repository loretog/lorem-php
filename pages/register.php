<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= SITE_TITLE ?></title>
    <link href="<?= SITE_URL ?>/assets/bootstrap-5.2/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
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
      <div class="row main-content p-2">      
            <div class="col left-content">
            <?= show_message(); ?>

            <div class="col-4 p-5 justify-content-end">
                <h1>Register</h1>
                <form method="post">
                    <input type="hidden" name="action" value="register_user">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="data[email]">			
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Username</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="data[username]">			
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="data[password]">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Re-type Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                    </div>
                    <div class="mb-3">
                        <a href="<?= SITE_URL ?>/?page=login">Login</a>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>	
            </div>

<?= element( 'footer' ) ?>
        