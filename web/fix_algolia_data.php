<?php

 			require_once('algoliasearch.php');
            $client = new \AlgoliaSearch\Client('WEQ1ZSOQ0G', '385f901dcaf5f9c89672ba880f4b5eab');
            $index = $client->initIndex('deal_search');
            $results = $index->browse('');

            foreach($results as $deal){

            	$rand = rand(1,100);
            	$objectID = $deal['objectID'];
            	$timestamp =  strtotime($deal['deal_submitted_on']);
            	$timestamp = $timestamp + $rand;
            	$array = array( array('objectID' => $objectID,'deal_submitted_on' => $timestamp, 'deal_updated_on' => $timestamp, 'deal_used_on' => $timestamp));
            	$index->partialUpdateObjects($array);
            	
            }
?>