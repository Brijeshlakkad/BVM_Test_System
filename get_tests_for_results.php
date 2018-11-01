<?php
session_start();
include_once('functions.php');
include_once("config.php");
include_once('header.php');
check_session();
$user_id=$_SESSION['Facultyid'];
?>
<div class="container-fluid well my_well_2" id="show_here">
<div ng-app="myapp" ng-controller="testResultController">
<div class="row" ng-bind-html="show_tests_for_result">

</div>
<div class="modal fade" id="success_modal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        <div class="alert alert-success">{{success_modal_val}}</div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="error_modal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        <div class="alert alert-danger">Please, try again after few minutes</div>
      </div>
    </div>
  </div>
</div>
</div>
</div>

<div class="please_wait_modal"></div>
<script>
$body = $("body");
$(document).on({
      ajaxStart: function() { $body.addClass("loading");    },
       ajaxStop: function() { $body.removeClass("loading"); }
});
var myApp = angular.module("myapp",[]);
myApp.controller("testResultController",function($scope,$http,$timeout,$sce){
  $scope.userid="<?php echo $user_id; ?>";
  $scope.get_test_posted=function(){
    $http({
          method : "POST",
          url : "faculty_interface.py",
          data: "get_test_posted_details="+$scope.userid,
          headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function mySuccess(response) {
          var flag=response.data;
          if(flag==-99)
          {
            $("#error_modal").modal("show");
          }
          else{
            $scope.show_tests_for_result=$sce.trustAsHtml(flag);
          }
        }, function myError(response) {

        });
  };
  $scope.get_test_posted();
});
</script>
<?php include_once("footer.php"); ?>
