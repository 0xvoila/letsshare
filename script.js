
$( document ).ready(function() {
    console.log( "ready!" );

    var client = algoliasearch('WEQ1ZSOQ0G', '470cff3e1d75121fe60a366e81dbd28b');
	var index = client.initIndex('deal_search');
	index.setSettings({
	  	searchableAttributes: ['deal_title,deal_description']
	});


	function searchDeal (query){

		index.search({
		  		query: 'query'
		  	},
		  	function searchDone(err, content) {
		    if (err) throw err;
			
			console.log(content.hits);
		  	}
		);


	}
});
