
<html>
	<head>
		<title>DLI</title>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="css/homepage.css">
	</head>
	<body>
		<header id="header">
				<h1 class="logo"><a href="homepage.php"><img src="http://i.imgur.com/47112La.png?1"></a></h1>
				<!--span class="header-description">Bringing Communities Together<span-->
		</header>
		<div>
			<h1>DLI Phrase Translator</h1>
		</div>
		<div>
			 <img src="http://www.ilearnlatin.com/wp-content/uploads/2012/05/iStock_000006199287Medium.jpg"
            width="596" height="387"></img>
		</div>
		<div>
			<ul id="toc" style="list-style-type:circle">
				<h2>Table of Contents</h2>
				<a href="#default"><li>General Conversation</li></a>
				<a href="#lang"><li>Language Learning</li></a>
				<a href="#shop"><li>Shopping</li></a>
				<a href="#travel"><li>Travel</li></a>
			</ul><br><hr>
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
				//echo "Connected successfully" . "<br>";
				$sql = "SET NAMES 'utf8'; 
						SET CHARACTER SET 'utf8';";
				$conn->query($sql);

				$sql = "SELECT id, english, arabic, translate_type FROM translatetable WHERE translate_type='default' ";
				$result = $conn->query($sql);
				echo "<h2 id='convo'>Conversation Phrases</h2>";
				echo "<table>";
				if (mysqli_num_rows($result) > 0) {
				    // output data of each row
				    while($row = mysqli_fetch_assoc($result)) {
				        echo "<tr>";
				        echo "<td>" . $row["english"]. "</td><td>" . $row["arabic"]. "</td>";
				        echo "<td><audio id='". $row["id"]."' >";
						echo "<source src='TextToSpeech/" . $row["id"]. ".mp3'></source>";
						echo "Your browser isn't invited for super fun audio time.";
						echo "</audio><img onclick='playAudio(id=\"" .$row["id"]. "\")' type='button' src='http://i.imgur.com/7T5CQLX.png'></button></td>";
				    	echo "</tr>";
				    }
				} else {
				    echo "0 results";
				}
				echo "</table><br><hr>";

				$sql = "SELECT id, english, arabic, translate_type FROM translatetable WHERE translate_type='language' ";
				$result = $conn->query($sql);
				echo "<h2 id='lang'>Language Learning Phrases</h2>";
				echo "<table>";
				if (mysqli_num_rows($result) > 0) {
				    // output data of each row
				    while($row = mysqli_fetch_assoc($result)) {
				        echo "<tr>";
				        echo "<td>" . $row["english"]. "</td><td>" . $row["arabic"]. "</td>";
				        echo "<td><audio id='". $row["id"]."' >";
						echo "<source src='TextToSpeech/" . $row["id"]. ".mp3'></source>";
						echo "Your browser isn't invited for super fun audio time.";
						echo "</audio><img onclick='playAudio(id=\"" .$row["id"]. "\")' type='button' src='http://i.imgur.com/7T5CQLX.png'></button></td>";
				    	echo "</tr>";
				    }
				} else {
				    echo "0 results";
				}
				echo "</table><br><hr>";

				$sql = "SELECT id, english, arabic, translate_type FROM translatetable WHERE translate_type='shopping' ";
				$result = $conn->query($sql);
				echo "<h2 id='shop'>Shopping Phrases</h2>";
				echo "<table>";
				if (mysqli_num_rows($result) > 0) {
				    // output data of each row
				    while($row = mysqli_fetch_assoc($result)) {
				        echo "<tr>";
				        echo "<td>" . $row["english"]. "</td><td>" . $row["arabic"]. "</td>";
				        echo "<td><audio id='". $row["id"]."' >";
						echo "<source src='TextToSpeech/" . $row["id"]. ".mp3'></source>";
						echo "Your browser isn't invited for super fun audio time.";
						echo "</audio><img onclick='playAudio(id=\"" .$row["id"]. "\")' type='button' src='http://i.imgur.com/7T5CQLX.png'></button></td>";
				    	echo "</tr>";
				    }
				} else {
				    echo "0 results";
				}
				echo "</table><br><hr>";

				$sql = "SELECT id, english, arabic, translate_type FROM translatetable WHERE translate_type='travel' ";
				$result = $conn->query($sql);
				echo "<h2 id='travel'>Travelling Phrases</h2>";
				echo "<table>";
				if (mysqli_num_rows($result) > 0) {
				    // output data of each row
				    while($row = mysqli_fetch_assoc($result)) {
				        echo "<tr>";
				        echo "<td>" . $row["english"]. "</td><td>" . $row["arabic"]. "</td>";
				        echo "<td><audio id='". $row["id"]."' >";
						echo "<source src='TextToSpeech/" . $row["id"]. ".mp3'></source>";
						echo "Your browser isn't invited for super fun audio time.";
						echo "</audio><img onclick='playAudio(id=\"" .$row["id"]. "\")' type='button' src='http://i.imgur.com/7T5CQLX.png'></button></td>";
				    	echo "</tr>";
				    }
				} else {
				    echo "0 results";
				}
				echo "</table><br><hr>";
				$conn->close();

				?>
		</div>


	<script>
		

		function playAudio(id) { 
			var x = document.getElementById(id); 
		    x.play(); 
		} 
	</script>
	</body>
</html>