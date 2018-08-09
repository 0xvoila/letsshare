<?php

    require_once('algoliasearch.php');
	$client = new \AlgoliaSearch\Client('WEQ1ZSOQ0G', '385f901dcaf5f9c89672ba880f4b5eab');
	$index = $client->initIndex('deal_search');
    $results = $index->browse('');
    
    $count = 0;
    foreach($results as $deal){
        var_dump($deal);
        if(!array_key_exists("deal_image_url",$deal)){
            
            $ch = curl_init("https://fir-store-9c275.appspot.com/?url=" . $deal["deal_url"]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $dealImageURL = curl_exec($ch);
            curl_close($ch);
            $index->partialUpdateObject(array("objectID" => $deal["objectID"] , "deal_image_url" => $dealImageURL));
        }
    }
    
    

?>