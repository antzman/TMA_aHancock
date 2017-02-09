<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "aHancockDB6";

// Retreives specific Member 

if($_POST['findDetailsSubmit'] == "Submit")
{
	$category = test_input($_POST['searchedFieldInput']);
	$term = test_input($_POST['searchedTerm']);
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

$sql = "SELECT * FROM Players WHERE $category LIKE '%{$term}%'";
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