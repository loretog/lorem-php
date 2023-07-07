<div class="col-4 p-5">
	<h3>Login</h3>
	<?= show_message();?>
	<form method="post">
		<input type="hidden" name="action" value="validate_user">
		<?= csrf(); ?>

		<div class="mb-3">
			<label for="exampleInputEmail1" class="form-label">Email</label>
			<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">			
		</div>		
		<div class="mb-3">
			<label for="exampleInputPassword1" class="form-label">Password</label>
			<input type="password" class="form-control" id="exampleInputPassword1" name="password">
		</div>
		<div class="mb-3">
			<a href="<?= SITE_URL ?>/?page=register">Register</a>
		</div>
		
		<button type="submit" class="btn btn-primary">Login</button>
	</form>	
</div>
