<html>
<body>

<?php
	
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "letshare";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		echo "connection issue";
	    die("Connection failed: " . $conn->connect_error);
	} 

	$deal_coupon = $_POST['deal-coupon'];
	$deal_title = $_POST['deal-title'];
	$deal_description = $_POST['deal-description'];

	$sql = "INSERT INTO deals (deal_title, deal_description, deal_coupon,is_approved) VALUES" . "('".$deal_title . "'," . "'" . $deal_description . "'," . "'" . $deal_coupon . "'," . "'" . 'N' . "');";

	if ($conn->query($sql) === TRUE) {
	    echo "Thank you for contribution. You deal is submitted for verification";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();

?>

</body>
</html>