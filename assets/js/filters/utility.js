angular.module('FLYERBD')
.filter('thumb', function() {
	return function(imgLink) {
		return imgLink.replace(new RegExp('.jpg' + '$'), '_thumb.jpg');
	};
});