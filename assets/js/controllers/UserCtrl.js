angular.module('FLYERBD')
.controller('UserCtrl', ['$rootScope','$scope','$routeParams','UserService','FileUploader','Toaster', function ($rootScope,$scope,$routeParams,UserService,FileUploader,Toaster) {
	$scope.title = 'This is profile view';

    // 
    $scope.showProgress = false;


    var uploader = $scope.uploader = new FileUploader({
        alias: 'image',
        url: 'api/user/upload_profile_pic',
        removeAfterUpload: true
    });


    // uploader.filters.push({
    //     name: 'image',
    //     fn: function(item {File|FileLikeObject}, options) {
    //         return this.queue.length < 10;
    //     }
    // });

    // CALLBACKS

    uploader.onWhenAddingFileFailed = function(item /*{File|FileLikeObject}*/, filter, options) {
        console.info('onWhenAddingFileFailed', item, filter, options);
    };
    uploader.onAfterAddingFile = function(fileItem) {
        console.info('onAfterAddingFile', fileItem);
    };
    uploader.onAfterAddingAll = function(addedFileItems) {
        console.info('onAfterAddingAll', addedFileItems);
    };
    uploader.onBeforeUploadItem = function(item) {
        $scope.showProgress = true;
        console.info('onBeforeUploadItem', item);
    };
    uploader.onProgressItem = function(fileItem, progress) {
        $scope.uploadProgress = progress;
        console.info('onProgressItem', fileItem, progress);
    };
    uploader.onProgressAll = function(progress) {
        console.info('onProgressAll', progress);
    };
    uploader.onSuccessItem = function(fileItem, response, status, headers) {
        console.info('onSuccessItem', fileItem, response, status, headers);
        $rootScope.user.user_profile_pic = response.data.user_profile_pic;
        $scope.showProgress = false;
    };
    uploader.onErrorItem = function(fileItem, response, status, headers) {
        console.info('onErrorItem', fileItem, response, status, headers);
    };
    uploader.onCancelItem = function(fileItem, response, status, headers) {
        console.info('onCancelItem', fileItem, response, status, headers);
    };
    uploader.onCompleteItem = function(fileItem, response, status, headers) {
        console.info('onCompleteItem', fileItem, response, status, headers);
    };
    uploader.onCompleteAll = function() {
        console.info('onCompleteAll');
    };

    console.info('uploader', uploader);
}]);