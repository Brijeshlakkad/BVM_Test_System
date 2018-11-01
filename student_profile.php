<?php
include_once("config.php");
include_once('header.php');
check_session();
?>
<div class="container" ng-app="myapp" ng-controller="SearchController">
  <div ng-controller="SearchController" class="login_block" style="margin-top:80px;">
    <div id="search">
        <button type="button" class="close">×</button>
        <form>
            <input type="search" placeholder="type test name here.." autocomplete="off" name="entered_test_name" ng-model="entered_test_name" id="entered_test_name" />
            <button type="submit" class="btn btn-primary" id="search_submit" ng-click="update_filter_test(entered_test_name)">Search</button>
        </form>
    </div>
  </div>
<div class="row" id="student_div" ng-bind-html="student_div" >

</div>
</div>
<div class="please_wait_modal"></div>
<script src="js/please_wait_modal.js"></script>
<script src="js/search-controller.js"></script>
<?php include_once("footer.php"); ?>
