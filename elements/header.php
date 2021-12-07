<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>
<!DOCTYPE html> 
<html>
	<head>
		<title>Lorem Framework</title>
		<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL ?>/assets/bootstrap/css/bootstrap.min.css">
	</head>

	<body>
		<?php 
			global $restricted_pages;
		?>
		<div class="container">
			<div class="row">

				

				<div class="header col-lg-12">
					<div class="page-header">
					  <h1>Lorem Framework <small></small></h1>
					</div>				
				</div>

				<div class="menu col-lg-12">
					<nav class="navbar navbar-expand-lg navbar-light bg-light">
					  <div class="container-fluid">				    
					    <div class="collapse navbar-collapse" id="navbarSupportedContent">
					      <ul class="navbar-nav me-auto mb-2 mb-lg-0">					        
									<li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL ?>">Home</a></li>					        
					      </ul>
					      
					    </div>
					  </div>
					</nav>
				</div>
			</div>
			<?php 
				show_message();
			?>
			<div class="main-content row">				
				<div class="col-lg-8 col-md-8">
				<!-- START OF CONTENT -->