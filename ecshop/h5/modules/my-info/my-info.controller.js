(function () {

	'use strict';

	angular
		.module('app')
		.controller('MyInfoController', MyInfoController);

  MyInfoController.$inject = ['$scope', '$http', '$window', '$location', '$state', 'API', 'ENUM'];

	function MyInfoController($scope, $http, $window, $location, $state, API, ENUM) {

		$scope.nickName = "";
		$scope.mobile = "";
		$scope.address = "";
		$scope.project = "";
		$scope.scale = "";


		$scope.touchChangeInfo = touchChangeInfo;

		function touchChangeInfo() {

			var nickName = $scope.nickName;
			var mobile = $scope.mobile;
			var address = $scope.address;
			var project = $scope.project;
			var scale = $scope.scale;

			API.user.profileUpdate({
				info: {
					nickName: nickName,
					mobile: mobile,
					address: address,
					project: project,
					scale: scale
				}
			}).then(function (res) {
        if (res.id) {
          $scope.toast('更新成功');
          $scope.goBack();
        } else {
          $scope.toast('更新失败');
        }
      })
		}

    (function () {
      API.user.profileGet().then(function (user) {
        $scope.nickName = user.info.nickName;
        $scope.mobile = user.info.mobile;
        $scope.address = user.info.address;
				$scope.project = user.info.project;
				$scope.scale = user.info.scale;
      })
    })();


  }


})();