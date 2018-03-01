(function () {

	'use strict';

	angular
		.module('app')
		.controller('AgencyController', AgencyController);

	AgencyController.$inject = ['$scope', '$http', '$location', '$state', 'API', 'ENUM', 'CartModel'];

	function AgencyController($scope, $http, $location, $state, API, ENUM, CartModel) {

		var PER_PAGE = 1000;

		$scope.categories = [];
		$scope.selectedSide = null;

		$scope.touchSearch = _touchSearch;
		$scope.touchSide = _touchSide;
		$scope.touchMain = _touchMain;

		$scope.cartModel = CartModel;

		function _touchSearch() {
			$state.go('search', {});
		}

		function _touchSide(side) {
			$scope.selectedSide = side;
			$scope.subCategories = side.categories;
		}

		function _touchMain(main) {
			if (!main) {

				var side = $scope.selectedSide;

				$state.go('agency-result', {
					sortKey: ENUM.SORT_KEY.DEFAULT,
					sortValue: ENUM.SORT_VALUE.DEFAULT,

					keyword: null,
					category: side.id,

					navTitle: side.name,
					navStyle: 'default'
				});

			} else {

				$state.go('agency-result', {
					sortKey: ENUM.SORT_KEY.DEFAULT,
					sortValue: ENUM.SORT_VALUE.DEFAULT,

					keyword: null,
					category: main.id,

					navTitle: main.name,
					navStyle: 'default'
				});

			}
		}

		function _reloadCategories() {
			API.category
				.list({
					page: 1,
					per_page: PER_PAGE
				})
				.then(function (categories) {
					categories = categories.filter(x => x.name == '中介贸易');
					if (categories && categories.length) {
						$scope.categories = categories;
						$scope.selectedSide = categories[0];
						$scope.subCategories = categories[0].categories;
					} else {
						$scope.categories = null;
						$scope.selectedSide = null;
						$scope.subCategories = null;
					}
				});
		}

		function _reload() {
			_reloadCategories();
		}

		_reload();
	}

})();