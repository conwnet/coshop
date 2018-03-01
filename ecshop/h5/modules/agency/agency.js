(function () {

	'use strict';

	angular
		.module('app')
		.config(config);

	config.$inject = ['$stateProvider', '$urlRouterProvider'];

	function config($stateProvider, $urlRouterProvider) {

		$stateProvider
			.state('agency', {
				needAuth: false,
				url: '/agency',
				title: "商品分类",
				templateUrl: 'modules/agency/agency.html',
			});

	}

})();