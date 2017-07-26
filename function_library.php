<?php
error_reporting(E_ALL);
ini_set("display_errors",1);
require("connect.php");
function navbar(){
	$links = array("Profile"=>"homePage.php","Stats"=>"stat.php","Forum"=>"forumBoard.php","Logout"=>"logout.php");
	$numLinks = count($links);
	$width = 100/$numLinks-3;
	foreach ($links as $link=>$linkKey)
		{
		echo "<div id='navigation' style='display:inline-block;width:$width%'><a href=$linkKey>$link</a></div>";
		}
}

function getProp($table,$field,$property,$cnn){
	$findRow = "SELECT * FROM $table WHERE $field='$property'";
	$res = mysqli_query($cnn,$findRow);
	if ($res)
		{
		$row = mysqli_fetch_array($res,MYSQLI_ASSOC);
		return $row;	
		}
	else {echo "we couldn't find the row that matched $field";}
}

function displayForm($btnText,$msg){
	echo "<form action='' method='post'><input type='submit' value='$btnText' name='displayForm'></form>";
	$displayForm = $_POST['displayForm'];
	if ($displayForm)
		{
			echo "
			<form action='' method='post'>
			$msg
			<br><textarea name='text'></textarea><br>
			<input type='submit' value='Submit' name='submit'>
			</form>
			";
		}
	}
	
function barchart($dailyMileage,$day){
	$colWidth = $dailyMileage[$day]*50;
	echo "<div style='width:".$colWidth."px;height:50px'>$day</div><br>";
	}
/*
echo "<div id='barchart'>
<div style='height:{$dailyMileage['Mon']}px'>Mon</div>
<div style='height:{$dailyMileage['Tue']}px'>Tue</div>
<div style='height:{$dailyMileage['Wed']}px'>Wed</div>
<div style='height:{$dailyMileage['Thu']}px'>Thu</div>
<div style='height:{$dailyMileage['Fri']}px'>Fri</div>
<div style='height:{$dailyMileage['Sat']}px'>Sat</div>
<div style='height:{$dailyMileage['Sun']}px'>Sun</div>
</div>";
*/
?>