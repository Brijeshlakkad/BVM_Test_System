<?php
include_once('functions.php');
include_once("config.php");
include_once('header.php');
check_session();
if(isset($_POST['test_id']))
{
	$testid=protect_anything($_POST['test_id']);
	$sql_test="select test_title from tests where test_id='$testid'";
	$result_test=mysqli_query($con,$sql_test);
	if(!$result_test)
		die();
	$row_test=mysqli_fetch_array($result_test);
	$title=$row_test[0];
	$sql="select result_right,result_attended,result_total,result_left_time,result_total_time from results where test_id='$testid'";
	$result=mysqli_query($con,$sql);
	if($result)
	{
		$row=mysqli_fetch_array($result);
		$right=$row[0];
		$attended=$row[1];
		$total=$row[2];
		$left_dur=$row[3];
		$total_dur=$row[4];
		$duration=intval($total_dur)-intval($left_dur);
		$wrong=$total-$right;
		$remained_que=$total-$attended;
		$right=$row[0];

?>
<div class="container-fluid well" ng-controller="BrijController">
	<div class="row">
		<div id="caption" class="row"><div class="col-lg-offset-2 col-lg-8 col-lg-offset-2"><h3><strong>Test : </strong><?php echo $title; ?></h3><small><b>(by {{student_fname}} {{student_lname}})</b></small></div></div>
		<div id="show_result" class="row">
		<div class="col-lg-offset-2 col-lg-8 col-lg-offset-2">
			<table class="table">
				<tr>
					<th class="success">Right</th>
					<th class="danger">Wrong</th>
					<th class="info">Attained</th>
					<th class="warning">Remained</th>
					<th class="active">Total Questions</th>
				</tr>
				<tr>
					<td class="success"><?php echo $right; ?></td>
					<td class="danger"><?php echo $wrong; ?></td>
					<td class="info"><?php echo $remained_que; ?></td>
					<td class="warning"><?php echo $attended; ?></td>
					<td class="active"><?php echo $total; ?></td>
				</tr>
			</table>
			<div style="background-color: black;color: white;font-size: 15px;">Solved in  <?php echo $duration." seconds"; ?></div>
			</div>
		</div>
	</div>
</div>
<script>
var myApp = angular.module("myapp", []);
myApp.controller("BrijController", function($scope,$http) {
		$scope.userid="<?php echo $_SESSION['Studentid']; ?>";
		$scope.get_acc_details=function(f,user,callback)
		{
			$http({
				method : "POST",
				url : "student_interface.py",
				data: "get_student_any_value_by_id="+f+"&userid="+$scope.userid,
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			}).then(function mySuccess(response) {
				callback(response.data);
			}, function myError(response) {
			});

		};
		var set_val_student_fname=function(val){
			$scope.student_fname= val;
		};
		$scope.get_acc_details("student_fname",$scope.userid,set_val_student_fname);
		var set_val_student_lname=function(val){
			$scope.student_lname= val;
		};
		$scope.get_acc_details("student_lname",$scope.userid,set_val_student_lname);
});
</script>
<?php
		}
}
include_once("footer.php");
?>
