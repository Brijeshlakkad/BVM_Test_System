<?php
include_once("config.php");
include_once('header.php');
check_session();
?>


<div ng-controller="BrijController" class="login_block" style="margin-top:80px;">
  <div id="search">
      <button type="button" class="close">×</button>
      <form>
          <input type="search" placeholder="type test name here.." name="entered_test_name" ng-model="entered_test_name" id="entered_test_name" />
          <button type="submit" class="btn btn-primary" id="search_submit" ng-click="update_filter_test(entered_test_name)">Search</button>
      </form>
  </div>
<div class="container">
<div class="row" id="student_div" ng-bind-html="student_div" >

</div>
</div>
</div>
<script>
	var myApp = angular.module("myapp", []);
	myApp.controller("BrijController", function($scope,$http,$sce) {
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
            if(flag.startsWith("11"))
            {
              $scope.student_div=$sce.trustAsHtml(flag.substr(2));
            }
            else{
              $scope.student_div="Please try again!";
            }
          }, function myError(response) {

          });
		};
	});
</script>
<?php include_once("footer.php"); ?>
