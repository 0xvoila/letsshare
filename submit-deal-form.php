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
    <script type="text/javascript">
      (function(e,t){var n=e.amplitude||{_q:[],_iq:{}};var r=t.createElement("script")
      ;r.type="text/javascript";r.async=true
      ;r.src="https://cdn.amplitude.com/libs/amplitude-4.4.0-min.gz.js"
      ;r.onload=function(){if(e.amplitude.runQueuedFunctions){
      e.amplitude.runQueuedFunctions()}else{
      console.log("[Amplitude] Error: could not load SDK")}}
      ;var i=t.getElementsByTagName("script")[0];i.parentNode.insertBefore(r,i)
      ;function s(e,t){e.prototype[t]=function(){
      this._q.push([t].concat(Array.prototype.slice.call(arguments,0)));return this}}
      var o=function(){this._q=[];return this}
      ;var a=["add","append","clearAll","prepend","set","setOnce","unset"]
      ;for(var u=0;u<a.length;u++){s(o,a[u])}n.Identify=o;var c=function(){this._q=[]
      ;return this}
      ;var l=["setProductId","setQuantity","setPrice","setRevenueType","setEventProperties"]
      ;for(var p=0;p<l.length;p++){s(c,l[p])}n.Revenue=c
      ;var d=["init","logEvent","logRevenue","setUserId","setUserProperties","setOptOut","setVersionName","setDomain","setDeviceId","setGlobalUserProperties","identify","clearUserProperties","setGroup","logRevenueV2","regenerateDeviceId","logEventWithTimestamp","logEventWithGroups","setSessionId","resetSessionId"]
      ;function v(e){function t(t){e[t]=function(){
      e._q.push([t].concat(Array.prototype.slice.call(arguments,0)))}}
      for(var n=0;n<d.length;n++){t(d[n])}}v(n);n.getInstance=function(e){
      e=(!e||e.length===0?"$default_instance":e).toLowerCase()
      ;if(!n._iq.hasOwnProperty(e)){n._iq[e]={_q:[]};v(n._iq[e])}return n._iq[e]}
      ;e.amplitude=n})(window,document);

      amplitude.getInstance().init("84d7a1a6e55bd5b76d2f8263f8cff862");
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