<!DOCTYPE html>
<html lang="en">
<head>
  <title>Deals & Discount Community</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="script.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
</head>
<body>

<!-- This is for header -->
<div class="container site-header">
  <nav class="navbar">  
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="/">Letshare</a>
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
          <h3 style="text-align:center">Welcome to Deals Community</h3>
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
</div>
</body>
</html>
