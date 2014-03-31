<?php
session_start();
$user_name = "root";
$password = "apple";
$database = "judge";
$server = "127.0.0.1";
$_SESSION['uname']="avinash";
$conn=mysql_connect($server, $user_name, $password);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
$db_found = mysql_select_db($database);
$sql="select * from queue";
$result = mysql_query($sql,$conn);
$row = mysql_fetch_array($result);
echo $row[3];
?>