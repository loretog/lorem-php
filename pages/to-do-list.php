<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<div class="todo-page">
    <h1>Weekly To-Do List</h1>
    <div class="m-2">
        <a href="<?= SITE_URL ?>/?page=new-todo">New To-Do</a>
    </div>
    <?php     
    $todos = $DB->query( "SELECT * FROM todolist WHERE userid={$_SESSION['userid']} ORDER BY status ASC, created DESC" );
    if( $todos && $todos->num_rows ) {
        while( $todo = $todos->fetch_object() ) :
    ?>
    <div class="alert alert-<?= $todo->status ? 'success' : 'warning' ?>">
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
                <!-- <a class="text-success" href="<?= SITE_URL ?>/?page=edit-todo&id=<?= $todo->todoid ?>">Edit</a>
                <a class="text-danger" href="<?= SITE_URL ?>/?action=delete-todo&id=<?= $todo->todoid ?>" onclick="return confirm('Do you want to remove this item?')">Remove</a> -->
                <a title="Remove To-do" class="text-danger float-end m-1" href="<?= SITE_URL ?>/?action=delete-todo&id=<?= $todo->todoid ?>" onclick="return confirm('Do you want to remove this item?')"><i class="bi bi-x-square"></i></a>
                    <a title="Edit To-do" class="text-success float-end m-1" href="<?= SITE_URL ?>/?page=edit-todo&id=<?= $todo->todoid ?>"><i class="bi bi-pencil"></i></a>      
            </div>
        </div>        
    </div>
    <?php endwhile; 
    } else { ?>
    <div class="text-center m-5">No record found.</div>
    <?php } ?>
</div>

<?= element( 'footer' ); ?>