<?php
include_once("functions.php");
include_once("config.php");
$email=protect_anything($_POST['l_email']);
$password=protect_anything($_POST['l_password']);
$sql="SELECT * FROM students WHERE student_email='$email' AND student_password='$password'";
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
