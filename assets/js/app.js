var FLYERBD = angular.module('FLYERBD', [
	'ngRoute',
	'oc.lazyLoad'
	]);

FLYERBD.config(['$routeProvider', function ($routeProvider) {
	$routeProvider
	.when('/', {
		templateUrl: 'home',
		controller: 'HomeCtrl',
		resolve: {
			loadAsset: ['$ocLazyLoad', function($ocLazyLoad) {
				return $ocLazyLoad.load([
					'assets/js/controllers/HomeCtrl.js',
					])
			}]
		}
	})
	.when('/about', {
		templateUrl: 'about',
		controller: 'AboutCtrl',
		resolve: {
			loadAsset: ['$ocLazyLoad', function($ocLazyLoad) {
				return $ocLazyLoad.load([
					'assets/js/controllers/AboutCtrl.js'
					])
			}]
		}
	})
	.when('/contact', {
		templateUrl: 'contact',
		controller: 'ContactCtrl',
		resolve: {
			loadAsset: ['$ocLazyLoad', function($ocLazyLoad) {
				return $ocLazyLoad.load([
					'assets/js/controllers/ContactCtrl.js'
					])
			}]
		}
	})
	.when('/signup', {
		templateUrl: 'registration',
		controller: 'SignupCtrl',
		resolve: {
			loadAsset: ['$ocLazyLoad', function($ocLazyLoad) {
				return $ocLazyLoad.load([
					'assets/js/controllers/SignupCtrl.js'
					])
			}]
		}
	})
}]);