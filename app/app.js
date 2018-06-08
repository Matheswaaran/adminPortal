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

app.run(function ($rootScope, $location, IHRM_adminAppService) {
    $rootScope.$on("$routeChangeStart", function (event, next, current) {

    });
});

app.factory('IHRM_adminAppService', function () {

});