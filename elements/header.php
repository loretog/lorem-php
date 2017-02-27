<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Awesome Site</title>
		<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL ?>/assets/bootstrap/css/bootstrap.min.css">
	</head>

	<body>

		<div class="container">
			<div class="row">
				<div class="header col-lg-12">
					<div class="page-header">
					  <h1>My Awesome Site <small>Subtext for header</small></h1>
					</div>				
				</div>
				<div class="menu col-lg-12">
					<nav class="navbar navbar-default">
					  <div class="container-fluid">					   
					  	<!-- Brand and toggle get grouped for better mobile display -->
					    <div class="navbar-header">
					      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					        <span class="sr-only">Toggle navigation</span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					      </button>
					      <a class="navbar-brand" href="#">Brand</a>
					    </div>
					    <!-- Collect the nav links, forms, and other content for toggling -->
					    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					      <ul class="nav navbar-nav">
					        <li class="active"><a href="./">Home <span class="sr-only">(current)</span></a></li>
					        <li><a href="./?page=products">Products</a></li>
					        <li class="dropdown">
					          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
					          <ul class="dropdown-menu" role="menu">
					            <li><a href="#">Action</a></li>
					            <li><a href="#">Another action</a></li>
					            <li><a href="#">Something else here</a></li>
					            <li class="divider"></li>
					            <li><a href="#">Separated link</a></li>
					            <li class="divider"></li>
					            <li><a href="#">One more separated link</a></li>
					          </ul>
					        </li>
					      </ul>					     
					      <ul class="nav navbar-nav navbar-right">
					        <li><a href="#">Link</a></li>
					        <li class="dropdown">
					          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
					          <ul class="dropdown-menu" role="menu">
					            <li><a href="#">Action</a></li>
					            <li><a href="#">Another action</a></li>
					            <li><a href="#">Something else here</a></li>
					            <li class="divider"></li>
					            <li><a href="#">Separated link</a></li>
					          </ul>
					        </li>
					      </ul>
					    </div><!-- /.navbar-collapse -->
					  </div><!-- /.container-fluid -->
					</nav>
				</div>
			</div>
			<?php 
				if( !empty( $MESSAGE ) ) {
					echo "<div class='row'><div class='col-lg-12'><div class='alert alert-$MESSAGE_TYPE'>$MESSAGE</div></div></div>";
				} 
			?>
			<div class="main-content row">				
				<div class="col-lg-8 col-md-8">
				<!-- START OF CONTENT -->