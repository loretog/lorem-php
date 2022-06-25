<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<div class="new-activity-page">
    <h1>New Activity</h1>    
    <div class="col">
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="new-activity-file">
            <input type="hidden" name="data[activityid]" value="<?= $_GET['activityid'] ?>">
            <input type="hidden" name="data[studentid]" value="<?= $_SESSION[ AUTH_ID ] ?>">
            <div class="mb-3">
                <label for="Title" class="form-label">Title</label>
                <input type="text" class="form-control"name="data[title]">			
            </div>            
            <div class="mb-3">
                <label for="formFile" class="form-label">Upload file...</label>
                <input class="form-control" type="file" id="formFile" name="activityfile">
            </div>
            
            <button type="submit" class="btn btn-primary">Submit My Work</button>
            <div class="m-2">
                <a href="<?= SITE_URL ?>/?page=view-activity&id=<?= $_GET['activityid'] ?>">Back</a>
            </div>
        </form>	
    </div>

</div>

<?= element( 'footer' ); ?>