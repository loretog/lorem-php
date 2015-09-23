<?php

if( isset( $_POST ) ) {

	$name = $_POST[ 'name' ];
	$id = $_POST[ 'id' ];

	if( $DB->query( "UPDATE products SET name='$name' WHERE id=$id" ) ) {
		$MESSAGE = "Product successfully updated!";
		$MESSAGE_TYPE = "info";
	} else {
		$MESSAGE = "Failed to update Product";
		$MESSAGE_TYPE = "danger";
	}

}