<?php
require_once('functions.php');
require_once('header.php');
check_session();
?>
<div class="container my_well_1" id="show_here">
<center>
	<h2>
		Welcome to Faculty Panel
	</h2>
</center>
</div>
<div class="please_wait_modal"></div>
<script>
$body = $("body");
$(document).on({
    ajaxStart: function() { $body.addClass("loading");    },
     ajaxStop: function() { $body.removeClass("loading"); }
});
</script>
<?php include("footer.php"); ?>
