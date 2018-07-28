
$( document ).ready(function() {
    console.log( "ready!" );

    var client = algoliasearch('WEQ1ZSOQ0G', '7b0cab452409affbc3e9cdd8dd6260e1');
	var index = client.initIndex('deal_search');
	index.setSettings({
	  	searchableAttributes: ['deal_title,deal_description']
	});

	index.setSettings({
	  attributesToRetrieve: ['*']
	});

	searchDeal('*');

	
	$('#deal-search-box').keyup(function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
    	if(keycode == '13'){
    		$(this).blur();
        	searchDeal($('#deal-search-box').val());
    	}

    	if($('#deal-search-box').val() == ''){
    		searchDeal('*');	
    	}
	});

	function searchDeal (query){
	
		index.search({
		  		query: query
		  	},
		  	function searchDone(err, content) {

		  		var records = content.hits;
		  		var htmlTemplate = '<hr>';
		  		for (var i = 0; i < records.length; i++) {
		  			console.log(records[i]);
		  			htmlTemplate = htmlTemplate + '<!-- A row is a deal --><div class="row deal" ><!-- This is  pic of the poster -->  <div class="col-sm-2 deal-poster-image">      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRErG00hM7WDheP9FCZvZTIWGurbuKLDCAoHAmKKemK2s6vsLjA" width="100%" height="100%">  </div><!-- This is deal portion -->  <div class="col-sm-6">    <!-- This is for showing Verified -->    <div class="row">      <div class="col-sm-4 deal-verification">        <button type="button" class="btn-xs btn-success">verified</button>      </div>    </div>    <!-- This is to show title and Code and share a deal button-->    <div class="row">      <div class="col-sm-8 deal-title">' +        '<a href="#">'+ records[i].deal_title +'</a>      </div>      <div class="col-sm-2 deal-coupon">        <span >' + records[i].deal_coupon + '</span>      </div>    </div>    <!-- This is to show description -->    <div class="row">      <div class="col-sm-8 deal-description">' +        records[i].deal_description    + '</div>    </div>    <div class="row">      <div class="col-md-8">              <!-- Here comments section will come -->        </div>    </div>  </div></div><hr>';
		  		};

		  		$("#deal-container").html(htmlTemplate);
		  	}
		);
	}
});
