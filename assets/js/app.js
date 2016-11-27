var FLYERBD = angular.module('FLYERBD', [
	'ngRoute',
	'ngCookies',
	'oc.lazyLoad',
	'ngFacebook'
	]);

FLYERBD.constant('FACEBOOK_APP_ID', '326474321078728');

FLYERBD.config(['$routeProvider','$facebookProvider','FACEBOOK_APP_ID', function ($routeProvider,$facebookProvider, facebookAppId) {

	$facebookProvider.setAppId(facebookAppId);
	$facebookProvider.setPermissions("email,user_friends");

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



