
$( document ).ready(function() {
    console.log( "ready!" );
    var client = algoliasearch('WEQ1ZSOQ0G', '7b0cab452409affbc3e9cdd8dd6260e1');
	var index = client.initIndex('deal_search');
	
    $('.deal').each(function() {
        loadDealComments(this);
    });
    

    
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

    function loadDealComments (deal){
        element = '#' + deal.id + ' ' + '#' + 'comment-container';
        $('#' + deal.id + ' ' + '#' + 'comments-container').comments({
            enableEditing: false,
            enableUpvoting: false,
            enableDeleting: false,
            postCommentOnEnter: true,
            getComments: function(success, error) {
                profilePictureURL: 'http://wfarm2.dataknet.com/static/resources/icons/set108/b5cdab07.png',
                $.ajax({
                    type: 'get',
                    headers: {"X-Algolia-API-Key": "7b0cab452409affbc3e9cdd8dd6260e1", "X-Algolia-Application-Id" :"WEQ1ZSOQ0G" },
                    url: 'https://WEQ1ZSOQ0G.algolia.net/1/indexes/deal_search/' + deal.id + '?attributes=*',
                    success: function(dealObject) {
                        success(dealObject.comments)
                    },
                    error: error
                });
            },
             postComment: function(commentJSON, success, error) {
                 commentJSON.fullname = $.cookie("displayName");
                 commentJSON.profile_picture_url = $.cookie("profilePicURL");
                 commentJSON.created_by_current_user = false;
                 requestData = {"comments": {"_operation": "Add","value": commentJSON }};
                $.ajax({
                    type: 'post',
                    headers: {"X-Algolia-API-Key": "385f901dcaf5f9c89672ba880f4b5eab", "X-Algolia-Application-Id" :"WEQ1ZSOQ0G" },
                    url: 'https://WEQ1ZSOQ0G.algolia.net/1/indexes/deal_search/' + deal.id + '/partial',
                    data: JSON.stringify(requestData),
                    success: function(comment) {
                        success(commentJSON)
                },
                        error: error
              });
            }
        });    
    }
    
    
	function searchDeal (query){
		
        amplitude.getInstance().logEvent("deal-search",{"deal-search-query": query});
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
                        
                        
		  				htmlTemplate = htmlTemplate + '<!-- A row is a deal --><div id=' + records[i].objectID + ' class="row deal" ><!-- This is  pic of the poster -->  <div class="col-sm-2 deal-poster-image">      <img src="http://wfarm2.dataknet.com/static/resources/icons/set108/b5cdab07.png" width="100%" height="100%">  </div><!-- This is deal portion -->  <div class="col-sm-10"> <!-- This is to show title and Code and share a deal button-->    <div class="row">      <div class="col-sm-8 deal-title"><button type="button" class="btn-xs btn-success">verified</button>' +        '<h3><a href="#">'+ records[i].deal_title +'</a></h3>      </div>      <div class="col-sm-2 deal-coupon">        <span class="deal-coupon-code">' + records[i].deal_coupon + '</span>      </div>    </div>    <!-- This is to show description --> <div class="row"><div class="col-sm-8">' + '<a href="' + records[i].deal_url + '">' + records[i].deal_url + '</a>' + '</div></div>   <div class="row">      <div class="col-sm-8 deal-description">' +        records[i].deal_description    + '</div>    </div><br><br>    <div class="row">      <div class="col-md-8"> <div id="comments-container"> </div></div>  </div>       </div>    </div><hr>';
		  			};

		  			$("#deal-container").html(htmlTemplate);
                    $('.deal').each(function() {
                        loadDealComments(this);
                    });
		  		}

		  		else {
		  			var htmlTemplate = '<br> No Deals Found Matching the Search Criteria';
		  			$("#deal-container").html(htmlTemplate);	
		  		}
		  		
		  		}
			);	
		},500)
		
	}
});
