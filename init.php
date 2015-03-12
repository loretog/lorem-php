<?php	

	$DB = new mysqli( DBHOST, DBUSER, DBPASS, DBNAME );

	$MESSAGE = "";
	
	/*
		values: success, warning, danger, info
	*/
	$MESSAGE_TYPE = "";