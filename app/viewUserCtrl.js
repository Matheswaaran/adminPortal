app.controller("viewUserCtrl", function ($scope, $route, $rootScope, toaster, $routeParams, $location, $http) {

    $scope.users = {};
    $scope.allUsers = [];
    $scope.blockedUsers = [];
    $scope.activeUsers = [];

    $scope.init = function(){
        $http.get("api/checkSession.php")
            .then(function (response) {
                if (response.data.status === "success"){
                    $rootScope.admin_id = response.data.admin_id;
                    $rootScope.admin_username = response.data.admin_username;
                    localStorage.setItem("admin_id",response.data.admin_id);
                    localStorage.setItem("admin_username",response.data.admin_username);
                } else if (response.data.status === "error"){
                    toaster.pop(response.data.status,"",response.data.message,3000,'trustedHtml');
                    $location.path('/login');
                }
            });
    };

    $http.get('api/getUsers.php')
        .then(function (response) {
            $scope.users = response.data.records.map(user => {
                user.selected = false;
                return user;
            });
            $scope.allUsers = $scope.users;
            $scope.blockedUsers = $scope.users.filter(user => user.blocked === '1');
            $scope.activeUsers = $scope.users.filter(user => user.blocked === '0');
        });

    $scope.removeUserClick = function() {
        $scope.selected_users = $scope.users.filter(user => user.selected === true);

        if ($scope.selected_users.length === 0){
            toaster.pop("warning","","Select users to remove",3000,'trustedHtml');
        } else{
            $scope.user_data = {users: $scope.selected_users, action: "remove"};
            $http.post("api/manageUsers.php", $scope.user_data)
                .then(function(response){
                    toaster.pop(response.data.status,"",response.data.message,3000,'trustedHtml');
                    if (response.data.status === "success"){
                        $route.reload();
                    }
                });
        }
    };

    $scope.blockUsersClick = function() {
        $scope.selected_users = $scope.users.filter(user => user.selected === true);

        if ($scope.selected_users.length === 0){
            toaster.pop("warning","","Select users to Block",3000,'trustedHtml');
        } else{
            $scope.user_data = {users: $scope.selected_users, action: "block"};
            $http.post("api/manageUsers.php", $scope.user_data)
                .then(function(response){
                    toaster.pop(response.data.status,"",response.data.message,3000,'trustedHtml');
                    if (response.data.status === "success"){
                        $route.reload();
                    }
                });
        }
    };

    $scope.unBlockUsersClick = function() {
        $scope.selected_users = $scope.users.filter(user => user.selected === true);

        if ($scope.selected_users.length === 0){
            toaster.pop("warning","","Select users to Block",3000,'trustedHtml');
        } else{
            $scope.user_data = {users: $scope.selected_users, action: "unblock"};
            $http.post("api/manageUsers.php", $scope.user_data)
                .then(function(response){
                    toaster.pop(response.data.status,"",response.data.message,3000,'trustedHtml');
                    if (response.data.status === "success"){
                        $route.reload();
                    }
                });
        }
    };

});