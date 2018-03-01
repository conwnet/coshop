(function () {

	'use strict';

	angular
		.module('app')
		.config(config);

	config.$inject = ['$stateProvider', '$urlRouterProvider'];

	function config($stateProvider, $urlRouterProvider) {

		$stateProvider
			.state('agency-result', {
				needAuth: false,
				url: '/agency-result/?keyword&sortKey&sortValue&category&navTitle&navStyle',
				title: "搜索结果",
				templateUrl: 'modules/agency-result/agency-result.html',
			});

	}

})();