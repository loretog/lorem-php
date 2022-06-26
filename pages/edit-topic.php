<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?php
    $todo = null;
    if( isset( $_GET[ 'id' ] ) && !empty( $_GET[ 'id' ] ) ) {
        $id = $_GET[ 'id' ];
        $topics = $DB->query( "SELECT * FROM topics WHERE topicid=$id" );
        if( $topics && $topics->num_rows ) {
            $topic = $topics->fetch_object();
        } else {
            set_message( 'No To-do found in the record.', "danger" );
            redirect( "topics" );
        }
    } else {
        set_message( 'To-do not found.', "danger" );
        redirect( "topics" );
    }
?>

<?= element( 'header' ); ?>

<div class="edit-topic-page">
    <h1>Edit Topic</h1>        
    <div class="col-6">
        <form method="post">
            <input type="hidden" name="action" value="update-topic">
            <input type="hidden" name="id" value="<?= $id ?>">
            <div class="mb-3">
                <label for="Title" class="form-label">Title</label>
                <input type="text" class="form-control" name="data[title]" value="<?= $topic->title ?>">
            </div>
            <div class="mb-3">
                <label for="Description" class="form-label">Content</label>                
                <textarea class="form-control editor" name="data[content]" id="" cols="30" rows="10"><?= $topic->content ?></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Update Topic</button>
            <div class="m-2">
                <a href="<?= SITE_URL ?>/?page=topics">Back</a>
            </div>
        </form>	
    </div>

</div>

<?= element( 'footer' ); ?>