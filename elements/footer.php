<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>
		</div>
      </div>
      <div class="row footer fixed-bottom p-3 bg-light">
        <div class="col">
			&copy; <?= SITE_TITLE ?>
		</div>
      </div>
    </div>

    <script src="<?= SITE_URL ?>/assets/bootstrap-5.2/js/bootstrap.bundle.min.js"></script>
	  <script src="<?= SITE_URL ?>/assets/js/jquery-3.6.0.min.js"></script>	    
    <script src="<?= SITE_URL ?>/assets/js/script.js?sid=<?= md5(time()) ?>"></script>
  </body>
</html>