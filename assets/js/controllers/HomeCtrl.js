angular.module('FLYERBD')
.controller('HomeCtrl', ['$rootScope','$scope','Toaster', function ($rootScope,$scope,Toaster) {
	$scope.title = 'This is home view';
}]);