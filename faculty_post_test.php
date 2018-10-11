<?php
session_start();
include_once('functions.php');
include_once("config.php");
include_once('header.php');
check_session();
$user_id=$_SESSION['Facultyid'];
?>
<style>
input.ng-touched.ng-invalid {
	border-width: 1.45px;
    border-color: red;
}
input.ng-touched.ng-valid {
    border-width: 1.45px;
    border-color: green;
}
</style>
<div class="container-fluid well my_well_2" id="show_here">
<div ng-app="myapp" ng-controller="BrijController">
<div class="row" align="center" id="entry_panel" ng-show="entry_panel">
<div class="col-lg-offset-2 col-lg-8 col-lg-offset-2">
	<label><h3>Add a Test</h3></label>
	<form name="TestForm" method="post" class="brij" novalidate>
	<table class="myTable">
	<div class="form-group">
		<tr>
			<td><label for="t_title">Enter Title</label></td>
			<td><input type="text" class="form-control" ng-model="t_title" name="t_title" id="t_title" ng-style="onlyChar" ng-change="analyze1(t_title)" required title-dir/></td>
			<td>
				<span style="color:red" id="s_t_title" ng-show="TestForm.t_title.$dirty && TestForm.t_title.$invalid">
				<span ng-show="TestForm.t_title.$error.required">Title is required.</span>
				<span ng-show="!TestForm.t_title.$error.required && TestForm.t_title.$error.titlelengthvalid">Enter minimum 4 characters.</span>
				<span ng-show="!TestForm.t_title.$error.required && TestForm.t_title.$error.onlycharvalid">Only alphabets and numbers are allowed.</span>
				</span>
			</td>
		</tr>
	</div>
	<div class="form-group">
		<tr>
			<td><label for="t_course">Enter Course</label></td>
			<td><select class="form-control" name="t_course" id="t_course" ng-model="t_course" required>
				<option
				ng-repeat="x in t_courseOptions"
				ng-value="x.val">{{x.name_c}}</option>
				</select>
			</td>
			<td>
				<span style="color:red" id="s_t_course" ng-show="TestForm.t_course.$dirty && TestForm.t_course.$invalid">
				<span ng-show="TestForm.t_course.$error.required">Course is required</span>
				</span>
			</td>
		</tr>
	</div>
	<div class="form-group">
		<tr>
			<td><label for="t_subjects">Enter Subjects</label></td>
			<td><input type="text" class="form-control" ng-model="t_subjects" name="t_subjects" id="t_subjects" ng-style="subjectStyle" ng-change="analyze2(t_subjects)" required/></td>
			<td>
				<a class="badge my_badge" data-toggle="tooltip" data-placement="top" title="Enter subject names seperated by | character">?</a>
				<span style="color:red" id="s_t_subjects" ng-show="TestForm.t_subjects.$dirty && TestForm.t_subjects.$invalid">
				<span ng-show="TestForm.t_subjects.$error.required">At least one subject is required</span>
				</span>
			</td>
		</tr>
	</div>
	<div class="form-group">
		<tr>
			<td><label for="t_time">Enter Duration</label></td>
			<td><input type="text" class="form-control" ng-model="t_time_1" name="t_time_1" id="t_time_1" ng-style="numStyle" ng-change="analyze3(t_time_1)" width="50" required time-dir/>hours : <input type="text" class="form-control" ng-model="t_time_2" name="t_time_2" id="t_time_2" ng-style="numStyle" ng-change="analyze3(t_time_2)" width="50" required time-dir/>minutes : <input type="text" class="form-control" ng-model="t_time_3" name="t_time_3" id="t_time_3" ng-style="numStyle" ng-change="analyze3(t_time_3)" width="50" required time-dir/>seconds</td>
			<td>
				<span style="color:red" id="s_t_time" ng-show="(TestForm.t_time_1.$dirty && TestForm.t_time_1.$invalid) || (TestForm.t_time_2.$dirty && TestForm.t_time_2.$invalid) || (TestForm.t_time_3.$dirty && TestForm.t_time_3.$invalid)">
				<span ng-show="TestForm.t_time_1.$error.required || TestForm.t_time_2.$error.required || TestForm.t_time_3.$error.required">Time is required</span>
				<!--<span ng-show="!(TestForm.t_time_1.$error.required || TestForm.t_time_2.$error.required || TestForm.t_time_3.$error.required) && (TestForm.t_title_1.$error.onlynumvalid || TestForm.t_title_2.$error.onlynumvalid || TestForm.t_title_3.$error.onlynumvalid)">Only alphabets and numbers are allowed.</span>-->
				</span>
			</td>
		</tr>
	</div>
		<tr>
			<td><input type="submit" ng-click="submit_test_func(set_test_id)" id="submit_btn" value="Submit" class="btn btn-primary" ng-disabled="TestForm.t_title.$invalid ||  TestForm.t_course.$invalid ||  TestForm.t_subjects.$invalid || TestForm.t_time_1.$invalid || TestForm.t_time_2.$invalid || TestForm.t_time_3.$invalid" /></td>
			<td></td>
			<td></td>
		</tr>

	</table>
	</form>
	</div>
</div>
<div class="row" id="questions_panel" ng-show="questions_panel">
<div class="col-lg-offset-2 col-lg-8 col-lg-offset-2">
	<form name="QueForm" method="post" id="QueForm" novalidate>
	<table class="myTable">
			<div class="form-group">
			<tr>
				<td><label for="question">Question?</label></td>
				<td>
				<textarea class="form-control" ng-model="que" name="que" id="que" ng-style="queStyle" ng-change="que_analyze(que)" cols="300" rows="2" required placeholder="Enter a question" ></textarea></td>
				<td>
					<span style="color:red" id="s_que" ng-show="QueForm.que.$dirty && QueForm.que.$invalid">
					<span ng-show="QueForm.que.$error.required">Question is required</span>
					</span>
				</td>
			</tr>
			</div>
			<div class="form-group">
			<tr>
				<td><label for="mcq1">MCQ 1</label></td>
				<td>
				<input class="form-control" ng-model="mcq1" name="mcq1" id="mcq1" ng-style="mcq1Style" ng-change="mcq1_analyze(mcq1)" required placeholder="Enter mcq1" /></td>
				<td>
					<span style="color:red" id="s_mcq1" ng-show="QueForm.mcq1.$dirty && QueForm.mcq1.$invalid">
					<span ng-show="QueForm.mcq1.$error.required">mcq1 is required</span>
					</span>
				</td>
			</tr>
			</div>
			<div class="form-group">
			<tr>
				<td><label for="mcq2">MCQ 2</label></td>
				<td>
				<input class="form-control" ng-model="mcq2" name="mcq2" id="mcq2" ng-style="mcq2Style" ng-change="mcq2_analyze(mcq2)" required placeholder="Enter mcq2" /></td>
				<td>
					<span style="color:red" id="s_mcq2" ng-show="QueForm.mcq2.$dirty && QueForm.mcq2.$invalid">
					<span ng-show="QueForm.mcq2.$error.required">mcq2 is required</span>
					</span>
				</td>
			</tr>
			</div>
			<div class="form-group">
			<tr>
				<td><label for="mcq3">MCQ 3</label></td>
				<td>
				<input class="form-control" ng-model="mcq3" name="mcq3" id="mcq3" ng-style="mcq3Style" ng-change="mcq3_analyze(mcq3)" required placeholder="Enter mcq3" /></td>
				<td>
					<span style="color:red" id="s_mcq3" ng-show="QueForm.mcq3.$dirty && QueForm.mcq3.$invalid">
					<span ng-show="QueForm.mcq3.$error.required">mcq3 is required</span>
					</span>
				</td>
			</tr>
			</div>
			<div class="form-group">
			<tr>
				<td><label for="mcq4">MCQ 4</label></td>
				<td>
				<input class="form-control" ng-model="mcq4" name="mcq4" id="mcq4" ng-style="mcq4Style" ng-change="mcq4_analyze(mcq4)" required placeholder="Enter mcq4" /></td>
				<td>
					<span style="color:red" id="s_mcq4" ng-show="QueForm.mcq4.$dirty && QueForm.mcq4.$invalid">
					<span ng-show="QueForm.mcq4.$error.required">mcq2 is required</span>
					</span>
				</td>
			</tr>
			</div>
			<div class="form-group">
			<tr>
				<td><label for="ans">Answer</label></td>
				<td>
				<select class="form-control" ng-model="ans" name="ans" id="ans" required>
				<option
				ng-repeat="x in ansOptions"
				ng-value="x.val">{{x.name_c}}</option>
				</select></td>
				<td>
					<span style="color:red" id="s_ans" ng-show="QueForm.ans.$dirty && QueForm.ans.$invalid">
					<span ng-show="QueForm.ans.$error.required">answer is required</span>
					</span>
				</td>
			</tr>
			</div>
			<tr>
			<td></td>
			<td><input type="submit" ng-click="add_next()" id="add_next" value="Add another question" class="btn btn-primary" ng-disabled="QueForm.que.$invalid ||  QueForm.mcq1.$invalid ||  QueForm.mcq2.$invalid ||  QueForm.mcq3.$invalid ||  QueForm.mcq4.$invalid ||  QueForm.ans.$invalid" /></td>
			<td></td>
			</tr>
	</table>
	</form>
</div>
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
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
});
	var myApp = angular.module("myapp",[]);
	myApp.controller("BrijController",function($scope,$http,$timeout){
		$scope.entry_panel = true;
		$scope.questions_panel = false;
		$scope.t_time_1="00";
		$scope.t_time_2="00";
		$scope.t_time_3="00";
		$scope.user_id="<?php echo $user_id; ?>";
		$scope.t_courseOptions=[
		{val : "Information Technology",name_c:"Information Technology"},
		{val : "Computer Science", name_c : "Computer Science"},
		{val : "Mechanical Engineering", name_c : "Mechanical Engineering"},
		{val : "Civil Engineering", name_c : "Civil Engineering"}
		];
		$scope.ansOptions=[
		{val : "1",name_c:"MCQ1"},
		{val : "2", name_c : "MCQ2"},
		{val : "3", name_c : "MCQ3"},
		{val : "4", name_c : "MCQ4"}
		];
		var patt;
		$scope.onlyChar = {
			"border-width":"1.45px"
		};
		$scope.analyze1 = function(value) {
			if(/^[0-9a-zA-Z ]+$/.test(value) && value.length>3) {
				$scope.onlyChar["border-color"] = "green";
			}else {
				$scope.onlyChar["border-color"] = "red";
			}
		};
		$scope.queStyle = {
			"border-width":"1.45px"
		};
		$scope.que_analyze = function(value) {
			if(value.length===0 || typeof $scope.que === 'undefined') {
				$scope.queStyle["border-color"] = "red";
			}else {
				$scope.queStyle["border-color"] = "green";
			}
		};
		$scope.numStyle = {
			"border-width":"1.45px"
		};
		$scope.analyze3 = function(value) {
			if(/^[0-9]+$/.test(value) && value<=60) {
				$scope.numStyle["border-color"] = "green";
			}else {
				$scope.numStyle["border-color"] = "red";
			}
		};
		$scope.set_test_id=function(val){
			$scope.test_id= val;
		};
		$scope.submit_test_func=function(callback)
		{
			var time1=parseInt($scope.t_time_1);
			var time2=parseInt($scope.t_time_2);
			var time3=parseInt($scope.t_time_3);
			$scope.time=time1*3600+time2*60+time3;
			$scope.test_status="";
			if($scope.time==0)
				{
					$scope.test_status="<span style='color:red;'>Please enter duration time for test.</span>";
				}
			else{
				$http({
					method : "POST",
					url : "submit_test_and_questions.py",
					data: "add_title="+$scope.t_title+"&parid="+$scope.user_id+"&course="+$scope.t_course+"&subjects="+$scope.t_subjects+"&time="+$scope.time,
					headers: {'Content-Type': 'application/x-www-form-urlencoded'}
				}).then(function mySuccess(response) {
					var flag = response.data;
					if(flag!=-1)
					{
						callback(flag);
						$scope.test_status="";
						$timeout(function() {
							$scope.entry_panel = false;
						}, 1000);
						$timeout(function() {
							$scope.questions_panel= true;
						}, 1000);
					}
					else
					{
						$("#error_modal").modal("show");
					}
				}, function myError(response) {

				});
			}
		};
		$scope.add_next=function(){
			$http({
				method : "POST",
				url : "submit_test_and_questions.py",
				data: 'testid='+$scope.test_id+'&add_que='+$scope.que+'&mcq1='+$scope.mcq1+'&mcq2='+$scope.mcq2+'&mcq3='+$scope.mcq3+'&mcq4='+$scope.mcq4+'&ans='+$scope.ans,
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			}).then(function mySuccess(response) {
				flag = response.data;
				if(flag==1)
				{
					$scope.que_status="";
					$scope.entry_panel = false;
					$timeout(function() {
						$scope.questions_panel= true;
					}, 1000);
					$scope.que="";
					$scope.mcq1="";
					$scope.mcq2="";
					$scope.mcq3="";
					$scope.mcq4="";
					$scope.ans="";
					$scope.QueForm.$setUntouched();
					$scope.QueForm.$setPristine();
					$scope.success_modal_val="Question added";
					$("#success_modal").modal("show");
				}
				else
				{
					$("#error_modal").modal("show");
				}
			}, function myError(response) {

			});
		};

	});
myApp.directive("titleDir",function(){
	return {
		require: 'ngModel',
		link: function(scope, element, attr, mCtrl) {
			function myValidation(value)
			{
				var patt = new RegExp("^[0-9a-zA-Z ]+$");
				if(patt.test(value)) {
					mCtrl.$setValidity('onlycharvalid', true);
				}
				else {
					mCtrl.$setValidity('onlycharvalid', false);
				}
				if(value.length>3) {
					mCtrl.$setValidity('titlelengthvalid', true);
				}
				else {
					mCtrl.$setValidity('titlelengthvalid', false);
				}
				return value;
			}
			mCtrl.$parsers.push(myValidation);
		}
	};
});
myApp.directive("timeDir",function(){
	return {
		require: 'ngModel',
		link: function(scope, element, attr, mCtrl) {
			function myValidation(value)
			{
				var patt = new RegExp("^[0-9]+$");
				if(patt.test(value) && value<=60) {
					mCtrl.$setValidity('onlynumvalid', true);
				}else {
					mCtrl.$setValidity('onlynumvalid', false);
				}
				return value;
			}
			mCtrl.$parsers.push(myValidation);
		}
	};
});
</script>
</body>
</html>
