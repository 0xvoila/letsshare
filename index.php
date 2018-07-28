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
</head>
<body>

<!-- This is for header -->
<div class="container site-header">
  <nav class="navbar">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">Letshare</a>
      </div>
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li class="active"><a href="submit-deal-form.html">Submit Coupon</li>
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
          <h1>Welcome to deal community</h1>
          <h6 style="text-align:center">Stop wasting your time, join the community now</h6>
        </div>
      </div>
  </div>
  <div class="row">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-6">
      <!-- Search form -->
    <input class="form-control" type="text" placeholder="Search" aria-label="Search">
    </div>
  </div>
</div>


<br>
<br>
<br>

<!-- This is for deals section -->
<div class="container">
  
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

  $fetch_deals = "select * from deals where is_approved='N'";
  $result = $conn->query($fetch_deals);
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo 
   
        '<!-- A row is a deal -->
        <div class="row deal" >
          <!-- This is  pic of the poster -->
            <div class="col-sm-2 deal-poster-image">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRErG00hM7WDheP9FCZvZTIWGurbuKLDCAoHAmKKemK2s6vsLjA" width="100%" height="100%">
            </div>

            <!-- This is deal portion -->
            <div class="col-sm-6">
              <!-- This is for showing Verified -->
              <div class="row">
                <div class="col-sm-4 deal-verification">
                  <button type="button" class="btn-xs btn-success">verified</button>
                </div>
              </div>
              <!-- This is to show title and Code and share a deal button-->
              <div class="row">
                <div class="col-sm-8 deal-title">'.
                  '<a href="#">'. $row['deal_title'].'</a>
                </div>
                <div class="col-sm-4 deal-coupon">
                  <span class="badge">' . $row['deal_coupon'] . '</span>
                </div>
              </div>
              <!-- This is to show description -->
              <div class="row">
                <div class="col-sm-8 deal-description">' .
                  $row['deal_description']
                .'</div>
              </div>
              <div class="row">
                <div class="col-md-8">
                        <!-- Here comments section will come -->
                  </div>
              </div>
            </div>
        </div>

        <div class="clearfix"></div>';
    } // while deal close
  }
  ?>
  
</div>
</body>
</html>
