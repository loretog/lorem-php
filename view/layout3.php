<?php

	$role_name[1] = "Administator";
	$role_name[2] = "Registrar";
	$role_name[3] = "Cashier";
	$role_name[4] = "Teacher";

?>

<?php echo $DTD . "\n"; ?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html;charset=<?php echo $meta_char_set; ?>" />
<title>Iloilo National High School <?php echo isset($the_title) ? " - " . $the_title : ''; ?></title>
<meta name="description" content="<?php echo $meta_desc ?>" />
<meta name="keywords" content="<?php echo $meta_keywords ?>" />
<meta name="author" content="<?php echo $meta_author ?>" />
<?php foreach($css as $c) echo "<link rel='stylesheet' type='text/css' href='" . DIR . "/styles/$c.css' />\n"; ?>
<script type="text/javascript">
	var URL = "<?php echo URL; ?>";
</script>
<?php foreach($js as $j) echo "<script type='text/javascript' src='" . DIR . "/scripts/$j.js'></script>\n"; ?>
</head>
<body>	
	<div id="wrapper">
		<div id="msgbox">			
			<a id="msgbox_close" onclick="hide_msgbox(); return false;">Close</a>
			<div id="msgbox_content"></div>
			<div id="msgbox_error"></div>
		</div>
		<div id="header">
			<div id="logo"></div>			
			<?php if(isset($_SESSION['admin'])) : ?>	
			<div id="admin">
				<div>Welcome back <a><b style="text-transform: capitalize;"><?php echo $_SESSION['admin']; ?></b></a>! You are logged in as <a><b><?php echo $role_name[$_SESSION['admin_role']] ?></b></a></div>
				<img src="<?php echo URL ?>/images/admin.png" />
				<div>
            <a href="<?php echo URL ?>/admin/user_profile/<?php echo $_SESSION['admin_id'] ?>">Profile</a>
            <a href="<?php echo URL ?>/settings">Settings</a>            
            <a href="<?php echo URL . "/" . $controller; ?>/logout">Logout</a>
        </div>
			</div>
			<?php endif; ?>
			<div id="admin">
      </div>
		</div>
		<?php if(isset($_SESSION['admin'])) : ?>
		<div id="menu">
			<ul>
				<!--<li><a href="<?php echo URL ?>/">Home</a></li>-->
				<li><a href="<?php echo URL ?>/school_years">School Years</a></li>
				<li><a href="<?php echo URL ?>/programs">Programs</a></li>
				<li><a href="<?php echo URL ?>/year_levels">Year Levels</a></li>				
				<li><a href="<?php echo URL ?>/sections">Sections</a></li>
				<li><a href="<?php echo URL ?>/subjects">Subjects</a></li>
				<li><a href="<?php echo URL ?>/miscellaneous">Miscellaneous</a></li>
				<li><a href="<?php echo URL ?>/students">Students</a></li>
				<li><a href="<?php echo URL ?>/enroll">Enroll</a></li>				
				<li>
					<?php if(strtolower($_SESSION['admin_role']) == 1) : ?>
            <a href="<?php echo URL ?>/admin/users">Users</a>
					<?php endif; ?>
				</li>				
				<!--<li><a href="<?php echo URL ?>/payments">Payments</a></li>-->
			</ul>
		</div>
		<?php endif; ?>
		<div id="content">			
			<div id="page_header">
				<div id="page_header_left">
					<div id="page_header_right">						
						<?php if(isset($_SESSION['message'])) : ?>
							<div><?php echo $_SESSION['message'] ?></div>
						<?php endif; ?>
						<h1><?php echo str_replace("_", " ", $controller) . " :: " . str_replace("_", " ", ($action == "index" ? "main" : $action)) ?></h1>
					</div>
				</div>
			</div>
			<?php if(isset($_SESSION['message'])) : ?>
			<!--<div class="message"><?php echo $_SESSION['message'] ?></div>-->
			<?php endif; ?>
			<?php include $the_view; ?>
		</div>
		<div id="footer">
			<div><a href="#">Home</a> | <a href="#">Departments</a> | <a href="#">Year Levels</a> | <a href="#">Sections</a> | <a href="#">Students</a>  <a href="#">Privacy Policy</a> | <a href="#">Contact Us</a> | <a href="#">Terms of Use</a> | <a href="#">About Us</a></div>			
		</div>
	</div>
</body>
</html>
<?php unset($_SESSION['message']); ?>