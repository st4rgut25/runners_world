<?php
session_start();
require("connect.php");
require("function_library.php");
navBar();
echo "<h1>Contribute to the Runner's Forum</h1>";
$username = $_SESSION['name'];
if (isset($_GET['q_id']) and isset($_GET['run_id']))
{

$question_id = $_GET['q_id'];
$runner_id = $_GET['run_id'];
$questionRow = getProp('question','question_id',$question_id,$cnn);
$profileRow = getProp('profile','id',$runner_id,$cnn);	
$getAnswers = getProp('answer','question_id',$question_id,$cnn);

echo "<table id='qTable'>
<tr><th><img src={$profileRow['avatar']} style='height:100px;width:100px'></th><th><h1>{$questionRow['question_text']}</h1></th></tr>";

//MAKE ANSWER TABLE
$grabAnswers = "SELECT * FROM answer WHERE question_id=$question_id";
$sql = mysqli_query($cnn,$grabAnswers);
$answerResults = mysqli_fetch_all($sql,MYSQLI_ASSOC);
foreach ($answerResults as $a)
	{
	$avatar = getProp('profile','id',$a['runner_id'],$cnn);
	echo "<tr>
	<td><img class='small_img' src={$avatar['avatar']}></td>
	<td class='questionColor'>{$a['answer_text']}</td>
	</tr>";
	}

echo "</table>";

displayForm("Reply","Help answer this question!");
$addAnswer = $_POST['submit'];
$answer_text = $_POST['text'];
//REPLY to QUESTION
if ($addAnswer)
	{
	echo $username."<br>";
	$replyId = getProp('profile','username',$username,$cnn);
	echo $replyId['id']."<br>";
	echo $answer_text."<br>";
	$sql = "INSERT INTO answer (question_id,answer_text,runner_id) VALUES ('$question_id','$answer_text',{$replyId['id']})";	
	
	if (mysqli_query($cnn,$sql))
		{
		//add one to the reply_count column of question row 
		$sql = "UPDATE question SET reply_count=reply_count+1 WHERE question_id=$question_id";
		if ($cnn->query($sql)===TRUE){echo "replycount incremented";}
		else {echo "reply count not incremented";}
		echo "your answer has been added";
		}
	else {echo "your answer could not be added";}
	}
}
?>
<link rel='stylesheet' type='text/css' href='runner.css'>
