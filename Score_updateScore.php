<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "aHancockDB6";

if($_POST['updateScore'] == "Submit")
{
	$category = test_input($_POST['updateScoreCatogoryInput']);
	$scoreID = test_input($_POST['updateScoreIDInput']);
	$newValue = test_input($_POST['updateScoreInputText']);
		
}
//This is here for security. It is important to strip the text to avoid security exploits
function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}


// Update Score in database


$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//First need to check if Score exisits
$result = $conn->query("SELECT scoreID FROM Scoring WHERE scoreID = '$scoreID'");
if($result->num_rows > 0) {
	$sql = "UPDATE `Scoring` SET $category = '$newValue' WHERE scoreID = '$scoreID'";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} 
else 
{
    echo "Error updating record: " . $conn->error;
}

} else 
{
	echo "ID NOT IN USE <br> Please pick another one that is.";
}


$conn->close();
?>