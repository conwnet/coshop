(function () {

	'use strict';

	angular
		.module('app')
		.controller('CategoryController', CategoryController);

	CategoryController.$inject = ['$scope', '$http', '$location', '$state', '$stateParams', 'API', 'ENUM', 'CartModel'];

	function CategoryController($scope, $http, $location, $state, $stateParams, API, ENUM, CartModel) {

		var PER_PAGE = 1000;

		$scope.top = $stateParams.top || 0;
		$scope.topCategories = [];
		$scope.categories = [];
		$scope.selectedSide = null;

		$scope.touchSearch = _touchSearch;
		$scope.touchSide = _touchSide;
		$scope.touchMain = _touchMain;
		$scope.touchTop = _touchTop;

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

				$state.go('search-result', {
					sortKey: ENUM.SORT_KEY.DEFAULT,
					sortValue: ENUM.SORT_VALUE.DEFAULT,

					keyword: null,
					category: side.id,

					navTitle: side.name,
					navStyle: 'default'
				});

			} else {
				$state.go('search-result', {
					sortKey: ENUM.SORT_KEY.DEFAULT,
					sortValue: ENUM.SORT_VALUE.DEFAULT,

					keyword: null,
					category: main.id,

					navTitle: main.name,
					navStyle: 'default'
				});
			}
		}

		function _touchTop(index) {
			$state.go('category', {
				top: index
			});
		}

		function _reloadCategories() {
			API.category
				.list({
					page: 1,
					per_page: PER_PAGE
				})
				.then(function (categories) {
					categories = categories.filter(x => x.name != '中介贸易').slice(0, 4);
					if (categories && categories.length) {
						$scope.topCategories = categories;
						categories = categories[$scope.top].categories;
					}
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

		if ($scope.top && ($scope.top < 0 || $scope.top > 3)) {
			$scope.toast('top 值不合法！');
			return ;
		}

		_reload();
	}

})();