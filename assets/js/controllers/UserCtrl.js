angular.module('FLYERBD')
.controller('UserCtrl', ['$scope','$routeParams','UserService', function ($scope,$routeParams,UserService) {
	$scope.title = 'This is profile view';
}]);