angular.module('FLYERBD')
.controller('LoginCtrl', ['$scope','$http','$routeParams','UserService','$location', function ($scope,$http,$routeParams,UserService,$location) {
	$scope.title = 'Login';

	$scope.login = {
		email: '',
		password: ''
	};

	$scope.loginSubmit = function(login) {
		$http({
			method: 'post',
			data: $.param({
				email: login.email,
				password: login.password
			}),
			url: 'api/login/varify',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			}
		})
		.success(function(data) {
			console.log(data);
			UserService.setUserData(data.data); // use UserService to save logged in user data to angular frontend for later use
			alert(data.message);
			$location.path('user/'+data.data.user_id); // redirect to profile page after login
		})
		.error(function(data) {
			console.log(data);
		});
	};

	var logout = function() {

		$http({
			method: 'get',
			url: 'api/login/logout'
		})
		.success(function(data) {
			console.log(data);
			UserService.destroy();
		})
		.error(function(data) {
			console.log(data);
			alert('Activation Failed!');
		});	
	}

	if ($routeParams.logout) {
		logout();
	}

}]);