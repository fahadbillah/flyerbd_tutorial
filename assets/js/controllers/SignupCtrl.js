angular.module('FLYERBD')
.controller('SignupCtrl', ['$scope','$http', function ($scope,$http) {


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
			url: 'registration/create_user',
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