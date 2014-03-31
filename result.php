<?php
session_start();
$user_name = "root";
$password = "apple";
$database = "judge";
$server = "127.0.0.1";
$conn=mysql_connect($server, $user_name, $password);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
$db_found = mysql_select_db($database);
$fname=$_SESSION['fname'];
while(1)
{
	$sql="select * from output where fname='".$fname."'";
	$result = mysql_query($sql,$conn);
	if(mysql_num_rows( $result ) > 0)
	{
		
		$row = mysql_fetch_array($result);
		break;
	}
}
$sql="delete from output where fname='".$fname."'";
$result = mysql_query($sql,$conn);
if($row['result']==0)
{
	echo "accepted";
	$sql="update scorecard set score=score+10 where name='".$_SESSION['uname']."'";
	$result = mysql_query($sql,$conn);
}
elseif($row['result']==1)
{
	echo "Time Limit Exceeded";
}
elseif($row['result']==2)
{
	echo "Compilation Error";
}
elseif($row['result']==3)
{
	echo "wrong answer";
}
else
{
	echo "Run-time Error";
}
?>