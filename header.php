<?php
include_once("functions.php");
include_once("to_show_php_error.php");
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
		<link href="css/custom3.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="css/please_wait.css" />
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/angular.js"></script>
		<script type="text/javascript" src="js/bootstrap-show-password.min.js"></script>
	</head>
	<body>
		<div class="gn_container">
			<ul id="gn-menu" class="gn-menu-main">
				<li class="gn-trigger">
					<a class="gn-icon gn-icon-menu"><span>Menu</span></a>
					<nav class="gn-menu-wrapper">
						<div class="gn-scroller">
							<ul class="gn-menu">
								<li class="gn-search-item">
									<input placeholder="Search" type="search" class="gn-search">
									<a class="gn-icon gn-icon-search"><span>Search</span></a>
								</li>
								<li><a class="gn-icon glyphicon-envelope">Contact us</a></li>
								<li><a class="gn-icon gn-icon-help">Help</a></li>
								<li><a class="gn-icon glyphicon-log-out" href="logout.php">Logout</a></li>
								<li>
									<a class="gn-icon gn-icon-archive">Archives</a>
									<ul class="gn-submenu">
										<li><a class="gn-icon gn-icon-article">A1</a></li>
										<li><a class="gn-icon gn-icon-pictures">A2</a></li>
										<li><a class="gn-icon gn-icon-videos">A3</a></li>
									</ul>
								</li>
							</ul>
						</div>
					</nav>
				</li>
				<li></li>

				<?php
				if(is_student_logged_in())
				{
					?>
					<li class='brij' id='<?php echo $_SESSION['Studentid']; ?>' style="font-size:25px;margin-left:5px;margin-right:15px;border:none;"><span style="color:rgba(8,22,83,0.3)">BVM</span> <b style="color:rgba(8,22,83,1)">Test System</b></li>
					<?php
				}
				else if(is_faculty_logged_in())
				{
					?>
					<li class='brij' id='<?php echo $_SESSION['Facultyid']; ?>' style="font-size:25px;margin-left:5px;margin-right:15px;border:none;"><span style="color:rgba(8,22,83,0.3)">BVM</span> <b style="color:rgba(8,22,83,1)">Test System</b></li>
					<li style="float:right"><a href="faculty_post_test.php">Post a test</a></li>
					<li style="float:right"><a href="view_tests.php">See Tests</a></li>
					<?php
				}
				else if(is_admin_logged_in())
				{?>
					<li class='brij' id='<?php echo $_SESSION['Adminid']; ?>' style="font-size:25px;margin-left:5px;margin-right:15px;border:none;"><span style="color:rgba(8,22,83,0.3)">BVM</span> <b style="color:rgba(8,22,83,1)">Test System</b></li>
					<?php
				}else{
				?>
				<li style="float:right"><a href="login.php">Login</a></li>
				<?php
				}
				?>
			</ul>

		</div>
		<script src="js/get_tests.js"></script>
		<script src="js/classie.js"></script>
		<script src="js/gnmenu.js"></script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
$body = $("body");
$(document).on({
    ajaxStart: function() { $body.addClass("loading");    },
     ajaxStop: function() { $body.removeClass("loading"); }
});
</script>
<div class="please_wait_modal"></div>
