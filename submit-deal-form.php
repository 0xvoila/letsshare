<html>
<body>

<?php
	
	require_once('algoliasearch.php');

	$client = new \AlgoliaSearch\Client('WEQ1ZSOQ0G', '385f901dcaf5f9c89672ba880f4b5eab');

	$index = $client->initIndex('deal_search');
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
	    $last_id = $conn->insert_id;
	    
	    $makeSearchable = array(array('db_id' => $last_id,'deal_coupon' => $deal_coupon,'deal_description' => $deal_description, 'deal_title' => $deal_title));
	    print_r($makeSearchable);
		$index->addObjects($makeSearchable,true);

	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();

?>

</body>
</html>