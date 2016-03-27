<?php
$servername = "dli.ccf1i42v6nph.us-west-2.rds.amazonaws.com:3306";
$username = "primoriscruor";
$password = "Si1hou3tt3";
$dbname = "dli";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

$sql = "SELECT id, english, arabic FROM translatetable";
$result = $conn->query($sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "id: " . $row["id"]. " - Row data: " . $row["english"]. " " . $row["arabic"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();

?>
<html>
	<head>
		<title>DLI</title>
	</head>
	<body>
		<div>
			<h1>DLI Phrase Translator</h1>
		</div>
		<div>
			Info here
		</div>


	</body>
</html>