<?php
include_once("functions.php");
check_pages();
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>BVM Test System</title>
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="author" content="Brijesh Lakkad" />
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/gn_demo.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<script src="js/modernizr.custom.js"></script>

		<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="css/custom2.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="css/please_wait.css" />
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/angular.js"></script>
		<script type="text/javascript" src="js/bootstrap-show-password.min.js"></script>
	</head>
	<body>
<div class="container well login_block" align="center">
	<div class="row">
	<div class="gn_container" style="margin-top:45px;"><caption>
			<a href="index.php" style="text-decoration:none;">
		    <h1><span>BVM</span> <b style="color:rgba(8,22,83,1)">Test System</b></h1>
		</a>
	</caption></div>
	</div>
	<div class="row">
		<form ng-app="myapp" ng-controller="BrijController" name="myForm" method="post" novalidate>
		<div class="row" style="padding-top: 20px;"><div class="col-md-offset-4 col-md-4 col-md-offset-4"><div id="l_status"></div></div></div>
		<table class="myTable">
			<div class="form-group">
			<tr>
				<td><label for="l_email">Email:</label></td>
				<td><input type="email" class="form-control" name="l_email" placeholder="Enter Email" ng-model="l_email" ng-style="emailStyle" ng-change="analyze2(l_email)" required /></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<span style="color:red"  id="l_email" ng-show="myForm.l_email.$dirty && myForm.l_email.$invalid"><span ng-show="myForm.l_email.$error.required">Email is required.</span><span ng-show="myForm.l_email.$error.email">Invalid email address.</span></span>
				</td>
				<td></td>
			</tr>
			</div>
			<div class="form-group">
			<tr>
				<td><label for="l_password" >Password:</label></td>
				<td>
					<input type="password" class="form-control" name="l_password" placeholder="Enter Password" ng-model="l_password" ng-style="passStyle" ng-change="analyze(l_password)" id="show_pass" data-toggle="password"  required />
				</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<span style="color:red" id="l_password" ng-show="myForm.l_password.$dirty && myForm.l_password.$invalid">
					<span ng-show="myForm.l_password.$error.required">Password is required.</span>
					</span>
				</td>
				<td></td>
			</tr>
			</div>
			<tr>

				<td><input type="submit" class="btn btn-primary" onclick="return login_status()" ng-disabled="myForm.l_email.$invalid || myForm.l_password.$invalid"></td>
				<td></td>
				<td></td>

			</tr>
			<tr>
				<td>
					<a class="alert-link" href="signup.php" >or create new account?</a>
				</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>
					<a class="alert-link" href="forget_password.php" >Forget Password?</a>
				</td>
				<td></td>
				<td></td>
			</tr>
		</table>
		</form>
	</div>
</div>
<script type="text/javascript">
	$("#show_pass").password('toggle');
</script>
<script>
	var myApp = angular.module("myapp", []);
	myApp.controller("BrijController", function($scope,$http) {

				$scope.emailStyle = {
					"border-width":"1.45px"
                };
                $scope.analyze2 = function(value) {
					var patt2=new RegExp("^[a-z0-9._]+@[a-z]+\.[a-z.]{2,5}$");
                    if(patt2.test(value)) {
						$scope.emailStyle["border-color"] = "green";
                    }
					else {
                        $scope.emailStyle["border-color"] = "red";
                    }
                };

});

function login_status()
	{
		var email =	document.myForm.l_email.value;
		var pass =	document.myForm.l_password.value;
		var l_email=document.getElementById('l_email').innerHTML;
		var l_pass=document.getElementById('l_password').innerHTML;
		if(l_email!="Email is required." && l_email!="Invalid email address." && l_pass!="Password is required.")
			{
				var x=new XMLHttpRequest();
				x.onreadystatechange=function()
				{
					if(x.readyState==4 && x.status==200)
						{
							var data=this.responseText;
							if(data!=0)
							{
								$("#l_status").removeClass("alert alert-danger").addClass("alert alert-success").html("Logging in....");
								document.location="profile.php";
							}
							else
							{
								$("#l_status").removeClass("alert alert-success").addClass("alert alert-danger").html("Email or password is wrong");
							}
						}
				};
				x.open("POST","login_data.php",true);
				x.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				x.send("l_email="+email+"&l_password="+pass);
			}
		else
		{
			document.getElementById('l_status').innerHTML="<p style='color:red;'>please enter details properly</p>"
		}
		return;
	}
</script>
<?php include("footer.php"); ?>
