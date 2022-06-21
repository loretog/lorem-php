<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); 

if( isset( $_POST ) ) {

	if( add_record( "activityfiles", $_POST[ 'data' ] ) ) {        
        $new_id = $DB->insert_id;
        // main folder of activty
        $act_folder = "activityfiles" . DS . $_POST[ 'data' ][ 'activityid' ] . DS;
        $main = ROOT_DIR . DS . $act_folder;
        if(!file_exists($main)) {
            mkdir($main);
        }        
        $target_dir = $main . DS . $new_id . DS;   
        $target_url = "/activityfiles/{$_POST[ 'data' ][ 'activityid' ]}/$new_id/" . $_FILES["activityfile"]["name"];     
        // file directory        
        mkdir($target_dir);
        $target_file = $target_dir . basename($_FILES["activityfile"]["name"]);  
        //echo $target_dir . " - " . $target_file; exit;
        if (move_uploaded_file($_FILES["activityfile"]["tmp_name"], $target_file)) {
            $data[ 'filedir' ] = $DB->real_escape_string($act_folder . basename($_FILES["activityfile"]["name"]));
            $data[ 'fileurl' ] = $target_url;
            update_record( "activityfiles", [ "key" => "activityfilesid", "val" => $new_id ], $data );
            //set_message("The file ". htmlspecialchars( basename( $_FILES["activityfile"]["name"])). " has been uploaded.", "success");
            set_message( "File has been added.", "success" );
        } else {
            set_message("Sorry, there was an error uploading your file. {$_FILES["activityfile"]['error']}", "danger");
        }        
    } else {
        set_message( "Failed to add file.", "danger" );
    }
    redirect( "view-activity&id=" . $_POST[ 'data' ][ 'activityid' ] );
}	    