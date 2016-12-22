angular.module('FLYERBD')
.controller('LoginCtrl', ['$rootScope','$scope','$http','$routeParams','UserService','$location','$facebook','FACEBOOK_APP_ID','$cookies','Toaster', function ($rootScope,$scope,$http,$routeParams,UserService,$location,$facebook,facebookAppId,$cookies,Toaster) {

	$rootScope.toaster = Toaster;

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

			$rootScope.toaster.setAlert({ // push notification data into toaster service
				type: data.success ? 'success' : 'error',
				title: data.message.title,
				description: data.message.description
			});
			if (!!data.success) {
				$location.path('user/'+data.data.user_id); // redirect to profile page after login
			}
		})
		.error(function(data) {
			console.log(data);
		});
	};

	$scope.facebookLogin = function() {
		$facebook.login().then(function(response) {
			console.log(response);
			$cookies.put('fbsr_'+facebookAppId, response.authResponse.signedRequest);

			$http({
				method: 'post',
				data: $.param({
					signedRequest: response.authResponse.signedRequest,
					accessToken: response.authResponse.accessToken,
					userID: response.authResponse.userID
				}),
				url: 'api/registration/facebook',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				}
			})
			.success(function(data) {
				console.log(data);
				UserService.setUserData(data.data);

				$rootScope.toaster.setAlert({
					type: data.success ? 'success' : 'error',
					title: data.message.title,
					description: data.message.description
				});
				// alert(data.message);
				$location.path('user/'+data.data.user_id); // redirect to profile page after login
			})
			.error(function(data) {
				console.log(data);
			});
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

			$rootScope.toaster.setAlert({
				type: data.success ? 'success' : 'error',
				title: data.message.title,
				description: data.message.description
			});
		})
		.error(function(data) {
			console.log(data);
			alert('Activation Failed!');
		});	
	};

	if ($routeParams.logout) {
		$location.search({});
		logout();
	}

}]);