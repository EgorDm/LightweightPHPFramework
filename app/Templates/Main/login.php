<div class="row">
	<div class="col-md-6">
		<h1>Login</h1>
		<br>
		<form method="post" action="<?= $this->link(array('controller' => 'main', 'action' => 'login')) ?>">
			<div class="form-group">
				<label for="login_username">Username</label>
				<input type="text" class="form-control" id="login_username" placeholder="Username" name="username">
			</div>
			<div class="form-group">
				<label for="login_password">Password</label>
				<input type="password" class="form-control" id="login_password" placeholder="Password" name="password">
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
	<div class="col-md-6">
		<h1>Register</h1>
		<br>
		<form method="post" action="<?= $this->link(array('controller' => 'main', 'action' => 'register')) ?>">
			<div class="form-group">
				<label for="register_username">Username</label>
				<input type="text" class="form-control" id="register_username" placeholder="Username" name="username">
			</div>
			<div class="form-group">
				<label for="register_password">Password</label>
				<input type="password" class="form-control" id="register_password" placeholder="Password" name="password">
			</div>
			<div class="form-group">
				<label for="register_email">Email</label>
				<input type="email" class="form-control" id="register_email" placeholder="Email" name="email">
			</div>
			<div class="form-group">
				<label for="register_password">City</label>
				<input type="text" class="form-control" id="register_city" placeholder="City" name="city">
			</div>
			<div class="form-group">
				<label for="register_password">Address</label>
				<input type="text" class="form-control" id="register_address" placeholder="Address" name="address">
			</div>
			<div class="form-group">
				<label for="register_password">ZIP Code</label>
				<input type="text" class="form-control" id="register_zip" placeholder="ZIP Code" name="zip">
			</div>
			
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</div>