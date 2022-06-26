<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<div class="professors-page mb-2">
    <h1>Professors</h1>
    <?php if( is_usertype( "professor" ) ) { ?>
    <div class="m-2">
        <a href="<?= SITE_URL ?>/?page=new-professor">New Professor</a>
    </div>
    <?php } ?>
    <div class="row">
        <div class="col">
            <table class="table table-stripeed">
                <tr>                    
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th></th>
                </tr>            
            <?php     
            $professors = $DB->query( "SELECT * FROM users WHERE usertype='professor' ORDER BY lastname, firstname ASC" );            
            if( $professors && $professors->num_rows ) {
                while( $professor = $professors->fetch_object() ) :
                    if ( $professor->userid == $_SESSION[ AUTH_ID ] ) continue;
            ?>
                <tr>                    
                    <td><?= $professor->firstname ?></td>
                    <td><?= $professor->lastname ?></td>
                    <td><?= $professor->username ?></td>
                    <td><?= $professor->email ?></td>
                    <td><?= $professor->status ? '<span class="badge bg-success">ACTIVE</span>' : '<span class="badge bg-danger">INACTIVE</span>' ?></td>
                    <th>
                        <?php 
                            $q = "";
                            $t = "";
                            if( $professor->status ) {
                                $q = 0;
                                $t = "DEACTIVATE";
                            } else {
                                $q = 1;
                                $t = 'ACTIVATE';
                            }
                        ?>
                        <a href="<?= SITE_URL ?>/?action=set-status-prof&stat=<?= $q ?>&id=<?= $professor->userid ?>"><?= $t ?></a>
                    </th>
                </tr>
            <?php endwhile; ?>
            <?php } else { ?>                
                <tr>
                    <td colspan="6">
                        <div class="text-center m-5">No record found.</div>
                    </td>
                </tr>
            <?php } ?>
            </table>
        </div>
    </div>    
</div>

<?= element( 'footer' ); ?>