<?php 
session_start(); 
require("connect.php");
require("function_library.php");
//$img = $_SESSION['imageURL'];
$property =  $_SESSION['name']; //this variable shows up for newuser but not returnuser

navbar();
if (isset($_GET['id'])) //check if id points to another user's profile
	{
	$findId = $_GET['id'];
	$getProfile = getProp('profile','id',$findId,$cnn);
	$property = $getProfile['username'];
	}
else {
	$getProfile = getProp('profile','username',$property,$cnn);
}
if ($getProfile)
	{
	echo "<h1>WELCOME TO $property's PAGE</h1>
	<div id='picture'>
	<img src={$getProfile['avatar']} class='avatar'>
	</div>
	<table id='profile'>
	<tr><td>Weekly Goal:</td><td>{$getProfile['weekly_goal']}</td></tr>
	<tr><td>Miles Ran</td><td>{$getProfile['miles']}</td></tr>
	<tr><td>About Me:</td><td>{$getProfile['about_me']}</td></tr>
	<tr><td>Location: </td><td>{$getProfile['location']}</td></tr>
	</table>
	";
}
else {echo "we could not retrieve your profile data";}

?>
<link rel="stylesheet" type="text/css" href="runner.css">