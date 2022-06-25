<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<div class="todo-page pb-5">
    <h1>Weekly To-Do List</h1>
    <?php if( is_usertype( "professor" ) ) { ?>
    <div class="m-2">
        <a href="<?= SITE_URL ?>/?page=new-todo">New To-Do</a>
    </div>
    <?php } ?>
    <?php     
    $sql = "";
    if( is_usertype( "professor" ) ) {
        $sql = "SELECT * FROM todolist WHERE userid={$_SESSION[ AUTH_ID ]} ORDER BY created DESC";
    } else {
        $sql = "SELECT *, TL.todoid AS todo_id, (SELECT todostatus FROM todolist_status WHERE todoid=todo_id AND studentid={$_SESSION[ AUTH_ID ]}) AS todostatus FROM todolist AS TL LEFT JOIN users AS U ON TL.userid=U.userid ORDER BY todostatus ASC, TL.created DESC;";
    }
    
    $todos = $DB->query( $sql );
    if( $todos && $todos->num_rows ) {
        while( $todo = $todos->fetch_object() ) :
    ?>
        <?php if( is_usertype( "professor" ) ) { ?>
            <div class="alert alert-info">
            <div class="row">
                <div class="col">           
                    
                    <span class="fw-bold"><?= $todo->title ?></span>: <?= $todo->description ?>
                    
                    <br>
                    <small class="fst-italic" style="font-size: 11px;"><?= $todo->created ?></small>                       
                </div>
                <div class="col-2">                                    
                    <a title="Remove To-do" class="text-danger float-end m-1" href="<?= SITE_URL ?>/?action=delete-todo&id=<?= $todo->todoid ?>" onclick="return confirm('Do you want to remove this item?')"><i class="bi bi-x-square"></i></a>
                        <a title="Edit To-do" class="text-success float-end m-1" href="<?= SITE_URL ?>/?page=edit-todo&id=<?= $todo->todoid ?>"><i class="bi bi-pencil"></i></a>  
                </div>
            </div>        
        </div>
        <?php } else { ?>
        <div class="alert alert-<?= $todo->todostatus ? 'success' : 'warning' ?>">
            <div class="row">
                <div class="col">                               
                    <div class="form-check">                                    
                        <input class="form-check-input to-do-checkbox" type="checkbox" value="<?= $todo->todo_id ?>" <?= $todo->todostatus ? 'checked' : '' ?> data-student-id="<?= $_SESSION[ AUTH_ID ] ?>">           
                        <label class="form-check-label <?= $todo->todostatus ? 'text-decoration-line-through' : '' ?>" for="flexCheckIndeterminate">
                            <span class="fw-bold"><?= $todo->title ?></span>: <?= $todo->description ?>
                        </label>                                        
                    </div>                             
                    <small class="fst-italic" style="font-size: 11px;">Prof. <?= $todo->lastname ?> - <?= $todo->created ?></small>                       
                </div>               
            </div>        
        </div>
    <?php } ?>
    <?php endwhile; 
    } else { ?>
    <div class="text-center m-5">No record found.</div>
    <?php } ?>
</div>

<?= element( 'footer' ); ?>