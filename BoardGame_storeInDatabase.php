<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "aHancockDB6";

// Adding Board game to table/database

if($_POST['formSubmit'] == "Submit")
{
	$gameID = test_input($_POST['gameID']);
	$game = test_input($_POST['game']);
	$owner = test_input($_POST['owner']);	
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

// This attempts to validate gameID number
$result = $conn->query("SELECT gameID FROM BoardGames WHERE gameID = '$gameID'");
if($result->num_rows > 0) {
	echo "GAME ID ALREADY IN USE <br> Please pick another one";
} else 
{
	$sql = "INSERT INTO BoardGames (gameID, game, owner)
	VALUES ('$gameID', '$game', '$owner')";

	if ($conn->query($sql) === TRUE) {
		echo "New Board Game added successfully <br> . " . "Game:   " . $game . "<br>Game ID:  " . $gameID;
	}
	else 
	{
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

$conn->close();
?>







