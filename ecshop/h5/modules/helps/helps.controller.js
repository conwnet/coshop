(function () {

	'use strict';

	angular
		.module('app')
		.controller('HelpsController', HelpsController)
		.directive('repeatFinish', repeatFinishHandler);

	HelpsController.$inject = ['$scope', '$state', '$stateParams', 'API', '$window', 'AppAuthenticationService'];

	const IO_HOST = 'http://api.shop.conw.net:3000';

	function HelpsController($scope, $state, $stateParams, API, $window, AppAuthenticationService) {

		$scope.socket = io.connect(IO_HOST);
        $scope.user = AppAuthenticationService.getUser();
		$scope.sendMessage = sendMessage;
		$scope.showMore = showMore;
		$scope.content = '';
		$scope.username = $scope.user.username;
		var messages = localStorage.getItem('messages_' + $scope.username);
		$scope.messages = messages && JSON.parse(messages).slice(-5) || [
			{ content: '您好，请问有什么可以帮助您的吗？', time: Date.now(), mine: false }
		];

		$scope.socket.onmessage = function (event) {
			if (!event.data) return ;
			var message = event.data;
			$scope.messages.push(JSON.parse(message));
			saveMessage(message);
		}

		if ($stateParams.title) {
			$scope.title = $stateParams.title;
		} else {
			$scope.title = "连接中...";
		}

        $scope.socket.emit('client', {
            userId: $scope.user.username,
            status: 1
        });

        $scope.socket.on('server', function (data) {
            if (data.status === 1) {
                $scope.title = '联系客服';
            } else if (data.status === 2) {
                let msg = data.message;
			    let message = { username: msg.senderId, content: msg.content, time: msg.time, mine: false };
			    $scope.messages.push(message);
			    saveMessage(message);
                $scope.$apply();
            }
        });

		function sendMessage(article) {
			if (!$scope.content) return ;
			let message = { username: $scope.username, content: $scope.content, time: Date.now(), mine: true };
			$scope.messages.push(message);
            let sendData = {
                userId: $scope.user.username,
                status: 2,
                message: {
                    senderId: $scope.user.username,
                    receiverId: $scope.receiver,
                    content: $scope.content
                }
            };
            $scope.socket.emit('client', sendData);
			saveMessage(message);
			$scope.content = '';
		}

		function saveMessage(message) {
			var messages = localStorage.getItem('messages_' + $scope.username);
			if (messages) {
				messages = JSON.parse(messages);
                if (messages.length > 100)
                        messages.unshift();
				messages.push(message);
			} else messages = $scope.messages;
			localStorage.setItem('messages_' + $scope.username, JSON.stringify(messages));
		}

		function showMore () {
			let messages = localStorage.getItem('messages_' + $scope.username);
			messages = messages && JSON.parse(messages) || [];
			if (messages.length > $scope.messages.length) {
				$scope.messages = messages.slice(-$scope.messages.length - 10);
			} else {
				$scope.toast('没有更多消息啦');
			}
		}
	}

	function repeatFinishHandler () {
		return {
			link: function(scope, element, attr) {
				if(scope.$last == true) {
					document.querySelector('.chat-message:last-child').scrollIntoView();
				}
			}
		};
	}

})();
