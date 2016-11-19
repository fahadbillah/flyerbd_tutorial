var FLYERBD = angular.module('FLYERBD', [
	'ngRoute'
	]);

FLYERBD.config(['$routeProvider', function ($routeProvider) {
	$routeProvider
	.when('/', {
		templateUrl: 'home',
		controller: 'HomeCtrl'
	})
	.when('/about', {
		templateUrl: 'about',
		controller: 'AboutCtrl'
	})
	.when('/contact', {
		templateUrl: 'contact',
		controller: 'ContactCtrl'
	})
}]);