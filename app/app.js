var app = angular.module('IHRM_adminApp',['ngRoute','ngAnimate','toaster']);

app.config(['$locationProvider', '$routeProvider', function ($locationProvider, $routeProvider) {
    $locationProvider.hashPrefix('!');
	$routeProvider
	.when('/login', {
    	title: 'Login',
    	templateUrl: 'partials/login.html',
    	controller: 'authCtrl'
    })
    .when('/logout', {
    	title: 'Logout',
    	templateUrl: 'partials/login.html',
    	controller: 'logoutCtrl'
    })
    .when('/dashboard', {
        title: 'Dashboard',
        templateUrl: 'partials/dashboard.html',
        controller: 'dashboardCtrl'
    })
	.when('/addUser', {
		title: 'Add user',
		templateUrl: 'partials/adduser.html',
		controller: 'addUserCtrl'
	})
	// .when('/addContractor', {
	// 	title: 'Add Contractor',
	// 	templateUrl: 'partials/addContractor.html',
	// 	controller: 'addContractCtrl'
	// })
	// .when('/addPkgContractor', {
	// 	title: 'Add Package Contractor',
	// 	templateUrl: 'partials/addpkgcontractor.html',
	// 	controller: 'addPkgContractCtrl'
	// })
	.when('/', {
    	title: 'Login',
    	templateUrl: 'partials/login.html',
    	controller: 'authCtrl',
    	role: '0'
    })
    .otherwise({
    	redirectTo: '/login'
    });
}]);

app.run(function ($rootScope, $location, $http, IHRM_adminAppService) {
    $rootScope.$on("$routeChangeStart", function (event, next, current) {

        if ($location.path() == '/' || $location.path() == '/login'){
    		$rootScope.navBar = true;
    		$rootScope.sideMenu = true;
    		$rootScope.loginPage = false;
		}else{
            $rootScope.navBar = false;
            $rootScope.sideMenu = false;
            $rootScope.loginPage = true;
		}

		$rootScope.admin_id;
        $rootScope.admin_username;
    });
});

app.factory('IHRM_adminAppService', function () {

});