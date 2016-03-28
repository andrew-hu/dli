
<html>
	<head>
		<title>DLI</title>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	</head>
	<body>
		<div>
			<h1>DLI Phrase Translator</h1>
		</div>
		<div>

			<?php
				header("Content-Type: text/html;charset=UTF-8");
				$servername = "dli.ccf1i42v6nph.us-west-2.rds.amazonaws.com:3306";
				$username = "primoriscruor";
				$password = "Si1hou3tt3";
				$dbname = "dli";
				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				$conn->set_charset("utf8");

				// Check connection
				if ($conn->connect_error) {
				    die("Connection failed: " . $conn->connect_error);
				} 
				echo "Connected successfully" . "<br>";
				$sql = "SET NAMES 'utf8'; 
						SET CHARACTER SET 'utf8';";
				$conn->query($sql);

				$sql = "SELECT id, english, arabic FROM translatetable";
				$result = $conn->query($sql);

				echo "<table>";
				if (mysqli_num_rows($result) > 0) {
				    // output data of each row
				    while($row = mysqli_fetch_assoc($result)) {
				        echo "<tr>";
				        echo "<td>" . $row["english"]. "</td><td>" . $row["arabic"]. "</td><br>";
				    	echo "</tr>";
				    }
				} else {
				    echo "0 results";
				}
				echo "</table>";
				$conn->close();

				?>
		</div>


	</body>
</html>