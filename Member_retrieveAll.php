<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "aHancockDB6";



$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT memberID, firstName, familyName, email, phone FROM Players";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["memberID"]. " - Name: " . $row["firstName"]. " " . $row["familyName"]. " - Email: " . $row["email"] . " Phone #: " .$row["phone"] . "<br>";
    }
} else {
    echo "0 results";
}










$conn->close();
?>