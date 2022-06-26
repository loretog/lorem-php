<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?php
    $todo = null;
    if( isset( $_GET[ 'id' ] ) && !empty( $_GET[ 'id' ] ) ) {
        $id = $_GET[ 'id' ];
        $activities = $DB->query( "SELECT * FROM activities WHERE activityid=$id" );
        if( $activities && $activities->num_rows ) {
            $activity = $activities->fetch_object();
        } else {
            set_message( 'No To-do found in the record.', "danger" );
            redirect( "activities" );
        }
    } else {
        set_message( 'To-do not found.', "danger" );
        redirect( "activities" );
    }
?>

<?= element( 'header' ); ?>

<div class="edit-activity-page">
    <h1>Edit Activity</h1>        
    <div class="col">
        <form method="post">
            <input type="hidden" name="action" value="update-activity">
            <input type="hidden" name="id" value="<?= $id ?>">
            <div class="mb-3">
                <label for="Title" class="form-label">Subject</label>
                <input type="text" class="form-control" name="data[title]" value="<?= $activity->title ?>">
            </div>
            <div class="mb-3">
                <label for="Description" class="form-label">Description</label>                                
                <input type="text" class="form-control"name="data[content]" value="<?= $activity->content ?>">
            </div>
            
            <button type="submit" class="btn btn-primary">Update Subject</button>
            <div class="m-2">
                <a href="<?= SITE_URL ?>/?page=activities">Back</a>
            </div>
        </form>	
    </div>

</div>

<?= element( 'footer' ); ?>