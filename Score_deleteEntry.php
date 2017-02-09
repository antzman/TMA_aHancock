<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "aHancockDB6";

if($_POST['deleteScoreButt'] == "Delete")
{
	$scoreID = test_input($_POST['deleteScoreID']);
}

function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}


// Delete Score entry	

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$result = $conn->query("SELECT scoreID FROM Scoring WHERE scoreID = '$scoreID'");
if($result->num_rows > 0) 
{
    $sql = "DELETE FROM Scoring WHERE scoreID='$scoreID'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
else
{
    echo "Score ID " . $scoreID . " does not exist in the database";
}


$conn->close();
?>