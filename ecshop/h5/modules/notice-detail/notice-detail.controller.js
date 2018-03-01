(function () {

	'use strict';

	angular
		.module('app')
		.controller('NoticeDetailController', NoticeDetailController);

  NoticeDetailController.$inject = ['$scope', '$sce', '$http', '$window', '$location', '$state', 'API', 'ENUM'];

	function NoticeDetailController($scope, $sce, $http, $window, $location, $state, API, ENUM) {
		$scope.noticeUrl = $sce.trustAsResourceUrl($scope.noticeUrl)
  }


})();