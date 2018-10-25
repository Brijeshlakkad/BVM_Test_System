<?php
include_once("to_show_php_error.php");
include_once("links.php");
?>
<div class="gn_container">
			<ul id="gn-menu" class="gn-menu-main">
				<li class="gn-trigger">
					<a class="gn-icon gn-icon-menu"><span>Menu</span></a>
					<nav class="gn-menu-wrapper">
						<div class="gn-scroller">
							<ul class="gn-menu">
								<li class="gn-search-item">
									<a href="#search" class="gn-icon glyphicon-search">Search</a>
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
<div id="search">
    <button type="button" class="close">×</button>
    <form>
        <input type="search" value="" placeholder="type test name here.." />
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>
