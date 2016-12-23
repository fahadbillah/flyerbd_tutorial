angular.module('FLYERBD')
.controller('HomeCtrl', ['$rootScope','$scope','Toaster', function ($rootScope,$scope,Toaster) {
	$scope.title = 'This is home view';
	$rootScope.toaster = Toaster;
	$rootScope.toaster.setAlert({
		type: 'warning',
		title: 'Something is wrong!',
		description: 'Gotta check out whats going on!!'
	});
	$rootScope.toaster.setAlert({
		type: 'error',
		title: 'Something is definitely wrong!',
		description: 'Abort abort, abandon ship....'
	});
	$rootScope.toaster.setAlert({
		type: 'success',
		title: 'Lets chill!',
		description: 'everything is okay'
	});

	$scope.addToaster = function() {
		$rootScope.toaster.setAlert({
			type: 'success',
			title: 'Lets chill!',
			description: 'everything is okay'
		});
	};
}]);