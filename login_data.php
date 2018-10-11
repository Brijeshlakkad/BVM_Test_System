<?php
include_once("functions.php");
include_once("config.php");
$type=protect_anything($_POST['l_type']);
if($type=="f_")
{
	$table_name="faculty";
	$redirect_page="faculty_panel.php";
	$session_name="Facultyid";
}
else {
	$table_name="students";
	$redirect_page="student_profile.php";
	$session_name="Studentid";
}
$email_field=$type."email";
$password_field=$type."password";
$email=protect_anything($_POST['l_email']);
$password=protect_anything($_POST['l_password']);
$sql="SELECT * FROM $table_name WHERE $email_field='$email' AND $password_field='$password'";
$result=mysqli_query($con,$sql);
$r=mysqli_num_rows($result);
$row=mysqli_fetch_assoc($result);
if($r==1)
{
	$_SESSION[$session_name.""]=$row[$email_field.""];
	echo "11".$redirect_page;
	return;
}
else
{
	echo "0";
	return;
}

?>
