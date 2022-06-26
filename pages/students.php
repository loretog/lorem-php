<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>

<div class="students-page mb-2">
    <h1>Students</h1>
    
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
            $students = $DB->query( "SELECT * FROM users WHERE usertype='student' ORDER BY lastname, firstname ASC" );
            if( $students && $students->num_rows ) {
                while( $student = $students->fetch_object() ) :
            ?>
                <tr>                    
                    <td><?= $student->firstname ?></td>
                    <td><?= $student->lastname ?></td>
                    <td><?= $student->username ?></td>
                    <td><?= $student->email ?></td>
                    <td><?= $student->status ? '<span class="badge bg-success">ACTIVE</span>' : '<span class="badge bg-danger">INACTIVE</span>' ?></td>
                    <th>
                        <?php 
                            $q = "";
                            $t = "";
                            if( $student->status ) {
                                $q = 0;
                                $t = "DEACTIVATE";
                            } else {
                                $q = 1;
                                $t = 'ACTIVATE';
                            }
                        ?>
                        <a href="<?= SITE_URL ?>/?action=set-status&stat=<?= $q ?>&id=<?= $student->userid ?>"><?= $t ?></a>
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