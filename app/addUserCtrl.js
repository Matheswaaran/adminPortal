app.controller("addUserCtrl", function ($scope, $route, $rootScope, toaster, $routeParams, $location, $http) {

    $scope.user = {};

    $scope.init = function(){
        $http.get("api/checkSession.php")
            .then(function (response) {
                if (response.data.status == "success"){
                    $rootScope.admin_id = response.data.admin_id;
                    $rootScope.admin_username = response.data.admin_username;
                } else if (response.data.status == "error"){
                    toaster.pop(response.data.status,"",response.data.message,3000,'trustedHtml');
                    $location.path('/login');
                }
            });
    };


    $scope.addUser = function (user) {
        $scope.user = {
            first_name : $scope.user.first_name,
            last_name : $scope.user.last_name,
            username : $scope.user.username,
            email : $scope.user.email,
            password : $scope.user.password,
            address_1 : $scope.user.address_1,
            address_2 : $scope.user.address_2,
            district : $scope.user.district,
            state_name : $scope.user.state_name,
            pincode: $scope.user.pincode,
            contact_no : $scope.user.contact_no,
            admin_id : $rootScope.admin_id
        };
        // console.log($scope.user);
        $http.post('api/addUser.php',$scope.user)
            .then(function (response) {
                // console.log(response);
                toaster.pop(response.data.status,"",response.data.message,3000,'trustedHtml');
                if (response.data.status == "success"){
                    $route.reload();
                }
            })
    }


});