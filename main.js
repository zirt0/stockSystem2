	var app = angular.module('APP',['ngRoute', 'ngCookies', 'ngSanitize','ngAnimate', 'angular-md5']);
	console.log("sadasdadssa");
	app.filter("sanitize", ['$sce', function($sce) {
		return function(htmlCode){
			return $sce.trustAsHtml(htmlCode);
		}
	}]);

	app.filter('num', function() {
	    return function(input) {
	      return parseInt(input, 10);
	    };
	});


	app.config(function($routeProvider){

		console.log("RouteProvider");
		
		$routeProvider
		.when('/login', {
		    controller: 'loginCtrl',
		    templateUrl: 'partials/login.html'
		})

		.when('/dashboard', {
		    controller: 'dashboardCtrl',
		    templateUrl: 'partials/dashboard.html'
		})
		
		.otherwise({
			redirectTo:'/dashboard'
		});

		//$locationProvider.html5Mode(true)
	})

	app.run(function($rootScope, $cookies, $http, $location, $timeout){

		$rootScope.userDetail = {};
		$rootScope.login = {};
		$rootScope.pageData = {};

		console.log($cookies.get('loggedIn'));
		console.log($cookies)
		// if($cookies.get('loggedIn') == "true"){

		// 	console.log("COOKIE YES" + $cookies.get('username') + " " + $cookies.get('password'));
		// 	$rootScope.login.username = $cookies.get('username');
		// 	$rootScope.login.password = $cookies.get('password');
		// 	console.log($rootScope.login);
			
		// 	$http.post("server/read.php",{'subject': "login", 'args': $rootScope.login })
	 //        	.success(function (response) {

	 //        	console.log(response);
	 //        	$rootScope.userDetailsFnc(response);
	 //        	$rootScope.loggedIn = true;

		//    	});
			
		// }else{
		// 	console.log("COOKIE NO");
		// }


		// $rootScope.userDetailsFnc = function(response){
		// 	console.log(response);

	 //   		$rootScope.userDetail.hourrate = response["hourrate"];
		// 	$rootScope.userDetail.fname = response["fname"];
		// 	$rootScope.userDetail.lname = response["lname"];
		// 	$rootScope.userDetail.avatar = response["avatar"];
		// 	$rootScope.userDetail.id = response["id"];
		// 	$rootScope.userDetail.userRole = response["role"];

		// 	//$rootScope.getNotification();
		// }
		// //$rootScope.getNotification();



		// //$rootScope.getNotification();

		// $rootScope.logoutFnc = function(){

		// 	$cookies.remove("username");
		// 	$cookies.remove("password");
		// 	$cookies.remove("loggedIn");
		// 	$rootScope.loggedIn = false;

		// 	console.log("Logout");
		// }

		$rootScope.succesModalBox = function(status, message, page){

			if(status){	
				$rootScope.modalBoxSucces = true;
				$rootScope.modalBoxmessage = message;

				$timeout(function(){
					$rootScope.modalBoxSucces = false;
				}, 3000);

				if(page){
					$location.path(page);
				}
				//window.scrollTo(0,0);
			}else{
				$rootScope.modalBoxError = true;
				$rootScope.modalBoxmessage = message;
				//window.scrollTo(0,0);
				$timeout(function(){
					$rootScope.modalBoxError = false;
				}, 3000);

			}

		}

	});