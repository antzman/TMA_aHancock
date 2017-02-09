<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "aHancockDB6";

// Adding Schedule entries to table/database

if($_POST['formSubmit'] == "Submit")
{
	$scheduleID = test_input($_POST['scheduleID']);
	$venue = test_input($_POST['venue']);	
	$date = test_input($_POST['aDate']);	
	$time = test_input($_POST['aTime']);	
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

// This attempts to validate scheduleID number
$result = $conn->query("SELECT scheduleID FROM Schedule WHERE scheduleID = '$scheduleID'");
if($result->num_rows > 0) {
	echo "Assignment ID ALREADY IN USE <br> Please pick another one";
} else 
{
	$sql = "INSERT INTO Schedule (scheduleID, venue, aDate, aTime)
	VALUES ('$scheduleID', '$venue', '$date', '$time')";

	if ($conn->query($sql) === TRUE) {
		echo "New Schedule entry added successfully <br> . " . "Schedule Entry ID:   " . $scheduleID . 
		"<br> Venue:  " . $venue . "<br>Date:  " . $date . " Time: " . $time;
	}
	else 
	{
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

$conn->close();
?>







