<?php
session_start();
$_SESSION['quesno']=$_GET["id"];
?>
<!DOCTYPE html>
<html>
<head>
<script src="js/jquery.min.js"></script>
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
			
			
			
			
function submission()
	{
		xmlhttp.onreadystatechange = function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){  // ajax module
				var str=xmlhttp.responseText;
				var res=str.split(",");
				var i;
				for(i=0;i<res.length;i=i+1)
				{
					var tab=document.getElementById("qdisp");
					tab.rows[i+1].cells[1].innerHTML=res[i]+"<hr>";
				}

			}
		}
		var str="update.php?u=1";
		xmlhttp.open("GET", str, true);
		xmlhttp.send(null);	
	}
	scoreboard();
	submission();
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

function loadques()
{
	var s= "ques/"+<?php echo $_SESSION['quesno']?>+".txt"	;
		
	$(document).ready(function(){
  	$("#ques").load(s);
});
	
}
			

loadques();


function loadprev()
{
	var q=<?php  echo $_SESSION['quesno']?>;
	if(q!=0)
		{
			q=q-1;
			location.href = "ques.php?id=<?php  echo $_SESSION['quesno']-1?>";
		}
		else
			location.href = "ques.php?id=2";
}

	
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
 <!--block to load question_____________________________________-->


<!--block to load question   ends_____________________________________-->
	</div>
<div id=upload_form>
<form action="upload.php" method="post"
enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file" id="file" class="upload1"><br><br>
<input class="myButton" type="submit" name="submit" value="Submit">
</form>
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