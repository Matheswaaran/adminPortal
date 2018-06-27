app.controller("addUserCtrl", function ($scope, $route, $rootScope, toaster, $routeParams, $location, $http) {

    $scope.user = {};

    $scope.init = function(){
        $http.get("api/checkSession.php")
            .then(function (response) {
                if (response.data.status == "success"){
                    $rootScope.admin_id = response.data.admin_id;
                    $rootScope.admin_username = response.data.admin_username;
                    localStorage.setItem("admin_id",response.data.admin_id);
                    localStorage.setItem("admin_username",response.data.admin_username);
                } else if (response.data.status == "error"){
                    toaster.pop(response.data.status,"",response.data.message,3000,'trustedHtml');
                    $location.path('/login');
                }
            });
    };

    $scope.chkUsername = function (username){
      if (username) {
        $scope.data = {
          data: username,
          type: "username"
        }
        $http.post('api/chkAvailability.php',$scope.data)
            .then(function (response) {
              // console.log(response);
              if (response.data.status == "available") {
                document.getElementById('useravail').style.display = "none";
              }else if (response.data.status == "not available") {
                document.getElementById('useravail').style.display = "block";
              }
            });
      }
    }

    $scope.chkEmail = function (email){
      if (email) {
        $scope.data = {
          data: email,
          type: "email"
        }
        $http.post('api/chkAvailability.php',$scope.data)
            .then(function (response) {
              if (response.data.status === "available") {
                document.getElementById('emailavail').style.display = "none";
              }else if (response.data.status === "not available") {
                document.getElementById('emailavail').style.display = "block";
              }
            });
      }
    }

    $scope.addUser = function (user) {

        $scope.user.admin_id = localStorage.getItem("admin_id");

        $http.post('api/addUser.php',$scope.user)
            .then(function (response) {
                toaster.pop(response.data.status,"",response.data.message,3000,'trustedHtml');
                if (response.data.status == "success"){
                    $route.reload();
                }
            });
    }
});
