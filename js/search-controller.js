var myApp = angular.module("myapp", []);
myApp.controller("SearchController", function($rootScope,$scope,$http,$sce,$window) {
  $scope.student_id="<?php echo $_SESSION['Studentid']; ?>";
  $scope.update_filter_test = function(value){
    $http({
          method : "POST",
          url : "student_interface.py",
          data: "test_name="+value+"&student_id="+$scope.student_id,
          headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function mySuccess(response) {
          var flag=response.data;
          flag=flag.trim();
          //alert(flag);
          if(flag.startsWith("11"))
          {
            $rootScope.student_div=$sce.trustAsHtml(flag.substr(2));
          }
          else{
            $rootScope.student_div="Please try again!";
          }
        }, function myError(response) {

        });
  };
});
