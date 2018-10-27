<?php
session_start();
function protect_anything($str)
{
	$str = addslashes($str);
	$str = stripslashes($str);
	return $str;
}
function check_session()
{
	if((!isset($_SESSION['Studentid'])) && (!isset($_SESSION['Adminid'])) && (!isset($_SESSION['Facultyid'])))
	{
		header("Location:index.php");
	}
}
function is_student_logged_in()
{
	if(isset($_SESSION['Studentid']))
	{
		return true;
	}
	else
	{
		return false;
	}
}
function is_faculty_logged_in()
{
	if(isset($_SESSION['Facultyid']))
	{
		return true;
	}
	else
	{
		return false;
	}
}
function is_admin_logged_in()
{
	if(isset($_SESSION['Adminid']))
	{
		return true;
	}
	else
	{
		return false;
	}
}
function check_pages()
{
	/*$filename=basename($_SERVER['PHP_SELF']);
	if($filename=="index.php" || $filename=="login.php" || $filename=="signup.php")
	{
		if(isset($_SESSION['Studentid']) || isset($_SESSION['Adminid']) || isset($_SESSION['Facultyid']))
		{
			session_destroy();
			header("location:$filename");
		}
	}
	if(isset($_SESSION['Studentid']))
	{
		if($filename=="student_profile.php" || $filename=="contact.php")
		{
			return;
		}
		else{
			session_destroy();
			header("location:unreachable.php");
		}
	}
	if(isset($_SESSION['Facultyid']))
	{
		if($filename=="faculty_panel.php" || $filename=="contact.php" || $filename=="faculty_post_test.php" || $filename=="view_tests.php" || $filename=="edit_test.php" || $filename=="edit_question.php")
		{
			return;
		}
		else{
			session_destroy();
			header("location:unreachable.php");
		}
	}
	if(isset($_SESSION['Adminid']))
	{
		if($filename=="admin_panel.php" || $filename=="admin_post_test.php")
		{
			return;
		}
		else {
			session_destroy();
			header("location:unreachable.php");
		}
	}*/
}
?>
