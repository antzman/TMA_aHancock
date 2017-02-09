<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "aHancockDB6";

if($_POST['deleteScheduleButt'] == "Delete")
{
	$scheduleID = test_input($_POST['deleteScheduleID']);
}

// Delete Schedule entry	

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


$result = $conn->query("SELECT scheduleID FROM Schedule WHERE scheduleID = '$scheduleID'");
if($result->num_rows > 0) 
{
    $sql = "DELETE FROM Schedule WHERE scheduleID='$scheduleID'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
else
{
    echo "Schedule ID " . $scheduleID . " does not exist in the database";
}


$conn->close();
?>