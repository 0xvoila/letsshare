<html>
<head>

     <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-123290881-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-123290881-1');
    </script>
</head>
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
    $deal_url = $_POST['deal-url'];
    
	$sql = "INSERT INTO deals (deal_title, deal_description, deal_coupon,deal_url,is_approved) VALUES" . "('".$deal_title . "'," . "'" . $deal_description . "'," . "'" . $deal_coupon . "'," . "'" . $deal_url . "'," . "'" . 'N' . "');";

	if ($conn->query($sql) === TRUE) {
	    echo 'Thank you for contribution. You deal is submitted for verification . Click on <a href="http://dealsbycommunity.com">Back to website</a>';
	    $last_id = $conn->insert_id;
	    
	    $makeSearchable = array(array('objectID' => $last_id,'deal_coupon' => $deal_coupon,'deal_description' => $deal_description, 'deal_title' => $deal_title , 'deal_url' =>$deal_url,'deal_support_search'=>[$deal_title],'comments' => [], 'deal_status' => 'active', 'tags'=>[]));
		$index->addObjects($makeSearchable,true);

	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();

?>

</body>
</html>