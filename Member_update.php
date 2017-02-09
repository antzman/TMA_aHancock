<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "aHancockDB6";

if($_POST['updateMember'] == "Submit")
{
	$category = test_input($_POST['updateFieldInput']);
	$UmemberID = test_input($_POST['updateIDInput']);
	$newValue = test_input($_POST['updateIDInputText']);	
}

//Update member information

//This is here for security. It is important to strip the text to avoid security exploits
function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//First need to check if player exisits
$result = $conn->query("SELECT memberID FROM Players WHERE memberID = '$UmemberID'");
if($result->num_rows > 0) {
	$sql = "UPDATE `Players` SET $category = '$newValue' WHERE memberID = '$UmemberID'";

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