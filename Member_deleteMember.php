<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "aHancockDB6";

// Deletes a member

if($_POST['deleteMemberButt'] == "Delete")
{
	$member = test_input($_POST['deleteInputID']);
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


$result = $conn->query("SELECT memberID FROM Players WHERE memberID = '$member'");
if($result->num_rows > 0) 
{
    $sql = "DELETE FROM Players WHERE memberID='$member'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
else
{
    echo "Member ID " . $member . " does not exist in the database";
}


$conn->close();
?>