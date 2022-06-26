<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<div class="new-topic-page">
    <h1>My Profile</h1>    
    <div class="col-6">
        <form method="post">
            <?php
                $profile = $DB->query( "SELECT * FROM users WHERE userid={$_SESSION[ AUTH_ID ]}" );
                $profile = $profile->fetch_object();
            ?>
            <input type="hidden" name="action" value="update-profile">
            <input type="hidden" name="data[userid]" value="<?= $_SESSION[ AUTH_ID ] ?>">
            <div class="mb-3">
                <label for="Title" class="form-label">First Name</label>
                <input type="text" class="form-control"name="data[firstname]" value="<?= $profile->firstname ?>">			
            </div>
            <div class="mb-3">
                <label for="Title" class="form-label">Last Name</label>
                <input type="text" class="form-control"name="data[lastname]" value="<?= $profile->lastname ?>">			
            </div>                                    
            <div class="mb-3">
                <label for="Title" class="form-label">Password</label>
                <input type="password" class="form-control"name="data[password]" value="">			
                <div id="" class="form-text">Leave the field blank if you don't want to update your password.</div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Update Profile</button>
            </div>
        </form>	
    </div>

</div>

<?= element( 'footer' ); ?>