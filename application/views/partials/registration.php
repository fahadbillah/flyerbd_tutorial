<form name="registrationForm" ng-submit="registrationSubmit()" role="form">
	<legend>Sign UP for FREE</legend>

	<div class="form-group">
		<label for="">Name *</label>
		<input type="text" class="form-control" name="user_name" ng-model="registration.user_name" placeholder="Name" required>
		<span class="label label-danger" ng-if="registrationForm.user_name.$invalid && registrationForm.user_name.$dirty" >Required</span>
	</div>

	<div class="form-group">
		<label for="">Email *</label>
		<input type="email" class="form-control" name="user_email" ng-model="registration.user_email" placeholder="Email" required>
		<span class="label label-danger" ng-if="registrationForm.user_email.$invalid && registrationForm.user_email.$dirty" >Required</span>
	</div>

	<div class="form-group">
		<label for="">Phone *</label>
		<input type="text" class="form-control" name="user_phone" ng-model="registration.user_phone" placeholder="Phone" required>
		<span class="label label-danger" ng-if="registrationForm.user_phone.$invalid && registrationForm.user_phone.$dirty" >Required</span>
	</div>

	<div class="form-group">
		<label for="">Password *</label>
		<input type="password" class="form-control" name="user_password" ng-model="registration.user_password" placeholder="Password" minlength="8" required>
		<span class="label label-danger" ng-if="registrationForm.user_password.$invalid && registrationForm.user_password.$dirty" >Required</span>
	</div>

	<button type="submit" class="btn btn-primary" ng-disabled="registrationForm.$invalid || registrationForm.$pristine">Submit</button>
</form>


