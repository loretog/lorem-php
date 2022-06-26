<div class="col-4 p-5 justify-content-end">
    <h1>Register</h1>
    <form method="post">
        <input type="hidden" name="action" value="register_user">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="data[email]">			
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Username</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="data[username]">			
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">First Name</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="data[firstname]">			
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="data[lastname]">			
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="data[password]">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Re-type Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
        </div>
        <div class="mb-3">
            <a href="<?= SITE_URL ?>/?page=login">Login</a>
        </div>
        
        <button type="submit" class="btn btn-primary">Register</button>
    </form>	
</div>