<div class="col-md-4 col-md-offset-4 text-center">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<!-- this img shows only facebook image  -->
			<img ng-if="user.user_login_type === 'facebook'" class="img-circle" ng-src="{{user.user_profile_pic}}" alt="{{user.user_name}}" style="width: 200px;">
			
			<!-- this img shows email logged in user with profile picture uploaded  -->
			<img ng-if="user.user_login_type === 'email' && !!user.user_profile_pic" class="img-circle" ng-src="<?php echo base_url() ?>uploads/{{user.user_profile_pic}}" alt="{{user.user_name}}" style="width: 200px;">
			
			<!-- this img shows email logged in user with no profile picture uploaded  -->
			<img ng-if="user.user_login_type === 'email' && !user.user_profile_pic" class="img-circle" src="http://placehold.it/200" alt="{{user.user_name}}" style="width: 200px;">
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<hr>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<!-- ng-file-upload file element, user $scope.uploader in 'uploader' attribute otherwise file will not upload -->
			<input style="margin: auto;" type="file" nv-file-select uploader="uploader" name="image" />
			
			<!-- this button trigger file upload by calling upload() of first element of 'uploader.queue' -->
			<input type="button" ng-click="uploader.queue[0].upload()" value="Upload">
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<hr>
		</div>
		<!-- showProgress conditionally show progress bar only when file is uploading  -->
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" ng-show="showProgress"> 
			<div class="progress">
				<!-- put $scope.uploadProgress in style section & aria-valuenow -->
				<div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="{{uploadProgress}}" aria-valuemin="0" aria-valuemax="100" style="width: {{uploadProgress}}%">
					<span class="sr-only">{{uploadProgress}}% Complete (success)</span>
				</div>
			</div>
		</div>
	</div>
	<div><i class="fa fa-user-circle"></i> <span>{{user.user_name}}</span> </div>
	<div><i class="fa fa-envelope-open-o"></i> {{user.user_email}}</div>
	<div><i class="fa fa-phone"></i> {{user.user_phone}}</div>

</div>