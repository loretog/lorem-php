<?php

if( isset( $_POST ) ) {

	$name = $_POST[ 'name' ];

	if( $DB->query( "INSERT INTO products (name) values( '$name' )" ) ) {
		$MESSAGE = "Product successfully added!";
		$MESSAGE_TYPE = "danger";
	} else {
		$MESSAGE = "Failed to add new Product";
		$MESSAGE_TYPE = "danger";
	}

}	