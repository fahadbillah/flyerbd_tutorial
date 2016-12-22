angular.module('FLYERBD')
.service('Toaster', ['$rootScope','$timeout', function ($rootScope,$timeout) {
	return {
		alerts: [], // this property will contain all notification elements
		interval: null, // this will save timeout 
		setAlert: function(alert) { // this method set notification to this.alerts
			
			this.alerts.push(alert); // push new notification into this.alerts prop.
			var that = this; // to reach this assign it to that

			var unload = function() { // this function unload/remove notification from this.alert at 5 sec interval 
				$timeout.cancel(this.interval); // clear $timeout first or there will be memory leak in js
				if (that.alerts.length === 0) { // stop this function from running infinitely 
					return false;
				}
				this.interval = $timeout(function() {
					that.alerts.shift(); // end of every cycle remove element from the beginning of this.alerts property
					unload(); // call same function recursively, create a loop
				},5000);
			};

			unload(); // call unload for first time
		},
		closeAlert: function(id) { // this method remove notification from this.alert when x clicked
			this.alerts.splice(id,1);
		}
	}
}]);