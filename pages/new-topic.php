<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<div class="new-topic-page">
    <h1>New Topic</h1>    
    <div class="col-6">
        <form method="post">
            <input type="hidden" name="action" value="new-topic">
            <input type="hidden" name="data[userid]" value="<?= $_SESSION[ AUTH_ID ] ?>">
            <div class="mb-3">
                <label for="Title" class="form-label">Title</label>
                <input type="text" class="form-control"name="data[title]">			
            </div>
            <div class="mb-3">
                <label for="Description" class="form-label">Content</label>                
                <textarea class="form-control editor" name="data[content]" id="" cols="30" rows="10" style="height: 400px; min-height: 500px;"></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Add Topic</button>
            <div class="m-2">
                <a href="<?= SITE_URL ?>/?page=topics">Back</a>
            </div>
        </form>	
    </div>

</div>

<?= element( 'footer' ); ?>