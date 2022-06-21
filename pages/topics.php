<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<div class="topic-page mb-2">
    <h1>Topics</h1>
    <div class="m-2">
        <a href="<?= SITE_URL ?>/?page=new-topic">New Topic</a>
    </div>
    <div class="row">
    <?php     
    $todos = $DB->query( "SELECT * FROM topics WHERE userid={$_SESSION['userid']} ORDER BY created DESC" );
    if( $todos && $todos->num_rows ) {
        while( $todo = $todos->fetch_object() ) :
    ?>
    
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <span class="text-decoration-underline float-start m-1"><?= $todo->title ?></span>
                    <a title="Remove Title" class="text-danger float-end m-1" href="<?= SITE_URL ?>/?action=delete-topic&id=<?= $todo->topicid ?>" onclick="return confirm('Do you want to remove this item?')"><i class="bi bi-x-square"></i></a>
                    <a title="Edit Topic" class="text-success float-end m-1" href="<?= SITE_URL ?>/?page=edit-topic&id=<?= $todo->topicid ?>"><i class="bi bi-pencil"></i></a>                    
                </div>
                <div class="card-body">
                    <?= $todo->content ?>
                </div>
            </div>
        </div> 
    
       
    <!-- <div class="alert alert-<?= $todo->status ? 'success' : 'warning' ?>">
        <div class="row">
            <div class="col">                
                <div class="form-check">
                    <input class="form-check-input to-do-checkbox" type="checkbox" value="<?= $todo->todoid ?>" <?= $todo->status ? 'checked' : '' ?>>
                    <label class="form-check-label <?= $todo->status ? 'text-decoration-line-through' : '' ?>" for="flexCheckIndeterminate">
                        <span class="fw-bold"><?= $todo->title ?></span>: <?= $todo->description ?>
                    </label>                    
                </div>         
                <small class="fst-italic" style="font-size: 11px;"><?= $todo->created ?></small>                       
            </div>
            <div class="col-2">                
                
            </div>
        </div>        
    </div> -->
    <?php endwhile; ?>
    </div>
    <?php } else { ?>
    <div class="text-center m-5">No record found.</div>
    <?php } ?>
</div>

<?= element( 'footer' ); ?>