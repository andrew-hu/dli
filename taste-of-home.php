<?php
include 'sample.php';
?>

<html>
	<head>
		<title>DLI</title>
	</head>
	<body>
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