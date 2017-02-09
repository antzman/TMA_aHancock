<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "aHancockDB6";

// Adding Score entries to table/database

if($_POST['formSubmit'] == "Submit")
{
	$scoreID = test_input($_POST['scoreID']);
	$playerID = test_input($_POST['playerID']);	
	$gameID = test_input($_POST['gameID']);
	$score = test_input($_POST['score']);	
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

// This attempts to validate scoreID number
$result = $conn->query("SELECT scoreID FROM Scoring WHERE scoreID = '$scoreID'");
if($result->num_rows > 0) {
	echo "Score ID ALREADY IN USE <br> Please pick another one";
} else 
{
	$sql = "INSERT INTO Scoring (scoreID, playerID, gameID, score)
	VALUES ('$scoreID', '$playerID', '$gameID', '$score')";

	if ($conn->query($sql) === TRUE) {
		echo "New Score entry added successfully <br> . " . "Score ID:   " . $scoreID . 
		"Player ID:  " . $playerID . "   Game ID: " . $gameID . "  Score:  " . $score;
	}
	else 
	{
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

$conn->close();
?>







