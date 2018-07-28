
$( document ).ready(function() {
    console.log( "ready!" );

    var client = algoliasearch('WEQ1ZSOQ0G', '7b0cab452409affbc3e9cdd8dd6260e1');
	var index = client.initIndex('deal_search');
	index.setSettings({
	  	searchableAttributes: ['deal_title,deal_description']
	});

	$('#deal-search').keyup(function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
    	if(keycode == '13'){
        	searchDeal($('#deal-search').val());
    	}
	});

	function searchDeal (query){
	
		index.search({
		  		query: query
		  	},
		  	function searchDone(err, content) {

		  		var records = content.hits;
		  		var searchResults = [];
		  		for (var i = 0; i < records.length; i++) {
		  			searchResults.push(records[i].objectID);
		  		};
		   		console.log(searchResults);
		  	}
		);
	}
});
