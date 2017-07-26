<?php
require("connect.php");
require("function_library.php");

session_start();
navBar();
$username = $_SESSION['name'];

$runnerArray = getProp('profile','username',$username,$cnn);
$id = $runnerArray['id']; //make runner's id # primary key of the stats table 
echo "<h1>Your Weekly Challenge </h1>";
echo "
";

echo "<form action='' method='post'>
Select your time zone: 
<select name='timezone'>
<option value='America/Los_Angeles'>PT</option>
<option value='America/Denver'>MT</option>
<option value='America/Chicago'>CT</option>
<option value='America/New_York'>ET</option>
</select><br>
Miles Run Today: <input type='text' name='miles'><br>
<input type='submit' value='submit' name='submit'> 
</form>";

	
$submitForm = $_POST['submit'];

//reset week to 0 if it is a new week
if ($submitForm and isset($_POST['miles']) and isset($_POST['timezone'])) //check if value entered for miles input field
	{
	

$date = new DateTime("now",new DateTimeZone($_POST['timezone']));
$dayOfWeek = $date->format('D');
echo $dayOfWeek;

	//echo $date->format('m-d-Y H:i:s');

	$mileage = $_POST['miles'];
	//insert if the row exists, update if the row doesn't exist
	echo $id."<br>".$dayOfWeek."<br>".$mileage."<br>";
	$sql = "INSERT INTO run ($dayOfWeek,run_id) VALUES ($mileage,$id) 
	ON DUPLICATE KEY UPDATE
	$dayOfWeek=$mileage"; 
	
	if (mysqli_query($cnn,$sql))
		{
		echo "the mileage has been added";
		}
	else 
		{
		echo "the mileage couldn't be added";
		}
	}
$dailyMileage = getProp('run','run_id',$id,$cnn);
$weekArray = array('Mon','Tue','Wed','Thu','Fri','Sat','Sun');



//GET AVERAGE MILES RUN. 1) Find day of week 2) loop thru array results 3) perform operation to find avg
/*
echo $totalMiles."<br>";
echo $count."<br>";

echo "<br><br>The average distance run by all users this week is ".$avg;
*/
$findAvg = "SELECT * FROM run";
$result = mysqli_query($cnn,$findAvg);
$avgArray = mysqli_fetch_all($result,MYSQLI_ASSOC);
//$totalMiles=0;
$count=0;
$weekMiles=0;
//$dayIndex = array_search($dayOfWeek,$weekArray)+1;
$a = array();
if ($result){
	foreach($avgArray as $avg)
		{
		$count++;
		foreach($weekArray as $avgWeek)
			{
			$dayMiles=$avg[$avgWeek]; //daily mile count
			//calculate weekly mileage
			
			$weekMiles+=$dayMiles;
			}
			//id is $avg['run_id'] value is $weekMiles
		$a[$avg['run_id']]=$weekMiles;
		//$totalMiles+=$weekMiles;
		$weekMiles=0;//reset $weekMiles
		//create key value pair here to log weekly mile count (below)
		}
}
//$avg = $totalMiles/($dayIndex*$count);
$grantAward = getProp("profile","id",$id,$cnn);
$dailyAvg = 50*$grantAward['weekly_goal']/7;
echo "<div id='chartContainer'>";
	echo "<div class='barchart'>";
	//$lineHeight = 10+100*$avg;
	foreach ($weekArray as $day)
		{barchart($dailyMileage,$day);}
	//echo "<hr/ style='left:$dailyAvg'>";
	echo "</div>";
	echo "<div id='vr' style='border-left: thick solid #ff0000;left:$dailyAvg;'>Daily Goal</div>";
echo "</div>";
$calcTotal = "UPDATE run SET weekly_total=$a[$id] WHERE run_id=$id";
mysqli_query($cnn,$calcTotal);


$addMiles = "UPDATE profile SET miles = {$a[$id]} WHERE id=$id";
mysqli_query($cnn,$addMiles);
if ($a[$id]>=$grantAward['weekly_goal']){echo "<h2>Great job! You've reached your weekly goal!</h2>";}
/*$awardGranted = true;
echo "<br><br><br><br>";
echo $a[$id];
echo $grantAward['weekly_goal'];
if ($a[$id]==0){$awardGranted=true;} //new week new challenge
if (($a[$id]>=$grantAward['weekly_goal']) and $awardGranted)
	{
	echo "award granted";
	$grantAward['award']++;
	$awardGranted = false; //only one award per week 
	}
else {echo "award not granted";}
*/
?>
<link rel='stylesheet' type='text/css' href='runner.css'>