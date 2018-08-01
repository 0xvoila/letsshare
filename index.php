<!DOCTYPE html>

<?php       require_once('algoliasearch.php');
            $client = new \AlgoliaSearch\Client('WEQ1ZSOQ0G', '385f901dcaf5f9c89672ba880f4b5eab');
            $index = $client->initIndex('deal_search');
            $index->setSettings(
                [
                    'searchableAttributes' => ['deal_title','deal_description','deal_support_search']
                ]
            );
            $index->setSettings(
                [
                    'attributesToRetrieve' => ['deal_title','deal_description','deal_support_search']
                ]
            );
        
?>
<html lang="en">
<head>
  <title>Deals & Discount Community</title>
  <meta charset="utf-8">
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
          <h3 style="text-align:center">Welcome to Deals By Community</h3>
          <h6 style="text-align:center">Stop wasting your time on expired deals - join the community now</h6>
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
  </div>
  <br>

  <div class="row">
    <div class="col-sm-5">
    </div>
    <div class="col-sm-2">
      <input type="button" class="btn btn-info" id="deal-search-box-submit-btn" name="deal-search-submit-btn" value="Search Deals">
    </div>
  </div>
</div>


<br>
<br>
<br>

<div class="container">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#">Deals</a></li>
  </ul>
</div>
<!-- This is for deals section -->
<div class="container" id="deal-container">
<!--Here deal will come from javascript-->
<?php 
            $query = $_GET['q'];
            $results = $index->search($query);
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
                        echo '<!-- A row is a deal --><div class="row deal" ><!-- This is  pic of the poster -->  <div class="col-sm-2 deal-poster-image">      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRErG00hM7WDheP9FCZvZTIWGurbuKLDCAoHAmKKemK2s6vsLjA" width="100%" height="100%">  </div><!-- This is deal portion -->  <div class="col-sm-6">    <!-- This is for showing Verified -->    <div class="row">      <div class="col-sm-4 deal-verification">        <button type="button" class="btn-xs btn-success">verified</button>      </div>    </div>    <!-- This is to show title and Code and share a deal button-->    <div class="row">      <div class="col-sm-8 deal-title">' .        '<a href="#">'. $deal["deal_title"] .'</a>      </div>      <div class="col-sm-2 deal-coupon">        <span class="deal-coupon-code">' . $deal["deal_coupon"] . '</span>      </div>    </div>    <!-- This is to show description --> <div class="row"><div class="col-sm-8">' . '<a href="' . $deal["deal_url"] . '">' . $deal["deal_url"] . '</a>' . '</div></div>   <div class="row">      <div class="col-sm-8 deal-description">' .       $deal["deal_description"]    . '</div>    </div><br><br>    <div class="row">      <div class="col-md-8"> <div id="comments-container"> </div></div>  </div>       </div>    </div>  </div></div><hr>';
                    
            }
    
        ?>
</div>
<div class="row">
    <div class="col-sm-6">
    </div>
</div>
</body>
<script src="/js/script.js"></script>
</html>
