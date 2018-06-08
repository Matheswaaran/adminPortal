app.controller("dashboardCtrl", function ($scope, $rootScope, toaster, $routeParams, $location, $http) {

    $scope.doLogout = function () {
        $http.get("api/logout.php")
            .then(function (response) {
                toaster.pop(response.data.status,"",response.data.message,3000,'trustedHtml');
                if (response.data.status == "success"){
                    $location.path('/login');
                }
            });
    }
});