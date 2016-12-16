angular.module('FLYERBD')
.controller('LoginCtrl', ['$scope','$http','$routeParams','UserService', function ($scope,$http,$routeParams,UserService) {
	$scope.title = 'Login';

	$scope.showForgotPassword = !!$routeParams.forgotPassword;
	$scope.showResetPassword = !!$routeParams.resetPassword;

	$scope.forgotPassword = {
		email: '',
		phone: ''
	};

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
		})
		.error(function(data) {
			console.log(data);
		});
	};

	var activateAccount = function(token) {
		console.log(token);

		$http({
			method: 'get',
			url: 'api/registration/activate_account/'+token
		})
		.success(function(data) {
			console.log(data);

			if (data.success === true) {
			}

			alert(data.message);
		})
		.error(function(data) {
			console.log(data);
			alert('Activation Failed!');
		});

	};

	if (!!$routeParams.activateAccount) {
		activateAccount($routeParams.activateAccount);
	}

	$scope.forgotPasswordSubmit = function(forgotPassword) {

		$http({
			method: 'post',
			data: $.param(forgotPassword),
			url: 'api/login/forgot_password',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			}
		})
		.success(function(data) {
			console.log(data);
			alert(data.message);
		})
		.error(function(data) {
			console.log(data);
		});

	};

	$scope.resetPasswordSubmit = function(resetPassword) {
		resetPassword.user_token = $routeParams.resetPassword;
		$http({
			method: 'post',
			data: $.param(resetPassword),
			url: 'api/login/reset_password',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			}
		})
		.success(function(data) {
			console.log(data);
			alert(data.message);
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