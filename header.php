<?php
include_once("to_show_php_error.php");
include_once("links.php");
?>
<div class="container-fluid">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
								<?php
								if(is_student_logged_in())
								{
									?>
									<a class='brij navbar-brand' id='<?php echo $_SESSION['Studentid']; ?>' style="font-size:25px;"><span style="color:rgba(8,22,83,0.3)">BVM</span> <b style="color:rgba(8,22,83,1)">Test System</b></a>
									<?php
								}
								else if(is_faculty_logged_in())
								{
								  ?>
								  <a class='brij navbar-brand' id='<?php echo $_SESSION['Facultyid']; ?>' style="font-size:25px;"><span style="color:rgba(8,22,83,0.3)">BVM</span> <b style="color:rgba(8,22,83,1)">Test System</b></a>
								  <?php
								}
								else if(is_admin_logged_in())
								{?>
								  <a class='brij navbar-brand' id='<?php echo $_SESSION['Adminid']; ?>' style="font-size:25px;"><span style="color:rgba(8,22,83,0.3)">BVM</span> <b style="color:rgba(8,22,83,1)">Test System</b></a>
								  <?php
								}else{
								?>
									<a class='brij navbar-brand' id='<?php echo $_SESSION['Adminid']; ?>' style="font-size:25px;"><span style="color:rgba(8,22,83,0.3)">BVM</span> <b style="color:rgba(8,22,83,1)">Test System</b></a>
								<?php
								}
								?>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
								<?php
								if(is_student_logged_in())
								{
									?>
									<ul class="nav navbar-nav">
	                    <li><a href="student_profile.php">Profile</a></li>
                      <li><a href="student_collected_certificates.php">Certificates</a></li>
	                    <li class="dropdown">
	                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings <b class="caret"></b></a>
	                        <ul class="dropdown-menu">
	                            <li><a href="logout.php">Logout</a></li>
	                        </ul>
	                    </li>
	                </ul>
									<ul class="nav navbar-nav navbar-right">
	                    <li><a href="#search">Search</a></li>
	                </ul>
									<?php
								}
								else if(is_faculty_logged_in())
								{
									?>
									<ul class="nav navbar-nav">
	                    <li><a href="#">XYZ</a></li>
	                    <li class="dropdown">
	                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings <b class="caret"></b></a>
	                        <ul class="dropdown-menu">
	                            <li><a href="logout.php">Logout</a></li>
	                        </ul>
	                    </li>
	                </ul>
									<a style="float:right"><a href="faculty_post_test.php">Post a test</a></a>
								  <a style="float:right"><a href="view_tests.php">See Tests</a></a>
									<?php
								}
								else if(is_admin_logged_in())
								{
								}else{
									?>
									<ul class="nav navbar-nav">
	                    <li><a href="#">XYZ</a></li>
	                </ul>
									<ul class="nav navbar-nav navbar-right">
	                    <li><a href="login.php">Login</a></li>
	                </ul>
									<?php
								}
								?>

            </div>
        </div>
    </nav>
</div>
		<script>
			$body = $("body");
			$(document).on({
			    ajaxStart: function() { $body.addClass("loading");    },
			     ajaxStop: function() { $body.removeClass("loading"); }
			});
</script>
<div class="please_wait_modal"></div>
