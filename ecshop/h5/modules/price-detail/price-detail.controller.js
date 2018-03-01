(function () {

	'use strict';

	angular
		.module('app')
		.controller('PriceDetailController', PriceDetailController);

  PriceDetailController.$inject = ['$scope', '$sce', '$http', '$window', '$location', '$state', 'API', 'ENUM'];

	function PriceDetailController($scope, $sce, $http, $window, $location, $state, API, ENUM) {
		$scope.detailUrl = $sce.trustAsResourceUrl($scope.detailUrl)
  }


})();