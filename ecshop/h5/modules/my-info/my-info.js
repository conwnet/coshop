(function () {

	'use strict';

	angular
		.module('app')
		.config(config);

	config.$inject = ['$stateProvider', '$urlRouterProvider'];

	function config($stateProvider, $urlRouterProvider) {

		$stateProvider
			.state('my-info', {
				needAuth: true,
				url: '/my-info',
				title: "个人资料",
				templateUrl: 'modules/my-info/my-info.html',
			});

	}

})();