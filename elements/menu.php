<ul class="nav nav-tabs justify-content-center mb-3">
    <li class="nav-item">
        <a class="nav-link <?= !isset( $_GET[ 'page' ] ) || empty($_GET[ 'page' ]) || $_GET[ 'page' ] == "" ? 'active' : '' ?>" href="<?= SITE_URL ?>/">Survey</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= isset( $_GET[ 'page' ] ) && !empty($_GET[ 'page' ]) || $_GET[ 'page' ] == "dashboard" ? 'active' : '' ?>" href="<?= SITE_URL ?>/?page=dashboard">Dashboard</a>
    </li>            
</ul>