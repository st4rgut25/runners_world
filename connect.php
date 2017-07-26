<?php

error_reporting(E_ALL);
ini_set("display_errors",1);

$servername = "localhost";
$password = "";
$user = "root";

$cnn = mysqli_connect($servername,$user,$password);

if ($cnn)
	{
	//echo "mysql connection successful";
	$db = mysqli_select_db($cnn, "runners");
		if ($db){/*echo "<br>connection to database successful";*/}
		else {die("<br>connect to database failed");}
	}
else
	{die("connection to mysql unsuccessful");}
?>