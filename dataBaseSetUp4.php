<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "aHancockDB6";



// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Create database
$sql = "CREATE DATABASE $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully <br>";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();

// CREATE TABLE
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to create table
$sql = "CREATE TABLE Players (
memberID VARCHAR(20) NOT NULL PRIMARY KEY, 
firstName VARCHAR(20) NOT NULL,
familyName VARCHAR(20) NOT NULL,
email VARCHAR(25) NOT NULL,
phone VARCHAR(15) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Players created successfully <br>";
} else {
    echo "Error creating table: " . $conn->error;
}

// Create Board game table
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "CREATE TABLE BoardGames (
game VARCHAR(20) NOT NULL,
gameID VARCHAR(20) NOT NULL PRIMARY KEY,
owner VARCHAR(20) NOT NULL,
FOREIGN KEY (owner) REFERENCES Players(memberID)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table BoardGames created successfully <br>";
} else {
    echo "Error creating table: " . $conn->error;
}



// Create BoardGamesAssignment table

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "CREATE TABLE BoardGamesAssignment (
assignmentID VARCHAR(20) NOT NULL PRIMARY KEY,
gameID VARCHAR(20) NOT NULL,
playerID VARCHAR(20) NOT NULL,
FOREIGN KEY (gameID) REFERENCES BoardGames(gameID),
FOREIGN KEY (playerID) REFERENCES Players(memberID)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table BoardGamesAssignment created successfully <br>";
} else {
    echo "Error creating table: " . $conn->error;
}


// Create Schedule TABLE

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "CREATE TABLE Schedule (
scheduleID VARCHAR(20) NOT NULL PRIMARY KEY,
venue VARCHAR(20) NOT NULL,
aDate VARCHAR(20) NOT NULL,
aTime VARCHAR(20) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Schedule created successfully <br>";
} else {
    echo "Error creating table: " . $conn->error;
}


// Create Scoring TABLE
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "CREATE TABLE Scoring (
scoreID VARCHAR(20) NOT NULL PRIMARY KEY,
playerID VARCHAR(20) NOT NULL,
gameID VARCHAR(20) NOT NULL,
score VARCHAR(20) NOT NULL,
FOREIGN KEY (playerID) REFERENCES Players(memberID),
FOREIGN KEY (gameID) REFERENCES BoardGames(gameID)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Scoreing created successfully <br>";
} else {
    echo "Error creating table: " . $conn->error;
}





// INSERT INITAL DATA MEMBERS

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO Players (memberID, firstName, familyName, email, phone)
VALUES ('1', 'Bob', 'Dole', 'bobby911@hotmail.com', '0274240885');";
$sql .= "INSERT INTO Players (memberID, firstName, familyName, email, phone)
VALUES ('2', 'Harry', 'Potter', 'magicwand@hogwarts.uk', '078854231');";
$sql .= "INSERT INTO Players (memberID, firstName, familyName, email, phone)
VALUES ('3', 'Luke', 'Skywalker', 'wampratVII@gmail.com', '095652314');";
$sql .= "INSERT INTO Players (memberID, firstName, familyName, email, phone)
VALUES ('4', 'Sheldon', 'Cooper', 'cooperpooper@harvad.edu', '038875757');";
$sql .= "INSERT INTO Players (memberID, firstName, familyName, email, phone)
VALUES ('5', 'Clarke', 'Kent', 'notsuperman@justiceleague.co.nz', '099999999');";
$sql .= "INSERT INTO Players (memberID, firstName, familyName, email, phone)
VALUES ('6', 'Wayne', 'Bruce', 'manbat@gmail.com', '0254289897')";

if ($conn->multi_query($sql) === TRUE) {
    echo "<br> New Player records created successfully <br>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// INSERT INITAL DATA BOARDGAMES

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO BoardGames(gameID, game, owner)
VALUES ('1', 'Apples to Apples', '1');";
$sql .= "INSERT INTO BoardGames(gameID, game, owner)
VALUES ('2', 'Monopoly', '1');";
$sql .= "INSERT INTO BoardGames(gameID, game, owner)
VALUES ('3', 'Sushi Go', '2');";
$sql .= "INSERT INTO BoardGames(gameID, game, owner)
VALUES ('4', '7 Wonders', '3')";

if ($conn->multi_query($sql) === TRUE) {
    echo "<br> New Board Game records created successfully <br>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}




// Print out all member entries

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

// Print out all Board Game entries

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT gameID, game, owner FROM BoardGames";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Game id: " . $row["gameID"]. " - Game: " . $row["game"] .  " - Owner ID: " . $row["owner"] . " <br>";
    }
} else {
    echo "0 results";
}






$conn->close();
?>