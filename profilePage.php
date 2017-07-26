<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors",1);
require("connect.php");
$name = $_SESSION['name'];
echo "<h1>Welcome $name</h1>";

echo "<form action='' method='post'>
Avatar: <input type='text' name='avatar'><br>
Location: <input type='text' name='location'><br>
Descripiton: <textarea type='text' name='about' style='vertical-align:top'></textarea><br>
Weekly Goal: <input type='text' name='goal'><br>
<input type='submit' value='submit' name='submit'>
</form>
";

$avatar = mysqli_real_escape_string($cnn,$_POST['avatar']);
$location = mysqli_real_escape_string($cnn,$_POST['location']);
$goal = mysqli_real_escape_string($cnn,$_POST['goal']);
$about = mysqli_real_escape_string($cnn,$_POST['about']);


if (isset($_POST['submit']))
{
	if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$avatar)) {echo "please enter a valid URL";}
	else 
	{
		$sql = "UPDATE profile 
		SET avatar='$avatar',location='$location',about_me='$about',weekly_goal='$goal'
		WHERE username='$name'"; //$goal only accepts integer value
		if ($cnn->query($sql)===TRUE)
			{
			echo("<script>location.href='homePage.php';</script>");
		}
		else 
		{echo "oops you could not submit your profile";}
	}
}
?>