<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<div class="default-page pb-3 pt-3">
    <div class="row">
        <div class="col">
            <div class="row">                
                <?php
                    $user = $DB->query( "SELECT * FROM users WHERE userid={$_SESSION[ AUTH_ID ]}" );
                    $user = $user->fetch_object();
                ?>                         
                <div class="col d-flex align-items-center text-center" style="height: 200px;">                    
                    <h1 class="">Welcome <?= $user->username ?></h1>
                </div>            
            </div>
            <div class="row">
                <?php 
                    $topics = $DB->query( "SELECT * FROM topics AS T LEFT JOIN users AS U ON T.userid=U.userid ORDER BY T.created DESC LIMIT 3" );
                ?>
                <h3>Topics</h3>
                <?php if( $topics && $topics->num_rows ) : ?>                
                    <?php while( $topic = $topics->fetch_object() ) : ?>
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                            <?= $topic->title ?> <span class="badge bg-info text-uppercase">Prof. <?= $topic->lastname ?></span>
                            </div>
                            <div class="card-body">
                            <?= $topic->content ?>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>              
                <?php else: ?>
                    <div class="col"><span class="badge bg-success">No topics found.</span></div>
                <?php endif; ?>                                
            </div>                               
        </div>
        <div class="col-4">
            <?php 
                $sql = "SELECT *, TL.todoid AS todo_id, (SELECT todostatus FROM todolist_status WHERE todoid=todo_id AND studentid={$_SESSION[ AUTH_ID ]}) AS todostatus FROM todolist AS TL LEFT JOIN users AS U ON TL.userid=U.userid ORDER BY todostatus ASC, TL.created DESC";
                $todos = $DB->query( $sql );
            ?>
            <h3>To-Do List</h3>
            <?php if( $todos && $todos->num_rows ) : ?>
            <ol class="list-group list-group-numbered">
                <?php while( $todo = $todos->fetch_object() ) : ?>
                <?php if( $todo->todostatus ) continue; ?>
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
                <span class="badge bg-success">All done!</span>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= element( 'footer' ); ?>