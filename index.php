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
    $query = $_GET['q'];
     
    $query = preg_replace('/-/', ' ', $query);
    $query = str_replace(' ', '',$query);
    $query = str_replace('-', '',$query);
    $results = $index->search($query);
    if (!$query){
        echo '<title>Deals & Discount Community</title>';      
    }
    else {
        echo '<title>' . $query . '</title>';
    }
  ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <?php 
            $metaDescription = "";
            if (empty($results['hits']) || !$query){
                echo '<meta name=description content= "Deals | Offers | Coupon | Best | Active" />';
            } 
            else {
                foreach ($results['hits'] as $key => $deal){
                    $metaDescription = $metaDescription . ' | ' . $deal['deal_title'];
                }
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

<!-- This is for banner and search box -->
<div class="container">
  <div class="row">
    <div class="col-sm-3">
    </div>
      <div class="col-sm-6">
        <div>
          <h1 style="text-align:center">Community of Offers & Discounts</h1>
          <h2 style="text-align:center">Real Discounts by Real People </h2>
        </div>
      </div>
  </div>
  <div class="row">
    <div class="col-sm-3">
    </div>
    <div class="col-sm-6">
      <!-- Search form -->
        <div>
            <input type="text" class="form-control" id="deal-search-box" name="deal-search" placeholder="Search a deal and press enter">
        </div>
    </div>
     <div class="col-sm-2">
      <input type="button" class="btn btn-info" id="deal-search-box-submit-btn" name="deal-search-submit-btn" value="Search Deals">
    </div>
  </div>
  <br>

  <div class="row">
    <div class="col-sm-5">
    </div>
  </div>
</div>


<br>

<!-- This is for deals section -->
<div class="container" id="deal-container">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#">Deals</a></li>
    </ul>
<!--Here deal will come from javascript-->
<?php 
            $htmlTemplate = '<br>';
            $count = 0;
            if (empty($results['hits'])){
                echo "<br> No Deals Found Matching the Search Criteria";
            }
            foreach ($results['hits'] as $key => $deal){
                        if($count == 0){
                            echo '<br>';
                            $count = $count + 1;
                        }
                        echo '<!-- A row is a deal --><div id=' . $deal["objectID"] .' class="row deal" ><!-- This is  pic of the poster -->  <div class="col-sm-2 deal-poster-image">      <img src="http://wfarm2.dataknet.com/static/resources/icons/set108/b5cdab07.png" width="100%" height="100%">  </div><!-- This is deal portion -->  <div class="col-sm-10"> <!-- This is to show title and Code and share a deal button-->    <div class="row">      <div class="col-sm-8 deal-title"> <button type="button" class="btn-xs btn-success">verified</button>' .        '<h3><a href="#">'. $deal["deal_title"] .'</a></h3>      </div>      <div class="col-sm-2 deal-coupon">        <span class="deal-coupon-code">' . $deal["deal_coupon"] . '</span>      </div>    </div>    <!-- This is to show description --> <div class="row"><div class="col-sm-8">' . '<a href="' . $deal["deal_url"] . '">' . $deal["deal_url"] . '</a>' . '</div></div>   <div class="row">      <div class="col-sm-8 deal-description">' .       $deal["deal_description"]    . '</div>    </div><br><br>    <div class="row">      <div class="col-md-8"> <div id="comments-container"> </div></div>  </div>       </div>    </div><hr>';
                    
            }
    
        ?>
</div>

<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 style="color:red;"><span class="glyphicon glyphicon-lock"></span> Login</h4>
        </div>
        <div class="modal-body">
          <form role="form">
            <div class="form-group">
              <label for="usrname"><span class="glyphicon glyphicon-user"></span>Email Id</label>
              <input type="text" class="form-control" id="email" placeholder="Enter email">
            </div>
            <div class="form-group">
              <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
              <input type="password" class="form-control" id="password" placeholder="Enter password">
            </div>
            <button type="submit" id="login-btn" class="btn btn-default btn-success btn-block">Press Enter</button>
          </form>
        </div>
      </div>
    </div>
  </div> 
</div>


</body>
<script src="/js/script.js"></script>
<script src="/js/authentication.js"></script>
</html>
