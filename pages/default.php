<h1>default</h1>

<?php 
	$test = $DB->query( "SELECT * FROM samp" );

	while( $r = $test->fetch_object() ) {
		echo $r->name . "<br>";
	}
?>

