angular.module('FLYERBD')
.controller('UserCtrl', ['$rootScope','$scope','$routeParams','UserService','FileUploader','Toaster', function ($rootScope,$scope,$routeParams,UserService,FileUploader,Toaster) {
	$scope.title = 'This is profile view';
    $rootScope.toaster = Toaster;

    // conditionally show progress bar
    $scope.showProgress = false;

    // instantiate fileupload
    var uploader = $scope.uploader = new FileUploader({
        // this alias will used in CI upload method, like -> $this->upload->do_upload('image'). without it file upload will fail
        alias: 'image',
        // CI url that will handle file upload
        url: 'api/user/upload_profile_pic',
        // clear image from queue so that same file not uploaded multiple time
        removeAfterUpload: true
    });


    // each of the following callback functions are called at different state of uploading like before, during & after uploading
    uploader.onWhenAddingFileFailed = function(item /*{File|FileLikeObject}*/, filter, options) {
        console.info('onWhenAddingFileFailed', item, filter, options);
    };
    uploader.onAfterAddingFile = function(fileItem) {
        console.info('onAfterAddingFile', fileItem);
    };
    uploader.onAfterAddingAll = function(addedFileItems) {
        console.info('onAfterAddingAll', addedFileItems);
    };
    // this method called just before upload starts
    uploader.onBeforeUploadItem = function(item) {
        // show progress bar at the start of uploading
        $scope.showProgress = true;
        
        // add additional data with file by pushing to item.formData. it can be reached by $this->input->post()
        item.formData.push({
                title: 'image title',
                description: 'image description',
                tags: ['hello','world']
            });


        console.info('onBeforeUploadItem', item);
    };
    // this method called during uploading & and return upload progress count
    uploader.onProgressItem = function(fileItem, progress) {
        // assign progress count to our uploadProgress variable, so we can change progress bar
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
        $scope.uploadProgress = 0;

        $rootScope.toaster.setAlert({ // push notification data into toaster service
            type: response.success ? 'success' : 'error',
            title: response.message.title,
            description: response.message.description
        });
    };
    uploader.onErrorItem = function(fileItem, response, status, headers) {

        $rootScope.toaster.setAlert({ // push notification data into toaster service
            type: 'error',
            title: response.message.title,
            description: response.message.description
        });
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