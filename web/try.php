<?php

// Create connection
  $servername = getenv('MYSQL_IP');
  $username = getenv('MYSQL_USER');
  $password = getenv('MYSQL_PASSWORD');
  $dbname = getenv('MYSQL_DBNAME');

	$conn = new mysqli('35.202.97.67', 'root', '2June1989!', 'community');
	// Check connection
	echo "I am here";
	if ($conn->connect_error) {
		echo "connection issue";
	    die("Connection failed: " . $conn->connect_error);
	} 

	else {
		echo "it is connected";
	}
?>

<html>
<head>
	<title></title>
</head>
<body>
<!-- Calendly inline widget begin -->
<div class="calendly-inline-widget" data-url="https://calendly.com/amit-a/30min" style="min-width:320px;height:580px;"></div>
<script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js"></script>
<!-- Calendly inline widget end -->
</body>
</html>
