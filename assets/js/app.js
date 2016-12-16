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
	.when('/login', {
		templateUrl: 'view/login/index',
		controller: 'LoginCtrl',
		resolve: {
			loadAsset: ['$ocLazyLoad', function($ocLazyLoad) {
				return $ocLazyLoad.load([
					'assets/js/controllers/LoginCtrl.js'
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

FLYERBD.run(['$rootScope','UserService', function($rootScope,UserService) {
	$rootScope.user = null; // we define $rootScope.user which will used in many places
	UserService.init(); // every time page refreshed it will check ci backend and if logged_in set user data in angular frontend
	(function(){
		if (document.getElementById('facebook-jssdk')) {return;}
		var firstScriptElement = document.getElementsByTagName('script')[0];
		var facebookJS = document.createElement('script'); 
		facebookJS.id = 'facebook-jssdk';
		facebookJS.src = '//connect.facebook.net/en_US/all.js';
		firstScriptElement.parentNode.insertBefore(facebookJS, firstScriptElement);
	}());
}])

FLYERBD.service('UserService', ['$rootScope', '$http', function ($rootScope, $http) {
	return {
		_user: null, // userservice properties that save user data for later use
		init: function() { // this method will check if already logged in at the first load
			var that = this;
			if (!that.user) {
				$http({
					method: 'get',
					url: 'api/login/status'
				})
				.success(function(data) {
					console.log(data);
					if (!!data.logged_in) {
						that._user = data;
						$rootScope.user = data;
					} else {
						that.destroy();
					}
				})
				.error(function(data) {
					console.log('user not logged in');
				});
			}
		},
		getUserData: function() {
			return this._user;
		},
		setUserData: function(data) { // this method will set user data to _user property and $rootScope.user which will use in many places
			this._user = data;
			$rootScope.user = data;
		},
		destroy: function() { // this method will be used to destroy angular fronend site user data when user logged out
			this._user = null;
			$rootScope.user = null;
		},
		isAuthenticated: function() {
			return !!this._user.logged_in;
		}
	}
}]);



