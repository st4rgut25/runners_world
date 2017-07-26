<?php
session_start();
require('connect.php');
echo "
<a href='adPage.php'>Back</a>
<h1>Welcome back! </h1><form action='' method='post'>
Username: <input type='text' name='username'>
Password: <input type='password' name='password'>
<input type='submit' value='submit' name='submit'>
</form>";

$username = mysqli_real_escape_string($cnn,$_POST['username']);
$password = mysqli_real_escape_string($cnn,$_POST['password']);
$submit = $_POST['submit'];
if ($submit)
	{
	$match = "SELECT * FROM profile WHERE username='$username' and password='$password'";
	if ($query = mysqli_query($cnn,$match))
		{
		$_SESSION['name']="$username";
		echo ("<script>location.href='homePage.php';</script>");
		}
	else 
		{
		echo "oops you entered a wrong username or password";
		}
	}

?>