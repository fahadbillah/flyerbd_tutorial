<div class="col-md-4 col-md-offset-4">
	<form name="loginForm" class="form-horizontal" ng-submit="loginSubmit(login)" role="form" novalidate>
			<div class="form-group">
				<legend>Login</legend>
			</div>
			
			<div class="form-group">
				<input type="email" name="email" class="form-control" ng-model="login.email" placeholder="Email" required>
				<span ng-if="loginForm.email.$invalid && loginForm.email.$dirty" class="label label-danger">Required</span>
			</div>
			
			<div class="form-group">
				<input type="password" name="password" class="form-control" ng-model="login.password" placeholder="Password" required>
				<span ng-if="loginForm.password.$invalid && loginForm.password.$dirty" class="label label-danger">Required</span>
			</div>
			

			<div class="form-group">
					<a class="pull-left" href="<?php echo base_url() ?>/login?forgotPassword=true" title="Forgot Password">Forgot Password</a>
					<button type="submit" class="btn btn-primary pull-right">Submit</button>
			</div>
	</form>
</div>