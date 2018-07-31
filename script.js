
$( document ).ready(function() {
    console.log( "ready!" );
    
    var client = algoliasearch('WEQ1ZSOQ0G', '7b0cab452409affbc3e9cdd8dd6260e1');
	var index = client.initIndex('deal_search');
	index.setSettings({
	  	searchableAttributes: ['deal_title,deal_description',
                              'deal_url']
	});

	index.setSettings({
	  attributesToRetrieve: ['*']
	});

        function getParameterByName(name, url) {
            if (!url) url = window.location.href;
                name = name.replace(/[\[\]]/g, '\\$&');
            var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
            results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, ' '));  
        }
    
    var query = getParameterByName('query');
    if(query)
        searchDeal(query);   
    else 
        serachDeal('*');
    
    
    

	$('#deal-search-box-submit-btn').click(function(){
		searchDeal($('#deal-search-box').val());
	})
	
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

    function loadDealComments (){
        
        $('#comments-container').comments({
            profilePictureURL: 'http://wfarm2.dataknet.com/static/resources/icons/set108/b5cdab07.png',
            getComments: function(success, error) {
                var commentsArray = [{
                    id: 1,
                    created: '2018-07-27',
                    content: 'This deal works for me. Thanks',
                    fullname: 'Ranjna Jha',
                    upvote_count: 2,
                    user_has_upvoted: false,
                    profile_picture_url:'http://wfarm2.dataknet.com/static/resources/icons/set108/b5cdab07.png'
                },{
                    id: 2,
                    parent:1,
                    created: '2018-07-27',
                    content: 'This deal works for me. Thanks',
                    fullname: 'Ranjna Jha',
                    upvote_count: 2,
                    user_has_upvoted: false,
                    profile_picture_url:'http://wfarm2.dataknet.com/static/resources/icons/set108/b5cdab07.png'
                }];
                    success(commentsArray);
                }
        });    
    }
    

    
	function searchDeal (query){
		
		var dealLoader = '<br><br><div class="loader"></div>';
		$("#deal-container").html(dealLoader);

		setTimeout(function(){
			index.search({
		  		query: query
		  	},
		  	function searchDone(err, content) {

		  		var records = content.hits;
		  		var htmlTemplate = '<br>';
		  		if (records.length > 0){

		  			for (var i = 0; i < records.length; i++) {
		  				
                        if(!records[i].deal_url){
                            records[i].deal_url = ''
                           }
                        
                        if (!records[i].deal_coupon){
                                 records[i].deal_coupon = '';
                        
                            }
                        
                        
		  				htmlTemplate = htmlTemplate + '<!-- A row is a deal --><div class="row deal" ><!-- This is  pic of the poster -->  <div class="col-sm-2 deal-poster-image">      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRErG00hM7WDheP9FCZvZTIWGurbuKLDCAoHAmKKemK2s6vsLjA" width="100%" height="100%">  </div><!-- This is deal portion -->  <div class="col-sm-6">    <!-- This is for showing Verified -->    <div class="row">      <div class="col-sm-4 deal-verification">        <button type="button" class="btn-xs btn-success">verified</button>      </div>    </div>    <!-- This is to show title and Code and share a deal button-->    <div class="row">      <div class="col-sm-8 deal-title">' +        '<a href="#">'+ records[i].deal_title +'</a>      </div>      <div class="col-sm-2 deal-coupon">        <span class="deal-coupon-code">' + records[i].deal_coupon + '</span>      </div>    </div>    <!-- This is to show description --> <div class="row"><div class="col-sm-8">' + '<a href="' + records[i].deal_url + '">' + records[i].deal_url + '</a>' + '</div></div>   <div class="row">      <div class="col-sm-8 deal-description">' +        records[i].deal_description    + '</div>    </div><br><br>    <div class="row">      <div class="col-md-8"> <div id="comments-container"> </div></div>  </div>       </div>    </div>  </div></div><hr>';
		  			};

		  			$("#deal-container").html(htmlTemplate);
                    loadDealComments();
		  		}

		  		else {
		  			var htmlTemplate = '<br> No Deals Found Matching the Search Criteria';
		  			$("#deal-container").html(htmlTemplate);	
		  		}
		  		
		  		}
			);	
		},2000)
		
	}
});
