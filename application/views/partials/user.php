<div class="col-md-4 col-md-offset-4 text-center">
	<div>
		<img class="img-circle" ng-src="{{user.user_profile_pic || 'http://placehold.it/200'}}" alt="{{user.user_name}}" style="width: 200px;">
	</div>
	<div><i class="fa fa-user-circle"></i> <span>{{user.user_name}}</span> </div>
	<div><i class="fa fa-envelope-open-o"></i> {{user.user_email}}</div>
	<div><i class="fa fa-phone"></i> {{user.user_phone}}</div>
</div>