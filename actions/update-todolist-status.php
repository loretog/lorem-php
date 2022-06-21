<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); 

if( isset( $_POST[ 'todoid' ] ) ) {
    $id = $_POST[ 'todoid' ];
    $status = $_POST[ 'status' ];
	if( $DB->query( "UPDATE todolist SET status=$status WHERE todoid=$id" ) ) {
        echo "1";
    } else {
        echo "0";
    }    
}
exit;