<?php
session_start();
$_SESSION['quesno']=-1;
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
<div id="main">
	<div id="ques">
		<table id="qdisp" cellspacing=30 align="center">
			<tr>
				<td class="heading" style="width:500px;margin-left:50px;">Problme Name</td>
				<td class="heading" style="width:300px;margin-left:50px;">Submissions</td>
			</tr>
			<tr>
				<td><a href="ques.php?id=1">Question 1</a><hr></td>
				<td></td>
			</tr>
			<tr>
				<td><a href="ques.php?id=2">Question 2</a><hr></td>
				<td></td>
			</tr>
			<tr>
				<td><a href="ques.php?id=3">Question 3</a><hr></td>
				<td></td>
			</tr>
		</table>
	</div>
	<div id="instr">
	<pre id="ques_txt" style="padding-left:30px">
	<h2>Rules and Regulations:</h2>
Please do not discuss strategy, suggestions or tips in the comments during a live contest. 

Discussing problems or any aspect of problem, on any other platform on web, on identification, 
could lead to disabling of respective account and banning from the community.

You will receive ten point for solving a problem (passing all test cases - no partial credit), regardless 
of the level of difficulty of that problem.You can submit solutions as many times as you'd like, there 
are no penalties for incorrect submissions.

Each contest will have one min/max tie breaker problem, where the best solution will receive 
one point and all other solutions will receive a fraction based how close they come to the best solution.

The score that you will see during the contest will only be partial (obtained on 20% of the test data).

The submissions will be re-judged at the end of the contest to get full score (obtained on the whole test data).

The number of submissions that one can make during the contest on the problem will be limited to 500.

All participants are expected to abide by the CodeChef Code Of Conduct

	</pre>
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
