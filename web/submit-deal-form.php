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
    <!-- Hotjar Tracking Code for http://www.dealsbycommunity.com -->
    <script>
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:968503,hjsv:6};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>
    <script src="https://www.gstatic.com/firebasejs/5.3.0/firebase-app.js"></script>

    <!-- Add additional services that you want to use -->
    <script src="https://www.gstatic.com/firebasejs/5.3.0/firebase-auth.js"></script>
    <script>
      // Initialize Firebase
      var config = {
        apiKey: "AIzaSyDjaD26UkYqXbuTvdjuRqrjI9vd9JlnueI",
        authDomain: "fir-store-9c275.firebaseapp.com",
        databaseURL: "https://fir-store-9c275.firebaseio.com",
        projectId: "fir-store-9c275",
        storageBucket: "fir-store-9c275.appspot.com",
        messagingSenderId: "359256095334"
      };
      firebase.initializeApp(config);
    </script>
    
</head>
<body>

<?php
	
	require_once('algoliasearch.php');

	$client = new \AlgoliaSearch\Client('WEQ1ZSOQ0G', '385f901dcaf5f9c89672ba880f4b5eab');

	$index = $client->initIndex('deal_search');
	// $servername = "localhost";
	// $username = "root";
	// $password = "root";
	// $dbname = "letshare";

	// Create connection
  $servername = getenv('MYSQL_IP');
  $username = getenv('MYSQL_USER');
  $password = getenv('MYSQL_PASSWORD');
  $dbname = getenv('MYSQL_DBNAME');

	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		echo "connection issue";
	    die("Connection failed: " . $conn->connect_error);
	} 

	$deal_coupon = mysqli_real_escape_string($conn, $_POST['deal-coupon']);
	$deal_title = mysqli_real_escape_string($conn,$_POST['deal-title']);
	$deal_description = mysqli_real_escape_string($conn,$_POST['deal-description']);
    $deal_url = mysqli_real_escape_string($conn,$_POST['deal-url']);
    
    $ch = curl_init("https://latest-browser-screenshots-dot-fir-store-9c275.appspot.com/?url=" . $deal_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $dealImageURL = curl_exec($ch);
    curl_close($ch);
    
    $time = time();
    $submitDate = date("Y-m-d",$time);
    
	$sql = "INSERT INTO deals (deal_title, deal_description, deal_coupon,deal_url,is_approved) VALUES" . "('".$deal_title . "'," . "'" . $deal_description . "'," . "'" . $deal_coupon . "'," . "'" . $deal_url . "'," . "'" . 'N' . "');";

	if ($conn->query($sql) === TRUE) {
	    echo 'Thank you for contribution. You deal is submitted for verification . Click on <a href="https://dealsbycommunity.com">Back to website</a>';
	    $last_id = $conn->insert_id;
	    $deal_slug =  htmlspecialchars(strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', trim($deal_title)))));
            
	    $makeSearchable = array(array('objectID' => $last_id,'deal_coupon' => $deal_coupon,'deal_description' => $deal_description, 'deal_title' => $deal_title , 'deal_url' =>$deal_url,'deal_support_search'=>[$deal_title],'deal_slug' => $deal_slug,'comments' => [], 'deal_status' => 'active', 'deal_approved' => 'Y' ,'tags'=>[], 'deal_image_url' => $dealImageURL,'deal_submitted_on'=> $submitDate, 'deal_updated_on' => $submitDate , 'deal_used_on' => $submitDate));
        
		$index->addObjects($makeSearchable,true);

	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();

?>

</body>
<script src="/js/authentication.js"></script>

</html>