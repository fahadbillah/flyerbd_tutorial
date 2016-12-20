angular.module('FLYERBD')
.service('Toaster', ['$rootScope','$timeout', function ($rootScope,$timeout) {
	return {
		alerts: [],
		interval: null,
		setAlert: function(alert) {
			
			this.alerts.push(alert);
			// $rootScope.alerts.push(alert);
			var that = this;

			var unload = function() {
				$timeout.cancel(this.interval);
				if (that.alerts.length === 0) {
					return false;
				}
				this.interval = $timeout(function() {
					that.alerts.shift();
					// $rootScope.alerts.shift();
					unload();
				},5000);
			};

			unload();
		},
		closeAlert: function(id) {
			this.alerts.splice(id,1);
			// $rootScope.alerts.splice(id,1);
		}
	}
}]);