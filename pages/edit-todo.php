<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?php
    $todo = null;
    if( isset( $_GET[ 'id' ] ) && !empty( $_GET[ 'id' ] ) ) {
        $id = $_GET[ 'id' ];
        $todos = $DB->query( "SELECT * FROM todolist WHERE todoid=$id" );
        if( $todos && $todos->num_rows ) {
            $todo = $todos->fetch_object();
        } else {
            set_message( 'No To-do found in the record.', "danger" );
            redirect( "to-do-list" );
        }
    } else {
        set_message( 'To-do not found.', "danger" );
        redirect( "to-do-list" );
    }
?>

<?= element( 'header' ); ?>

<div class="new-todo-page">
    <h1>Edit To-Do</h1>        
    <div class="col-6">
        <form method="post">
            <input type="hidden" name="action" value="update-todo">
            <input type="hidden" name="id" value="<?= $id ?>">
            <div class="mb-3">
                <label for="Title" class="form-label">Title</label>
                <input type="text" class="form-control" name="data[title]" value="<?= $todo->title ?>">
            </div>
            <div class="mb-3">
                <label for="Description" class="form-label">Description</label>                
                <textarea class="form-control" name="data[description]" id="" cols="30" rows="10"><?= $todo->description ?></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Update To-do</button>
            <div class="m-2">
                <a href="<?= SITE_URL ?>/?page=to-do-list">Back</a>
            </div>
        </form>	
    </div>

</div>

<?= element( 'footer' ); ?>