<?php
include_once("config.php");
include_once('header.php');
check_session();
?>
<style>
.style_prevu_kit
{
    border:0;
    position: relative;
    -webkit-transition: all 50ms ease-in;
    -webkit-transform: scale(1);
    -ms-transition: all 50ms ease-in;
    -ms-transform: scale(1);
    -moz-transition: all 50ms ease-in;
    -moz-transform: scale(1);
    transition: all 50ms ease-in;
    transform: scale(1);

}
.style_prevu_kit:hover
{
    box-shadow: 0px 0px 100px #000000;
    z-index: 2;
    -webkit-transition: all 50ms ease-in;
    -webkit-transform: scale(1.01);
    -ms-transition: all 50ms ease-in;
    -ms-transform: scale(1.01);
    -moz-transition: all 50ms ease-in;
    -moz-transform: scale(1.01);
    transition: all 50ms ease-in;
    transform: scale(1.01);
}
</style>

<div ng-controller="BrijController" class="login_block" style="margin-top:80px;">
<div class="container">
<div class="row" id="test_div">
<div id="search">
    <button type="button" class="close">×</button>
    <form>
        <input type="search" value="" placeholder="type test name here.." />
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>
</div>
</div>
</div>
<script>
	var myApp = angular.module("myapp", []);
	myApp.controller("BrijController", function($scope,$http) {
    $scope.f="dd";
	});
</script>
<?php include_once("footer.php"); ?>
