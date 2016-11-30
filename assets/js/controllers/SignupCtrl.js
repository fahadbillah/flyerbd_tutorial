angular.module('FLYERBD')
.controller('SignupCtrl', ['$scope','$http','$facebook','FACEBOOK_APP_ID','$cookies', function ($scope,$http,$facebook,facebookAppId,$cookies) {

	$scope.facebookRegistration = function() {
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
				alert(data.message);
			})
			.error(function(data) {
				console.log(data);
			});

			
		});
	};

	$scope.registration = {
		user_name: '',
		user_email: '',
		user_phone: '',
		user_password: '',
	};

	$scope.registrationSubmit = function(registrationData) {
		console.log('form submitted!!!');

		console.log(registrationData);

		$http({
			method: 'post',
			data: $.param(registrationData),
			url: 'api/registration/create_user',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			}
		})
		.success(function(data) {
			console.log(data);

			if (data.success === true) {
				$scope.registration = {
					user_name: '',
					user_email: '',
					user_phone: '',
					user_password: '',
				};

				$scope.registrationForm.$setPristine();
			}

			alert(data.message);
		})
		.error(function(data) {
			console.log(data);
			alert('Registration Failed! Try again later.');
		});

	};
}]);