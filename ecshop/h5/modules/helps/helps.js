/**
 * Created by howiezhang on 16/10/6.
 */
(function () {

	'use strict';

	angular
		.module('app')
		.config(config);

	config.$inject = ['$stateProvider', '$urlRouterProvider'];

	function config($stateProvider, $urlRouterProvider) {
		$stateProvider
			.state('helps', {
				needAuth: true,
				url: '/helps',
				title: "联系客服",
				templateUrl: 'modules/helps/helps.html',
			});
	}

})();
