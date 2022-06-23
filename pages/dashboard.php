<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= SITE_TITLE ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,400;1,100&display=swap" rel="stylesheet">
    <style>
      * { font-family: Roboto; }
    </style>
  </head>
  <body style="background: url('<?= SITE_URL ?>/assets/images/covid-map.jpg') center center no-repeat;">
    <div class="container-fluid">
      
      <div class="row m-4">      
        <div class="col-6 bg-light m-auto p-3 rounded">
          <div class="row">
            <div class="col">
              <?= element( 'menu' ) ?>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
                <h1 class="text-center">Summary of Survey</h1>
            </div>
            <div class="col">
                <div class="card mb-2" style="width: 18rem;">
                    <img src="<?= SITE_URL ?>/assets/images/encounter.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <?php
                            $encounters = $DB->query("SELECT COUNT(encounter) AS cnt FROM SURVEYS WHERE encounter='yes' GROUP BY encounter;");
                            $encounter = $encounters->fetch_object();
                        ?>
                        <h5 class="card-title text-center"><?= $encounter->cnt ?></h5>
                        <p class="card-text text-center">COVID-19 Encounter</p>
                    </div>                    
                </div>
            </div>
            <div class="col">
                <div class="card mb-2" style="width: 18rem;">
                    <img src="<?= SITE_URL ?>/assets/images/vaccinated.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <?php
                            $vaccinated = $DB->query("SELECT COUNT(vacinated) AS cnt FROM SURVEYS WHERE vacinated='yes' GROUP BY encounter;");
                            $vaccine = $vaccinated->fetch_object();
                        ?>
                        <h5 class="card-title text-center"><?= $vaccine->cnt ?></h5>
                        <p class="card-text text-center">Vaccinated</p>
                    </div>                    
                </div>
            </div>
            <div class="col">
                <div class="card mb-2" style="width: 18rem;">
                    <img src="<?= SITE_URL ?>/assets/images/fever.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center">200</h5>
                        <p class="card-text text-center">Fever</p>
                    </div>                    
                </div>
            </div>
            <div class="col">
                <div class="card mb-2" style="width: 18rem;">
                    <img src="<?= SITE_URL ?>/assets/images/encounter.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center">200</h5>
                        <p class="card-text text-center">Adult</p>
                    </div>                    
                </div>
            </div>
            <div class="col">
                <div class="card mb-2" style="width: 18rem;">
                    <img src="<?= SITE_URL ?>/assets/images/encounter.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center">200</h5>
                        <p class="card-text text-center">Minor</p>
                    </div>                    
                </div>
            </div>
            <div class="col">
                <div class="card mb-2" style="width: 18rem;">
                    <img src="<?= SITE_URL ?>/assets/images/encounter.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center">200</h5>
                        <p class="card-text text-center">Foreigner</p>
                    </div>                    
                </div>
            </div>
        </div>          
        </div>
      </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>