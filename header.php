<?php include("functions.php"); ?>
<?php check_pages(); ?>
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
				<li></li>
				<li style="float:right"><a href="login.php">Login</a></li>
			</ul>
		</div>
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
