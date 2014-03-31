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
$use=$_GET['u'];
if($use==1)
{
	$sql="select subm from questions";
	$result = mysql_query($sql,$conn);
	while($row = mysql_fetch_array($result)){
      echo $row['subm'].",";
 }
}
else
{
 	$sql="select name , score from scorecard order by score desc limit 6";
 	$result = mysql_query($sql,$conn);
	while($row = mysql_fetch_array($result)){
      echo $row['name']." ".$row['score'].",";
 }

}
?>