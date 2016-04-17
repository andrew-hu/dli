<?php
include 'sample.php';
?>

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
			<h1>DLI Taste of Home</h1>
		</div>
		<div>
		<?php
		query_api($term, $location);
		?>
		</div>


	</body>
</html>