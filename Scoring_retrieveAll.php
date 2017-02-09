<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "aHancockDB6";

//Retrieves all scores

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT scoreID, playerID, gameID, score FROM Scoring";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Score id: " . $row["scoreID"]. "   - Player ID: " . $row["playerID"]. 
		"Game ID: " . $row["gameID"] . "   - Score: " . $row["score"]. "<br>";
    }
} else {
    echo "0 results";
}


$conn->close();
?>