<?php
session_start(); //store runner ID in session (question table FK) , also the question ID (answer table FK)
require("function_library.php");
navBar();
echo "<h1>Welcome to the Runner's Forum</h1>";
$username = $_SESSION['name'];

$query = "SELECT * FROM question ORDER BY date DESC";
$result = mysqli_query($cnn,$query);
$resultArray = mysqli_fetch_all($result,MYSQLI_ASSOC);

echo "<div id='question'>";
displayForm("Ask Question","Please Type Your Question in the text field below.");
echo "</div>";


//QUESTION BOARD
if ($result)
	{
	echo "<div id='tableDiv'>
	<col width='15'>
	<col width='60%'>
	<col width='10%'>
	<col width='15%'>";
	
	echo "<table id='forum' style='border:1px solid-black'><tr><th colspan='3'>Discussion board</th></tr>
							<tr><th>User</th><th>Question</th><th>Replies</th><th>Date Posted</th></tr>";

	foreach ($resultArray as $q)
		{
		$queryProfile = "SELECT avatar FROM profile WHERE id={$q['runner_id']}";
		$picture = mysqli_query($cnn,$queryProfile);
		$pictureArray = mysqli_fetch_array($picture,MYSQLI_ASSOC);
		echo "<tr>
		<td><a href='homePage.php?id={$q['runner_id']}'><img src={$pictureArray['avatar']}></a></td>
		<td><a href='questionPage.php?q_id={$q['question_id']}&run_id={$q['runner_id']}'>".$q['question_text']."</a></td>
		<td>{$q['reply_count']}</td>
		<td>{$q['date']}</td>
		</tr>";
		}
	echo "</table>";
	echo "</div>";
	}
else {echo "we could not retrieve the questions for the forum board"; }



//ASK QUESTION

/*echo "<form action='' method='post'><input type='submit' value='Ask Question' name='displayForm'></form>";
$displayForm = $_POST['displayForm'];
if ($displayForm)
	{
		echo "
		<form action='' method='post'>
		Question<br><textarea name='question'></textarea><br>
		<input type='submit' value='Submit' name='submit'>
		</form>
		";
	}*/
	
$askQuestion = $_POST['submit'];
$questionField = $_POST['text'];
if ($askQuestion)
	{
		echo $username."<br>";
		$runnersId = getProp('profile','username',$username,$cnn); 
		$id = $runnersId['id']."<br>";
		echo $id;
		echo $questionField."<br>";
		$addQuestion = "INSERT INTO question (question_text,runner_id) VALUES ('$questionField','$id')";
		if (mysqli_query($cnn,$addQuestion)){echo "success, the question data has been added";}
		else {echo "booo, the question data failed to submit";}
	}

?>
<link rel="stylesheet" type="text/css" href="runner.css?<?php echo time(); ?>" />