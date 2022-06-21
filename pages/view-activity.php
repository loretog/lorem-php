<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>
<?php
    $activityid = $_GET[ 'id' ];
    $activity = $DB->query( "SELECT * FROM activities WHERE activityid=$activityid" );
    $activity = $activity->fetch_object();
?>
<div class="view-activity-page mb-2 pt-2">
    <h1><?= $activity->title ?></h1>
    <div class="m-2">
        <a href="<?= SITE_URL ?>/?page=new-activity-files&activityid=<?= $activityid ?>">New Files</a>
    </div>
    <div class="row">
    <div class="accordion accordion-flush" id="accordionFlushExample">
    <?php         
    $activityfiles = $DB->query( "SELECT * FROM activityfiles WHERE activityid=$activityid ORDER BY created DESC" );
    if( $activityfiles && $activityfiles->num_rows ) {
        $cnt = 1;
        while( $activityfile = $activityfiles->fetch_object() ) :
    ?>
    
        <!-- <div class="col-4 mb-2">
            <div class="card">
                <div class="card-header">
                    <span class="text-decoration-underline float-start m-1"><?= $activityfile->title ?></span>                                        
                    <a title="Remove Title" class="text-danger float-end m-1" href="<?= SITE_URL ?>/?action=delete-activity-file&activityfileid=<?= $activityfile->activityfilesid  ?>&activityid=<?= $activityid ?>" onclick="return confirm('Do you want to remove this item?')"><i class="bi bi-x-square"></i></a>
                    <a title="Edit Topic" class="text-success float-end m-1" href="<?= SITE_URL ?>/?page=edit-activity&id=<?= $activityfile->activityid ?>"><i class="bi bi-pencil"></i></a>                    
                    <a title="View Activity" class="text-danger float-end m-1" href="<?= SITE_URL ?>/?page=view-activity&id=<?= $activityfile->activityid ?>"><i class="bi bi-eye"></i></i></a>
                </div>
                <div class="card-body">
                    <?= $activity->content ?>
                </div>
            </div>
        </div>  -->
        
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-heading<?= $activityfile->activityfilesid ?>">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $activityfile->activityfilesid ?>" aria-expanded="false" aria-controls="flush-collapse<?= $activityfile->activityfilesid ?>">
                    <?= $cnt ?>.
                    <?= $activityfile->title ?>                    
                </button>                
            </h2>
            <div id="flush-collapse<?= $activityfile->activityfilesid ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?= $activityfile->activityfilesid ?>" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <a title="Remove File" class="text-danger float-end m-1" href="<?= SITE_URL ?>/?action=delete-activity-file&activityfileid=<?= $activityfile->activityfilesid  ?>&activityid=<?= $activityid ?>" onclick="return confirm('Do you want to remove this item?');"><i class="bi bi-x-square"></i></a>
                    <a href="<?= SITE_URL . $activityfile->fileurl ?>" target="_blank"><?= SITE_URL . $activityfile->fileurl ?></a>
                </div>
            </div>
        </div>              
    <?php $cnt++; endwhile; ?>
        </div>
    </div>
    <?php } else { ?>
    <div class="text-center m-5">No record found.</div>
    <?php } ?>
</div>

<?= element( 'footer' ); ?>