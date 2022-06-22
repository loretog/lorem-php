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
              <ul class="nav justify-content-center">
                <li class="nav-item">
                  <a class="nav-link" href="<?= SITE_URL ?>/">Survey</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?= SITE_URL ?>/?page=dashboard">Dashboard</a>
                </li>            
              </ul>
            </div>
          </div>
          <hr>
          <form method="post">
            <input type="hidden" name="action" value="save-survey">
            <h1 class="text-center">Covid Survey</h1>
            <?= show_message(); ?>
            <div class="mb-3">
              <label for="" class="form-label">Name</label>
              <input type="text" class="form-control" id="" placeholder="Last Name, First Name" name="data[name]" required>
            </div>
            <div class="row">
              <div class="col-2 mb-3">
                <label for="" class="form-label">Gender</label>
                <select class="form-select" name="data[gender]" required>
                  <option selected></option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>              
                </select>
              </div>
              <div class="col-2 mb-3">
                <label for="" class="form-label">Age</label>
                <input type="number" class="form-control" id="" placeholder="Age" name="data[age]" required>
              </div>
              <div class="col mb-3">
                <label for="" class="form-label">Mobile Number</label>
                <input type="text" class="form-control" id="" placeholder="###-#####-###" name="data[mobile]" required>
              </div>
              <div class="col mb-3">
                <label for="" class="form-label">Nationality:</label>
                <input type="text" class="form-control" id="" placeholder="Your country of Origin" name="data[nationality]" value="Filipino" required>
              </div>
            </div>              
            <hr>
            <div class="row">
              <div class="col mb-3">
                <label for="" class="form-label">Body Temp (Celcius):</label>
                <input type="text" class="form-control" id="" placeholder="Body Temperature in Celcius" name="data[bodytemp]" required>
              </div>
              <div class="col mb-3">
                <label for="" class="form-label">COVID-19 Diagnosed: (YES/NO)</label>            
                <select class="form-select" name="data[diagnosed]" required>
                  <option selected></option>
                  <option value="yes">Yes</option>
                  <option value="no">No</option>              
                </select>
              </div>            
            </div>      
            <div class="row">            
              <div class="col mb-3">
                <label for="" class="form-label">COVID-19 encounter: (YES/NO)</label>
                <select class="form-select" name="data[encounter]" required>
                  <option selected></option>
                  <option value="yes">Yes</option>
                  <option value="no">No</option>              
                </select>
              </div>
              <div class="col mb-3">
                <label for="" class="form-label">Vacinated: (YES/NO)</label>
                <select class="form-select" name="data[vacinated]" required>
                  <option selected></option>
                  <option value="yes">Yes</option>
                  <option value="no">No</option>              
                </select>
              </div>
            </div>        
            <hr>                         
            <div class="mb-3">
              <input type="submit" value="Save Survey" class="btn btn-success">
            </div> 
          </form>
        </div>
      </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>