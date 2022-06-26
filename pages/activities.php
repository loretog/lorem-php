<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<div class="activity-page mb-2">
    <h1>Activities</h1>
    <?php if( is_usertype( "professor" ) ) { ?>
    <div class="m-2">
        <a href="<?= SITE_URL ?>/?page=new-activity">New Activity</a>
    </div>
    <?php } ?>
    <div class="row">
    <?php   
    $sql = "";  
    if( is_usertype( "professor" ) ) {
        $sql = "SELECT * FROM activities AS A LEFT JOIN users AS U ON A.userid=U.userid WHERE A.userid={$_SESSION[ AUTH_ID ]} ORDER BY A.created DESC";
    } else {
        $sql = "SELECT * FROM activities AS A LEFT JOIN users AS U ON A.userid=U.userid ORDER BY A.created DESC";
    }
    $activities = $DB->query( $sql );
    if( $activities && $activities->num_rows ) {
        while( $activity = $activities->fetch_object() ) :
    ?>
    
        <div class="col-4 mb-2">
            <div class="card">
                <div class="card-header">
                    <span class="float-start m-1"><?= $activity->title ?> <span class="badge bg-info text-uppercase">Prof. <?= $activity->lastname ?></span></span>
                    <?php if( is_usertype( "professor" ) ) { ?>
                    <a title="Remove Title" class="text-danger float-end m-1" href="<?= SITE_URL ?>/?action=delete-activity&id=<?= $activity->activityid ?>" 
                    onclick="return confirm('Do you want to remove this item?')"><i class="bi bi-x-square"></i></a>
                    <a title="Edit Topic" class="text-success float-end m-1" href="<?= SITE_URL ?>/?page=edit-activity&id=<?= $activity->activityid ?>"><i class="bi bi-pencil"></i></a>    
                    <?php } ?>
                    
                    <a title="View Files" class="text-danger float-end m-1" href="<?= SITE_URL ?>/?page=view-activity&id=<?= $activity->activityid ?>"><i class="bi bi-eye"></i></i></a>
                </div>
                <div class="card-body">
                    <?= $activity->content ?>
                </div>
            </div>
        </div> 
    <?php endwhile; ?>
    </div>
    <?php } else { ?>
    <div class="text-center m-5">No record found.</div>
    <?php } ?>
</div>

<?= element( 'footer' ); ?>