<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "aHancockDB6";

//Retrieves all board games assignments 

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT assignmentID, gameID, playerID FROM BoardGamesAssignment";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Assignment id: " . $row["assignmentID"].     " - GameID: " . $row["gameID"]. "     PlayerID: " . $row["playerID"] . "<br>";
    }
} else {
    echo "0 results";
}










$conn->close();
?>