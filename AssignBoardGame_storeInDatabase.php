<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "aHancockDB6";

// Adding Board game Assignment to table/database

if($_POST['formSubmit'] == "Submit")
{
	$assignmentID = test_input($_POST['assignmentID']);
	$gameID = test_input($_POST['gameID']);	
	$playerID = test_input($_POST['playerID']);	
}

//This is here for security. It is important to strip the text to avoid security exploits
function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 

// This attempts to validate assignmentID number
$result = $conn->query("SELECT assignmentID FROM BoardGamesAssignment WHERE assignmentID = '$assignmentID'");
if($result->num_rows > 0) {
	echo "Assignment ID ALREADY IN USE <br> Please pick another one";
} else 
{
	$sql = "INSERT INTO BoardGamesAssignment (assignmentID, gameID, playerID)
	VALUES ('$assignmentID', '$gameID', '$playerID')";

	if ($conn->query($sql) === TRUE) {
		echo "New Board Game assignment added successfully <br> . " . "Assignment ID:   " . $assignmentID . "<br> Player:  " . $playerID . "<br>Game ID:  " . $gameID;
	}
	else 
	{
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

$conn->close();
?>







