<?php
include_once('functions.php');
include_once("config.php");
check_session();

function get_detail_of_test($stu_id,$id)
{
	global $con;
	$sql="Select * from visited_test where student_id='$stu_id' and test_id='$id'";
	$res=mysqli_query($con,$sql);
	if($res)
	{
		$row=mysqli_fetch_array($res);
		return $row['vis_left_time'];
	}
	else
		return "-1";
}
function add_test_to_table($stu_id,$id,$left_dur)
{
	global $con;
	$sql="insert into visited_test(student_id,test_id,vis_left_time) values('$stu_id','$id','$left_dur')";
	$res=mysqli_query($con,$sql);
	if($res)
	{
		return "1";
	}
}
function find_test($stu_id,$id)
{
	global $con;
	$sql="Select * from visited_test where student_id='$stu_id' and test_id='$id'";
	$res=mysqli_query($con,$sql);
	$num=mysqli_num_rows($res);
	if($num==1)
	{
		return "1";
	}
	else
		return "0";
}
function update_duration($stu_id,$id,$dur)
{
	global $con;
	$sql="Update visited_test SET vis_left_time='$dur' where student_id='$stu_id' and test_id='$id'";
	$res=mysqli_query($con,$sql);
	if($res)
	{
		return "1";
	}
	else
		die();
}
if(isset($_POST['c_id']) && isset($_POST['t_id']) && isset($_POST['left_dur']))
{
	$stu_id=$_POST['c_id'];
	$t_id=$_POST['t_id'];
	$left_dur=$_POST['left_dur'];
	update_duration($stu_id,$t_id,$left_dur);
}
?>
