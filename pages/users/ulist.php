<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>

<?= element( 'header' ); ?>


<table id="example1" class="table table-hover text-sm">
    <thead>
        <tr>
            <th>No.</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Last Name</th>
            <th>Username</th>
            <th>Position</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $users = viewUser();
            foreach ($users as $cnt => $user) {
        ?>
            <tr>
                <td><?php echo $cnt ?></td>
                <td><?php echo $user->fname ?></td>
                <td><?php echo $user->mname ?></td>
                <td><?php echo $user->lname ?></td>
                <td><?php echo $user->username ?></td>
                <td><?php echo $user->usertype ?></td>
                <td>
                    <a href="./edit-user&token=<?php echo $user->token ?>" class="#" title="Edit">
                        <i class="fas fa-info-circle"></i>
                    </a>
                    <a href="#" class="#" title="Delete">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            <?php
            }
        ?>
    </tbody>
</table>

<?= element( 'footer' ); ?>

<script type="text/javascript">
    setTimeout(function () {
        $( "#alert" ).delay(2500).fadeOut(5000);
    }, );
</script>

