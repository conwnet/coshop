(function () {

	'use strict';

	angular
		.module('app')
		.controller('PriceTrendController', PriceTrendController);

  PriceTrendController.$inject = ['$scope', '$rootScope', '$http', '$window', '$location', '$state', 'API', 'ENUM'];

	function PriceTrendController($scope, $rootScope, $http, $window, $location, $state, API, ENUM) {
		$scope.items = [
      { name: '金鸡报价', url: 'https://mp.weixin.qq.com/s?__biz=MzIzMjEyOTk5NA==&mid=2651331807&idx=1&sn=064a8ea31ad82970d7e9597c7301e15b&chksm=f365287ac412a16cc42a73ff3686c55ff8a5a39f88df5f35542e9cbd3ac00ce4671080f1e93c&mpshare=1&scene=1&srcid=1010r7A2IUR3fSsIIQSudLBX&pass_ticket=xw5AA5kaP5%2FwrRNdss9aLSjVeCygMFjs8tLruPhUaYWfQGD67N7Sy46F0qjGJ6G0#rd' },
      { name: '鸡业行情网', url: 'https://mp.weixin.qq.com/s?__biz=MjM5Mjk5MzY5MQ==&mid=2651546510&idx=1&sn=750b4a08051dddf18e1719d25c8ca4ea&chksm=bd621b7a8a15926ce5d6f407d8e2a91e65cddd6ce878eef0cc22124ed9a9cd2e38954c6585c7&mpshare=1&scene=1&srcid=10107rKeBgNpwZVZI0Q5YRbW&pass_ticket=xw5AA5kaP5%2FwrRNdss9aLSjVeCygMFjs8tLruPhUaYWfQGD67N7Sy46F0qjGJ6G0#rd' },
      { name: '点点禽业', url: 'https://mp.weixin.qq.com/s?__biz=MzI0MTc4NzA5OA==&mid=100000244&idx=1&sn=879353a6919e3a62d326b59abe682757&chksm=690708415e708157149602dfc61b92692a45a59bf642e11640bb58522511b35dc75034a8252e&mpshare=1&scene=1&srcid=1010mk2xV8MPlcJZNWq399JS&pass_ticket=xw5AA5kaP5%2FwrRNdss9aLSjVeCygMFjs8tLruPhUaYWfQGD67N7Sy46F0qjGJ6G0#rd' },
      { name: '优牧通', url: 'https://mp.weixin.qq.com/s?__biz=MzA5MDY0NDU1Mg==&mid=2650334706&idx=1&sn=f6671ae2f2d78fa03efcfbe1670553fb&chksm=8804ccd5bf7345c313be06c70a40c966fb9d3e4658db038d3b66a1aed9393f1eeaa364867c05&mpshare=1&scene=1&srcid=1010uWF81X27EmnQ4rozuxET&pass_ticket=xw5AA5kaP5%2FwrRNdss9aLSjVeCygMFjs8tLruPhUaYWfQGD67N7Sy46F0qjGJ6G0#rd' },
		];

		$scope.goDetail = function (url) {
      $rootScope.detailUrl = url
			$state.go('price-detail', {
			})
    }
  }

})();

