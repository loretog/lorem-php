<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<div class="new-activity-page">
    <h1>New Activity</h1>    
    <div class="col">
        <form method="post">
            <input type="hidden" name="action" value="new-activity">
            <input type="hidden" name="data[userid]" value="<?= $_SESSION['userid'] ?>">
            <div class="mb-3">
                <label for="Title" class="form-label">Title</label>
                <input type="text" class="form-control"name="data[title]">			
            </div>
            <div class="mb-3">
                <label for="Description" class="form-label">Description</label>                                
                <input type="text" class="form-control"name="data[content]">			
            </div>
            
            <button type="submit" class="btn btn-primary">Add Activity</button>
            <div class="m-2">
                <a href="<?= SITE_URL ?>/?page=activities">Back</a>
            </div>
        </form>	
    </div>

</div>

<?= element( 'footer' ); ?>