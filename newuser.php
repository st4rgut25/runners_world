<?php
require("connect.php");
session_start();
$query = "SELECT * FROM `profile`";

if ($query_run=mysqli_query($cnn,$query))
{
	echo "
	<h1>Sign up for Runners World</h1>
	<form action='' method='post'>
	Username: <input type='text' name='username'><br> 
	Email: <input type='text' name='email'><br>
	Password: <input type='text' name='pw'><br>
	<input type='submit' name='submit' value='submit'>
	</form>
	";
}
else {
die("<br>could not connect to table");
}

?>
<?php
$seeme = 'yes';
if (isset($_POST['submit']))//if you submitted the form
{

$username = mysqli_real_escape_string($cnn,$_POST['username']);
$password = mysqli_real_escape_string($cnn,$_POST['pw']);
$email = mysqli_real_escape_string($cnn,$_POST['email']);

if ($username and $password and $email)
	{
	if (!filter_var($email,FILTER_VALIDATE_EMAIL)){echo "please enter a valid email";}
	//check for existing username
	else{
		$checkNames = "SELECT * FROM profile WHERE username='$username'";
		$userdoops = mysqli_query($cnn,$checkNames);
		$getRows = mysqli_affected_rows($cnn);
		if ($getRows==0)
			{
			$addLogin = "INSERT INTO profile (username,email,password) VALUES ('$username','$email','$password')";
			$success = $cnn->query($addLogin);
			if ($success)
				{
					$_SESSION['name']="$username";
					echo("<script>location.href = 'profilePage.php';</script>");
				}
				else 
				{
					die("login data failed to reach database");
				}
		}
		else {echo "that username has been taken already";}
	}
	}
else {echo "please fill out all the fields";}	
}
else {
$submit=null;
echo 'no form submitted';
}


?>