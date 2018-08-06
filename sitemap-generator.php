<?php
  header('Content-type: application/xml');
  
 function slugify($text)
  {
      // replace non letter or digits by -
      $text = preg_replace('~[^\pL\d]+~u', '-', $text);

      // transliterate
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

      // remove unwanted characters
      $text = preg_replace('~[^-\w]+~', '', $text);

      // trim
      $text = trim($text, '-');

      // remove duplicate -
      $text = preg_replace('~-+~', '-', $text);

      // lowercase
      $text = strtolower($text);

      if (empty($text)) {
        return 'n-a';
      }

     return $text;
}

    require_once('algoliasearch.php');
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

// configuration
  $url_prefix = 'http://dealsbycommunity.com/deal/';
  $blog_timezone = 'UTC';
  $timezone_offset = '+00:00';
  $W3C_datetime_format_php = 'Y-m-d\Th:i:s'; // See http://www.w3.org/TR/NOTE-datetime
  $null_sitemap = '<urlset><url><loc></loc></url></urlset>';
  $lastmod = date("Y-m-d\Th:m:s+00:00");
    $dealsSiteMap = [];   
    $results = $index->browse('');
    $deals = $results;
    $urlCounter = 0;
    foreach ($deals as $deal) {
        $dealId = $deal['objectID'];
        foreach($deal['deal_support_search'] as $key => $dealLocation){
            
            $dealsSiteMap[$urlCounter]['url'] = $url_prefix . $dealId."/".htmlspecialchars(strtolower(trim(slugify($dealLocation))));
            $urlCounter = $urlCounter + 1;     
        }
    }
 
    // retrieve max date
    //$max_date = $posts[0]['date_updated'];
 
  $output = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
  $output .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
  echo $output;
?>
<url>
  <loc>http://dealsbycommunity.com/deals/</loc>
  <changefreq>daily</changefreq>
</url>
<?php for($i = 0; $i < sizeof($dealsSiteMap); $i++) { ?>
<url>
  <loc><?php print $dealsSiteMap[$i]['url'] ?></loc>
</url>
<?php } ?>
</urlset>