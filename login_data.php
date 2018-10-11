<?php
include_once("functions.php");
include_once("config.php");
$type=protect_anything($_POST['l_type']);
if($type=="f_")
{
	$table_name="faculty";
}
else {
	$table_name="students";
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
	$_SESSION['Userid']=$row['student_email'];
	echo "1";
	return;
}
else
{
	echo "0";
	return;
}

?>
