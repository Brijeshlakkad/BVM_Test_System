<?php
include_once("config.php");
include_once('header.php');
check_session();
?>
<div class="container" ng-controller="SearchController">
<div class="row" id="student_div" ng-bind-html="student_div" >

</div>
</div>
<div class="please_wait_modal"></div>
<script src="js/please_wait_modal.js"></script>
<script src="js/search-controller.js"></script>
<?php include_once("footer.php"); ?>
