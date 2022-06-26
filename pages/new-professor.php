<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<div class="new-professor-page">
    <h1>New Professor</h1>    
    <div class="col-6">
        <form method="post">
            <input type="hidden" name="action" value="new-professor">
            <input type="hidden" name="data[usertype]" value="professor">            
            <div class="mb-3">
                <label for="Title" class="form-label">Username</label>
                <input type="text" class="form-control"name="data[username]" required>			
            </div>
            <div class="mb-3">
                <label for="Title" class="form-label">Email</label>
                <input type="email" class="form-control"name="data[email]" required>			
            </div> 
            <div class="mb-3">
                <label for="Title" class="form-label">Password</label>
                <input type="password" class="form-control"name="data[password]" required>			
            </div>
            <div class="mb-3">
                <label for="Title" class="form-label">First Name</label>
                <input type="text" class="form-control"name="data[firstname]" required>			
            </div>           
            <div class="mb-3">
                <label for="Title" class="form-label">Last Name</label>
                <input type="text" class="form-control"name="data[lastname]" required>			
            </div> 
            
            <button type="submit" class="btn btn-primary">Add Professor</button>
            <div class="m-2">
                <a href="<?= SITE_URL ?>/?page=activities">Back</a>
            </div>
        </form>	
    </div>

</div>

<?= element( 'footer' ); ?>