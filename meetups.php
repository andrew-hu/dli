<html>
	<head>
		<title>DLI</title>
		<link rel="stylesheet" type="text/css" href="css/homepage.css">
	</head>
	<body>
		<header id="header">
				<h1 class="logo"><a href="homepage.php"><img src="http://i.imgur.com/47112La.png?1"></a></h1>
				<!--span class="header-description">Bringing Communities Together<span-->
		</header>
		<div>
			<h1>DLI Meetups</h1>
		</div>
		<div>
			 <img src="https://nzfrenzynorth.files.wordpress.com/2013/01/the-picnic-area-at-swimmable-tomarata-lake.jpg"
            width="596" height="387"></img>
		</div>
		<div>
			<h2>Search for events in your city</h2>
			<form id="search_form">
				  Event location:<br>
				  <input type="text" name="searchloc" value="City, State"><br><br>
				  <input type="submit" value="Submit">
			</form>
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

				if (isset($_GET['fullname'], $_GET['eventname'], $_GET['eventdate'], $_GET['eventdesc'], $_GET['eventloc'])) {
					$sql = "INSERT into eventTable (event_owner, event_name, event_location, event_desc, event_date) VALUES ('" . $_GET['fullname'] . "','" . $_GET['eventname'] . "','" . $_GET['eventloc'] . "','" . $_GET['eventdesc'] . "','" . $_GET['eventdate'] . "')" ;
					$conn->query($sql);
					echo "sending form data";
				}
				
				if (isset($_GET['searchloc'])){
					$sql = "SELECT id, event_owner, event_name, event_location, event_desc, event_date FROM eventTable WHERE event_location = '" . $_GET['searchloc'] . "'";
				}
				else { $sql = "SELECT id, event_owner, event_name, event_location, event_desc, event_date FROM eventTable WHERE event_location = 'Fremont, CA' "; }
				$result = $conn->query($sql);
				echo "<h2 id='convo'>Events</h2>";
				echo "<table id=\"events_table\"";
				echo "<tr><th>Event Owner</th><th>Event Name</th><th>Date</th><th>Description</th><th>Location</th></tr>";
				if (mysqli_num_rows($result) > 0) {
				    // output data of each row
				    while($row = mysqli_fetch_assoc($result)) {
				        echo "<tr>";
				        echo "<td>" . $row["event_owner"]. "</td><td>" . $row["event_name"]. "</td><td>" .$row["event_date"]. "</td><td>" .$row["event_desc"]. "</td><td>" . $row["event_location"]. "</td>" ;
				    	echo "</tr>";
				    }
				} else {
				    echo "0 results";
				}
				echo "</table><br><hr>";
				$conn->close();
		?>
		</div>
		<div>
			<h2>Create Your own Event</h2>
			<form id="event_form">
				  Full name:<br>
				  <input type="text" name="fullname" value="Your Name" required><br>

				  Event name:<br>
				  <input type="text" name="eventname" value="Your event name" required><br>

				  Event date:<br>
				  <input type="date" name="eventdate" required><br>
				  
				  Event description:<br>
				  <textarea rows="4" cols="50" name="eventdesc" form="event_form" required>Your event info here...</textarea><br>

				  Event location:<br>
				  <input type="text" name="eventloc" value="City, State" required><br><br>
				  <input type="submit" value="Submit">
			</form>
		</div>


	</body>
</html>
