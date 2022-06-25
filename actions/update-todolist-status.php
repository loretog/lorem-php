<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); 

if( isset( $_POST[ 'todoid' ] ) ) {
    $id = $_POST[ 'todoid' ];
    $studentid = $_POST[ 'studentid' ];
    $status = $_POST[ 'status' ];
    $DB->query( "UPDATE todolist_status SET todostatus=$status WHERE todoid=$id AND studentid=$studentid" );
	if( $DB->affected_rows ) {
        echo "1";
    } else {
        if( $DB->query( "INSERT INTO todolist_status (todoid, studentid, todostatus) VALUES( $id, $studentid, $status)" ) ) {
            echo "1";
        } else {
            echo "0";
        }
    }    
}
exit;