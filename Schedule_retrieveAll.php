<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "aHancockDB6";

//Retrieves all schedule entries

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT scheduleID, venue, aDate, aTime FROM Schedule";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Schedule id: " . $row["scheduleID"].     " - Venue: " . $row["venue"]. 
		"<br>Date: " . $row["aDate"] . "   - Time: " . $row["aTime"]. "<br>";
    }
} else {
    echo "0 results";
}










$conn->close();
?>