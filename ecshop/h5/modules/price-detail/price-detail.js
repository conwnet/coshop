(function () {

  'use strict';

  angular
    .module('app')
    .config(config);

  config.$inject = ['$stateProvider', '$urlRouterProvider'];

  function config($stateProvider, $urlRouterProvider) {

    $stateProvider
      .state('price-detail', {
        needAuth: false,
        url: '/price-detail',
        title: "详细介绍",
        templateUrl: 'modules/price-detail/price-detail.html',
      });

  }

})();