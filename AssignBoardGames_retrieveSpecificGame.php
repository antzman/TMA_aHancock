<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "aHancockDB6";

//Retrieve specific board game assignment

if($_POST['findDetailsSubmit'] == "Submit")
{
	$category = test_input($_POST['searchedAssignmentCatogoryInput']);
	$term = test_input($_POST['searchedAssignmentTermInput']);
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
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM BoardGamesAssignment WHERE $category LIKE '%{$term}%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Board Game Assignment ID: " . $row["assignmentID"]. "     GameID: " . $row["gameID"]. "   Player ID: " . $row["playerID"] . "<br>";
    }
} else {
    echo "0 results";
}





$conn->close();
?>