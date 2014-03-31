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
$_SESSION['uname']=$_GET['u'];
$use=$_GET['u'];
$new_string = preg_replace("~[^a-z0-9:]~i", "", $use); 
$use=$new_string;
$pass=$_GET['p'];
$new_string = preg_replace("~[^a-z0-9:]~i", "", $pass);
$pass=$new_string; 
$sql="select * from login where username='".$use."' and pass='".$pass."'";
$result = mysql_query($sql,$conn);
if(mysql_num_rows( $result ) > 0)
{
	echo 1;
}
else
{
	echo 0;
}
?>