<div class="col-md-4 col-md-offset-4">
	<form ng-if="!showForgotPassword && !showResetPassword" name="loginForm" class="form-horizontal" ng-submit="loginSubmit(login)" role="form" novalidate>
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
	<form ng-if="showForgotPassword" name="forgotPasswordForm" ng-submit="forgotPasswordSubmit(forgotPassword)" role="form" novalidate>
			<div class="form-group">
				<legend>Forgot Password <small class="danger">Provide email or phone to recover password</small></legend>
			</div>
			
			<div class="form-group">
				<input type="email" name="email" class="form-control" ng-model="forgotPassword.email" placeholder="Email" required>
			</div>

			<div class="form-group text-center" style="position: relative;">
				<hr style="position: absolute;width: 100%;margin-top: 9px;z-index: 1;">
				<span style="border-radius: 50px;padding: 4px;background-color: #b4b4b4;color: #ffffff;position: relative;z-index: 2;">OR</span>
			</div>
			
			<div class="form-group">
				<!-- <div class="input-group"> -->
					<!-- <span class="input-group-addon" id="sizing-addon2">+880</span> -->
					<input type="text" name="phone" class="form-control" ng-model="forgotPassword.phone" placeholder="Phone number" required>
				<!-- </div> -->
			</div>
			

			<div class="form-group">
				<a class="btn btn-default" href="<?php echo base_url() ?>/login" title="Back to login">Back</a>
				<button type="submit" class="btn btn-primary pull-right" ng-disabled="forgotPasswordForm.email.$invalid && forgotPasswordForm.phone.$invalid">Submit</button>
			</div>
	</form>
	<form ng-if="showResetPassword" name="resetPasswordForm" ng-submit="resetPasswordSubmit(resetPassword)" role="form" novalidate>
			<div class="form-group">
				<legend>Reset Password</legend>
			</div>
			
			<div class="form-group">
				<input type="password" name="password" class="form-control" ng-model="resetPassword.password" placeholder="Password" required>
			</div>

			<div class="form-group">
				<input type="password" name="re_password" class="form-control" ng-model="resetPassword.re_password" placeholder="Confirm password" required>
			</div>
			

			<div class="form-group">
				<button type="submit" class="btn btn-primary pull-right" ng-disabled="resetPasswordForm.$invalid || (resetPassword.password !== resetPassword.re_password)">Submit</button>
			</div>
	</form>
</div>