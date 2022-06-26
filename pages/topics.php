<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<div class="topic-page mb-2">
    <h1>Topics</h1>
    <?php if( is_usertype( "professor" ) ) { ?>
    <div class="m-2">
        <a href="<?= SITE_URL ?>/?page=new-topic">New Topic</a>
    </div>
    <?php } ?>
    <div class="row">
    <?php   
    $sql = "";
    if( is_usertype( "professor" ) ) {
        $sql = "SELECT * FROM topics AS T LEFT JOIN users AS U ON T.userid=U.userid WHERE T.userid={$_SESSION[ AUTH_ID ]} ORDER BY T.created DESC";
    } else {
        $sql = "SELECT * FROM topics AS T LEFT JOIN users AS U ON T.userid=U.userid ORDER BY T.created DESC";
    }  
    $todos = $DB->query( $sql );
    if( $todos && $todos->num_rows ) {
        while( $todo = $todos->fetch_object() ) :
    ?>
    
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <span class="float-start m-1"><?= $todo->title ?> <span class="badge bg-info text-uppercase">Prof. <?= $todo->username ?></span></span>

                    <?php if( is_usertype( "professor" ) ) { ?>
                    <a title="Remove Title" class="text-danger float-end m-1" href="<?= SITE_URL ?>/?action=delete-topic&id=<?= $todo->topicid ?>" onclick="return confirm('Do you want to remove this item?')"><i class="bi bi-x-square"></i></a>
                    <a title="Edit Topic" class="text-success float-end m-1" href="<?= SITE_URL ?>/?page=edit-topic&id=<?= $todo->topicid ?>"><i class="bi bi-pencil"></i></a>
                    <?php } ?>
                </div>
                <div class="card-body">
                    <?= $todo->content ?>
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