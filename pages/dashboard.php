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
        </div>
    </div>
</div>

<?= element( 'footer' ); ?>