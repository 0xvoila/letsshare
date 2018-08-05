<!DOCTYPE html>

<?php       require_once('algoliasearch.php');
            $client = new \AlgoliaSearch\Client('WEQ1ZSOQ0G', '385f901dcaf5f9c89672ba880f4b5eab');
            $index = $client->initIndex('deal_search');
            
?>
<html lang="en">
<head>
    
    
     <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-123290881-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-123290881-1');
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

 <?php 
    $dealId = $_GET['deal_id'];
    $dealSlug = $_GET['deal_slug'];
    $dealTitle = preg_replace('/-/', ' ', $dealSlug);
    $dealTitle = trim($dealTitle);
    
    $deal = $index->getObject($dealId);
    if (!$dealTitle){
        echo '<title>Deals & Discount Community</title>';      
    }
    else {
        echo '<title>' . $dealTitle . '</title>';
    }
  ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <?php 
            $metaDescription = "";
            if (!$dealTitle){
                echo '<meta name=description content= "Deals | Offers | Coupon | Best | Active" />';
            } 
            else {
                    $metaDescription = $metaDescription . ' | ' . $dealTitle;
                }
        
            $metaDescription = str_replace(' ', '',$metaDescription);
            $metaDescription = str_replace('|', '',$metaDescription);
            
            echo '<meta name="description" content="'. $metaDescription .'"/>';   
   ?>

  <meta name="viewport" id="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no"> 
  <meta name="robots" content="noodp, noydir">
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
  <link rel="stylesheet" type="text/css" href="/css/jquery-comments.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

  
  <script type="text/javascript" src="/js/jquery-comments.js"></script>
</head>



<body>
<!-- This is for header -->
<div class="container site-header">
  <nav class="navbar">  
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="/">DealsbyCommunity</a>
      </div>
      <ul class="nav navbar-nav">
        <li class="active"><a href="/submit-deal-form.html">Submit a Deal</a></li>
      </ul>
    </div>  
  </nav>
</div>

<div class="container" id="deal-container">
    
    <!--Here deal will come from javascript-->
<?php 
            $htmlTemplate = '<br>';
            $count = 0;
            if (empty($deal)){
                echo "<br> No Deals Found Matching the Search Criteria";
            }
            
                        
                        echo '<!-- A row is a deal --><div id=' . $deal["objectID"] .' class="row deal" ><!-- This is  pic of the poster -->  <div class="col-sm-2 deal-poster-image">      <img src="http://wfarm2.dataknet.com/static/resources/icons/set108/b5cdab07.png" width="100%" height="100%">  </div><!-- This is deal portion -->  <div class="col-sm-10"> <!-- This is to show title and Code and share a deal button-->    <div class="row">      <div class="col-sm-8 deal-title"> <button type="button" class="btn-xs btn-success">verified</button>' .        '<h3><a href="#">'. $deal["deal_title"] .'</a></h3>      </div>      <div class="col-sm-2 deal-coupon">        <span class="deal-coupon-code">' . $deal["deal_coupon"] . '</span>      </div>    </div>    <!-- This is to show description --> <div class="row"><div class="col-sm-8">' . '<a href="' . $deal["deal_url"] . '">' . $deal["deal_url"] . '</a>' . '</div></div>   <div class="row">      <div class="col-sm-8 deal-description">' .       $deal["deal_description"]    . '</div>    </div><br><br>    <div class="row">      <div class="col-md-8"> <div id="comments-container"> </div></div>  </div>       </div>    </div><hr>';
                    
        ?>
        
</div>


</body>
<script src="/js/script.js"></script>
<script src="/js/authentication.js"></script>
</html>