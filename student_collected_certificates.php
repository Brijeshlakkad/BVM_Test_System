<?php
include_once('functions.php');
include_once("config.php");
include_once('header.php');
check_session();
?>
<div class="container-fluid well">
	<div class="row">
		<div class="row">
			<div class="col-lg-offset-2 col-lg-8 certficate_header" id="<?php echo $login_email; ?>">
			<h3>Collected Certificates <span class="badge" id="certificate_show_total"></span> :</h3>
			</div>
			<div class="col-lg-2">
				<button class="btn btn-primary"  id="certificate_refresh"><span class="glyphicon glyphicon-refresh"></span></button>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-offset-2 col-lg-8 col-lg-offset-2" id="your_certificates">
				<div id="certificate_output">

				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="getTestModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
        <div class="alert alert-danger alert-dismissable fade in"><a href="#" class="close" data-dismiss="modal" aria-label="close">&times;</a> Alert! your previous will be automatically deleted after getting result from next test. </div>
        <button type="button" class="btn btn-default" id="ok_get_test">Get Test!</button>
		</div>
	</div>
 </div>
</div>
<div class="please_wait_modal"></div>
<script src="js/please_wait_modal.js"></script>
<script>
var formid="-99";
function get_test_fun(form_id)
{
	formid=form_id;
	var status=confirm("Alert! your previous will be automatically deleted after getting result from next test.");
	if(status==true)
		$('#ok_get_test').click();
	else{}
}
$("#ok_get_test").click(function(){

	if(formid!="-99")
		{
			$("#"+formid+"").submit();
		}
});
</script>
<script src="js/get_certificates.js"></script>
</body>
</html>
