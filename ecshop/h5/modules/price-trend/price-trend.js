(function () {

  'use strict';

  angular
    .module('app')
    .config(config);

  config.$inject = ['$stateProvider', '$urlRouterProvider'];

  function config($stateProvider, $urlRouterProvider) {

    $stateProvider
      .state('price-trend', {
        needAuth: false,
        url: '/price-trend',
        title: "搜索结果",
        templateUrl: 'modules/price-trend/price-trend.html',
      });

  }

})();