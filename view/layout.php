<?php echo $DTD . "\n"; ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html;charset=<?php echo $meta_char_set; ?>" />
<title>Iloilo National High School <?php echo isset($the_title) ? " - " . $the_title : ''; ?></title>
<meta name="description" content="<?php echo $meta_desc ?>" />
<meta name="keywords" content="<?php echo $meta_keywords ?>" />
<meta name="author" content="<?php echo $meta_author ?>" />
<?php foreach($css as $c) echo "<link rel='stylesheet' type='text/css' href='" . DIR . "/styles/$c.css' />\n"; ?>
<?php foreach($js as $j) echo "<script type='text/javascript' src='" . DIR . "/scripts/$j.js'></script>\n"; ?>
</head>
<body>
	<?php if(isset($_SESSION['admin'])) : ?>
	<div id="admin">		
		<p>Welcome back <b><?php echo $_SESSION['admin']; ?></b></p>
		<p><a href="<?php echo DIR . "/" . $controller; ?>/logout">Settings</a> | <a href="<?php echo DIR . "/" . $controller; ?>/logout">Logout</a></p>		
	</div>
	<?php endif; ?>
	<div id="wrapper">
		<div id="header">
			<h1>Iloilo National High School</h1>			
		</div>
		<div id="content">
		<?php if(isset($_SESSION['message'])) : ?>
		<div id="message"><?php echo $_SESSION['message'] ?></div>
		<?php endif; ?>
		<?php include $the_view; ?>
		</div>
		<div id="footer">
			<a href="<?php echo DIR ?>/">Home</a> | <a href="<?php echo DIR; ?>/enroll">Enroll</a> | <a href="<?php echo DIR ?>/year_levels/">Year Levels</a> | <a href="<?php echo DIR; ?>/admins">Admins</a>
		</div>
	</div>
</body>
</html>
<?php unset($_SESSION['message']); ?>