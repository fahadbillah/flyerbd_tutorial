var FLYERBD = angular.module('FLYERBD', [
	'ngRoute',
	'ngCookies',
	'oc.lazyLoad',
	'ngFacebook'
	]);

FLYERBD.constant('FACEBOOK_APP_ID', '326474321078728');

FLYERBD.config(['$routeProvider','$facebookProvider','FACEBOOK_APP_ID','$locationProvider', function ($routeProvider,$facebookProvider,facebookAppId,$locationProvider) {

	$facebookProvider.setAppId(facebookAppId);
	$facebookProvider.setPermissions("email,user_friends");

	$routeProvider
	.when('/', {
		templateUrl: 'view/home/index',
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
		templateUrl: 'view/about/index',
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
		templateUrl: 'view/contact/index',
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
		templateUrl: 'view/registration/index',
		controller: 'SignupCtrl',
		resolve: {
			loadAsset: ['$ocLazyLoad', function($ocLazyLoad) {
				return $ocLazyLoad.load([
					'assets/js/controllers/SignupCtrl.js'
					])
			}]
		}
	})
	.when('/error/:errorId', {
		templateUrl: 'view/error/index',
		controller: 'ErrorCtrl',
		resolve: {
			loadAsset: ['$ocLazyLoad', function($ocLazyLoad) {
				return $ocLazyLoad.load([
					'assets/js/controllers/ErrorCtrl.js'
					])
			}]
		}
	})
	.when('/user/:userNameOrId', {
		templateUrl: 'view/user/index',
		controller: 'UserCtrl',
		resolve: {
			loadAsset: ['$ocLazyLoad', function($ocLazyLoad) {
				return $ocLazyLoad.load([
					'assets/js/controllers/UserCtrl.js'
					])
			}]
		}
	})
	.when('/user/profile/edit', {
		templateUrl: 'view/user/index',
		controller: 'UserCtrl',
		resolve: {
			loadAsset: ['$ocLazyLoad', function($ocLazyLoad) {
				return $ocLazyLoad.load([
					'assets/js/controllers/UserCtrl.js'
					])
			}]
		}
	})
	.otherwise({ redirectTo: '/error/404' });

	$locationProvider.html5Mode(true);
}]);

FLYERBD.run([function() {
  (function(){
     if (document.getElementById('facebook-jssdk')) {return;}
     var firstScriptElement = document.getElementsByTagName('script')[0];
     var facebookJS = document.createElement('script'); 
     facebookJS.id = 'facebook-jssdk';
     facebookJS.src = '//connect.facebook.net/en_US/all.js';
     firstScriptElement.parentNode.insertBefore(facebookJS, firstScriptElement);
   }());
}]);



