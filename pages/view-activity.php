<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>
<?php
    $activityid = $_GET[ 'id' ];
    $activity = $DB->query( "SELECT * FROM activities WHERE activityid=$activityid" );
    $activity = $activity->fetch_object();
?>
<div class="view-activity-page mb-2 pt-2">
    <h1><?= $activity->title ?></h1>
    <?php if( is_usertype( "student" ) ) { ?>
    <div class="m-2">
        <a href="<?= SITE_URL ?>/?page=new-activity-files&activityid=<?= $activityid ?>">Submit Activity</a>
    </div>
    <?php } ?>
    <div class="row">
    <div class="accordion accordion-flush" id="accordionFlushExample">
    <?php   
    $sql = "";
    if(is_usertype( "student" )) {
        $sql = "SELECT * FROM activityfiles AS AF LEFT JOIN users AS U ON AF.studentid=U.userid WHERE activityid=$activityid AND studentid={$_SESSION[ AUTH_ID ]} ORDER BY AF.created DESC";
    } else {
        $sql = "SELECT * FROM activityfiles AS AF LEFT JOIN users AS U ON AF.studentid=U.userid WHERE activityid=$activityid ORDER BY AF.created DESC";            
    }        
    //echo $sql;
    $activityfiles = $DB->query( $sql );
    if( $activityfiles && $activityfiles->num_rows ) {
        $cnt = 1;
        while( $activityfile = $activityfiles->fetch_object() ) :
    ?>            
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-heading<?= $activityfile->activityfilesid ?>">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $activityfile->activityfilesid ?>" aria-expanded="false" aria-controls="flush-collapse<?= $activityfile->activityfilesid ?>">
                    <?= $cnt ?>.
                    <?= $activityfile->title ?>
                    (from: <?= $activityfile->lastname . ", " . $activityfile->firstname ?>)
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
    <div class="text-center m-5">No resources added yet.</div>
    <?php } ?>
</div>

<?= element( 'footer' ); ?>