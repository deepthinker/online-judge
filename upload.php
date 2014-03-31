<?php
session_start();
$user_name = "root";
$password = "apple";
$database = "judge";
$server = "127.0.0.1";
//$_SESSION['uname']="avinash";
$_SESSION['fname']="file";
$conn=mysql_connect($server, $user_name, $password);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
$db_found = mysql_select_db($database);
$var=$_SESSION['quesno'];
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {

    if (file_exists("file/" . $_FILES["file"]["name"]))
      {
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "file/".$var."/" . $_SESSION['uname'].$_FILES["file"]["name"]);
      }
    $fname=$_FILES["file"]["name"];
    $fname=$_SESSION['uname'].$fname;
    $user=$_SESSION['uname'];
    $_SESSION['fname']=$fname;
    $sql="insert into queue(file_n,user_n,ques_no) values('".$fname."','".$user."',".$var.")";
    $result = mysql_query($sql,$conn);
}
?>
<!DOCTYPE html>
<html>
<head>
  <script>
  
  var xmlhttp;
    if (window.XMLHttpRequest)
    {                             
      xmlhttp=new XMLHttpRequest();
    }
    else
    {                             
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
  scoreboard();
  result();
  function result()
  {
    xmlhttp.onreadystatechange = function(){
      if (xmlhttp.readyState==4 && xmlhttp.status==200){  // ajax module
        var str=xmlhttp.responseText;
        document.getElementById("submit").innerHTML=xmlhttp.responseText;
      }
    }
    var str="result.php";
    xmlhttp.open("GET", str, true);
    xmlhttp.send(null); 
  }
  function scoreboard()
  {
    xmlhttp.onreadystatechange = function(){
      if (xmlhttp.readyState==4 && xmlhttp.status==200){  // ajax module
        var str=xmlhttp.responseText;
        var res=str.split(",");
        var i;
        for(i=0;i<res.length;i=i+1)
        {
          var tab1=document.getElementById("scorecard");
          var temp=res[i].split(" ");
          tab1.rows[i+1].cells[0].innerHTML=temp[0]+"<hr>";
          tab1.rows[i+1].cells[1].innerHTML=temp[1]+"<hr>";
        }

      }
    }
    var str="update.php?u=2";
    xmlhttp.open("GET", str, true);
    xmlhttp.send(null); 
  }
  //setInterval(function(){submission()}, 5000);
  setInterval(function(){scoreboard()}, 1000);
  </script>
  <style>
  body
  {
    background: #563c55 url(images/blurred.jpg) no-repeat center top;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    background-size: cover;
  }
  </style>
  <link rel="stylesheet" type="text/css" href="css/home.css" />
</head>
<body>
<div>
<a href="home.php"><input id= "home_button" class="myButton" type="button" value="     Home      "></a>
</div>
<div id="main">
  <div id="ques">
  <div id="submit" style="text-align: center;margin-top:30px;font-size:50px;">
  <img src="images/ani.gif" width="150"  height="150" style="border-radius:75px;">
  </div>
  </div>
  <div id="instr">
  </div>
</div>
<div id="sidebar">
<p>LEADERBOARD</p>
<table id="scorecard" cellspacing=20 style="font-size:30px;" align="center">
<tr>
  <td>NAME</td>
  <td>SCORE</td>
</tr>
<tr>
  <td></td>
  <td></td>
</tr>
<tr>
  <td></td>
  <td></td>
</tr>
<tr>
  <td></td>
  <td></td>
</tr>
<tr>
  <td></td>
  <td></td>
</tr>
<tr>
  <td></td>
  <td></td>
</tr>
<tr>
  <td></td>
  <td></td>
</tr>
</table>
</div>

</body>
</html>
