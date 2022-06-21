<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<div class="default-page pb-3 pt-3">
    <div class="row">
        <div class="col">
            <div class="row">
                <?php
                    $user = $DB->query( "SELECT * FROM users WHERE userid={$_SESSION['userid']}" );
                    $user = $user->fetch_object();
                ?>
                <div class="col">
                    <img src="..." class="img-thumbnail" alt="..." >
                </div>            
                <div class="col">                    
                    <h1>Welcome <?= $user->username ?></h1>
                </div>            
            </div>
            <div class="row">
                <?php 
                    $topics = $DB->query( "SELECT * FROM topics WHERE userid={$_SESSION['userid']} ORDER BY created DESC LIMIT 3" );
                ?>
                <h3>To-Do List</h3>
                <?php if( $topics && $topics->num_rows ) : ?>                
                    <?php while( $topic = $topics->fetch_object() ) : ?>
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                            <?= $topic->title ?>
                            </div>
                            <div class="card-body">
                            <?= $topic->content ?>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>              
                <?php else: ?>
                    No topics found.
                <?php endif; ?>                                
            </div>                               
        </div>
        <div class="col-4">
            <?php 
                $todos = $DB->query( "SELECT * FROM todolist WHERE userid={$_SESSION['userid']} AND status=0" );
            ?>
            <h3>To-Do List</h3>
            <?php if( $todos && $todos->num_rows ) : ?>
            <ol class="list-group list-group-numbered">
                <?php while( $todo = $todos->fetch_object() ) : ?>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                    <div class="fw-bold"><?= $todo->title ?></div>
                    <?= $todo->description ?>
                    </div>
                    <span class="badge bg-primary rounded-pill"><?= $todo->created ?></span>
                </li>  
                <?php endwhile; ?>              
            </ol>
            <?php else: ?>
                All done!
            <?php endif; ?>
        </div>
    </div>
</div>

<?= element( 'footer' ); ?>