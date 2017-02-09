<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "aHancockDB6";

if($_POST['formSubmit'] == "Submit")
{
	$memberID = test_input($_POST['memberID']);
	$firstName = test_input($_POST['firstName']);
	$familyName = test_input($_POST['familyName']);
	$email = test_input($_POST['email']);
	$phone = test_input($_POST['phone']);
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

// This attempts to validate memberID number
$result = $conn->query("SELECT memberID FROM Players WHERE memberID = '$memberID'");
if($result->num_rows > 0) {
	echo "ID ALREADY IN USE <br> Please pick another one";
} else 
{
	$sql = "INSERT INTO Players (memberID, firstName, familyName, email, phone)
	VALUES ('$memberID', '$firstName', '$familyName', '$email', '$phone')";

	if ($conn->query($sql) === TRUE) {
		echo "New member added successfully <br> Welcome " . $firstName . " " . $familyName;
	}
	else 
	{
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

$conn->close();
?>







