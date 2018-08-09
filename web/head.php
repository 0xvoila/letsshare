<head>    
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

     <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-123290881-1"></script>
    <script src="//platform-api.sharethis.com/js/sharethis.js#property=5b62ef4178eb8b00113e3611&product=inline-share-buttons"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.min.js"></script>

    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css" />

    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-flat.css" />
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-123290881-1');
    </script>

    <script type="text/javascript" src="/js/jquery-comments.js"></script>
</head>