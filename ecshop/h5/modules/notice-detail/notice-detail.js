(function () {

  'use strict';

  angular
    .module('app')
    .config(config);

  config.$inject = ['$stateProvider', '$urlRouterProvider'];

  function config($stateProvider, $urlRouterProvider) {

    $stateProvider
      .state('notice-detail', {
        needAuth: false,
        url: '/notice-detail',
        title: "公告详情",
        templateUrl: 'modules/notice-detail/notice-detail.html',
      });

  }

})();