<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "aHancockDB6";

if($_POST['updateGame'] == "Submit")
{
	$category = test_input($_POST['updateGameFieldInput']);
	$gameID = test_input($_POST['updateGameIDInput']);
	$newValue = test_input($_POST['updateGameInputText']);	
}

//This is here for security. It is important to strip the text to avoid security exploits
function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}


// Update Board game in database


$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//First need to check if game exisits
$result = $conn->query("SELECT gameID FROM BoardGames WHERE gameID = '$gameID'");
if($result->num_rows > 0) {
	$sql = "UPDATE `BoardGames` SET $category = '$newValue' WHERE gameID = '$gameID'";

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