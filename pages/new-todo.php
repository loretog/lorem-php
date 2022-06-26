<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<div class="new-todo-page">
    <h1>New To-Do</h1>    
    <div class="col-6">
        <form method="post">
            <input type="hidden" name="action" value="new-todo">
            <input type="hidden" name="data[userid]" value="<?= $_SESSION['userid'] ?>">
            <div class="mb-3">
                <label for="Title" class="form-label">Title</label>
                <input type="text" class="form-control" aria-describedby="emailHelp" name="data[title]">			
            </div>
            <div class="mb-3">
                <label for="Description" class="form-label">Description</label>                
                <textarea class="form-control" name="data[description]" id="" cols="30" rows="10"></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Add To-do</button>
            <div class="m-2">
                <a href="<?= SITE_URL ?>/?page=to-do-list">Back</a>
            </div>
        </form>	
    </div>

</div>

<?= element( 'footer' ); ?>