<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "aHancockDB6";

if($_POST['updateSchedule'] == "Submit")
{
	$category = test_input($_POST['updateScheduleCatogoryInput']);
	$scheduleID = test_input($_POST['updateScheduleIDInput']);
	$newValue = test_input($_POST['updateScheduleInputText']);
		
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
$result = $conn->query("SELECT scheduleID FROM Schedule WHERE scheduleID = '$scheduleID'");
if($result->num_rows > 0) {
	$sql = "UPDATE `Schedule` SET $category = '$newValue' WHERE scheduleID = '$scheduleID'";

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