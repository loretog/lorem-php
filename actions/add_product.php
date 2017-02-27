<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>
<?php

if( isset( $_POST ) ) {

	$name = $_POST[ 'name' ];

	if( $DB->query( "INSERT INTO products (name) values( '$name' )" ) ) {
		$MESSAGE = "Product successfully added!";
		$MESSAGE_TYPE = "danger";
	} else {
		$MESSAGE = "Failed to add new Product. " . $DB->error;
		$MESSAGE_TYPE = "danger";
	}

}	