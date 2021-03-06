
$( document ).ready(function() {
    console.log( "ready!" );
    var client = algoliasearch('WEQ1ZSOQ0G', '7b0cab452409affbc3e9cdd8dd6260e1');
	var index = client.initIndex('deal_search');
	
    $('.deal').each(function() {
        loadDealComments(this);
    });
    

    
	$('#deal-search-box-submit-btn').click(function(){
        page = 0;
		searchDeal($('#deal-search-box').val(),page);
	})
    
    $('.share').each(function() {
        attachShareOptionsThisDeal(this);
    });
    
    function loadPagination(elem, query , nbPages){
        console.log("loading for " + query + ' pages ' + nbPages);
        var html = '<h2>Explore More Deals</h2><ul class="pagination">';
            if(!query){
                query='';
            }
            for(var i=1;i<nbPages ;i++){
                console.log("I am here");
                pageCount = i;
                html = html + '<li><a href="http://dealsbycommunity.com?q=' + query  +  '&page=' . pageCount +'">' +  i +'</a></li>' ;
            }
                html = html + '</ul>';

            console.log(html);
            elem.html(html);
    }



    function attachShareOptionsThisDeal(elem){
        
        	$(elem).jsSocials({   
                  // An array of share networking services
                  shares: ["whatsapp", "facebook"],
                  url: $(elem).attr("deal-url"),
                  text: $(elem).attr("deal-title"),
                  showLabel: true,
                  showCount: false,
                  on: {
                    click: function(e) {
                        if(this.share === "whatsapp") {
                            console.log("tweet \"" + this.url + "\" at " + e.timeStamp);
                        }
                    }
                }    

        });
    }


    
	$('#deal-search-box').keyup(function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
    	if(keycode == '13'){
    		$(this).blur();
        	searchDeal($('#deal-search-box').val(),0);
    	}

    	if($('#deal-search-box').val() == ''){
    		searchDeal('*',0);	
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
    
    
	function searchDeal (query,page){
		
        amplitude.getInstance().logEvent("deal-search",{"deal-search-query": query});
		var dealLoader = '<br><br><div class="loader"></div>';
		$("#deal-container").html(dealLoader);

		setTimeout(function(){
			index.search({
		  		query: query,
                page : page,
                hitsPerPage:6
		  	},
		  	function searchDone(err, content) {

		  		var records = content.hits;
                var nbPages = content.nbPages;
		  		var htmlTemplate = '<br>';
		  		if (records.length > 0){

		  			for (var i = 0; i < records.length; i++) {
		  				
                        if(!records[i].deal_url){
                            records[i].deal_url = ''
                           }
                        
                        if (!records[i].deal_coupon){
                                 records[i].deal_coupon = '';
                        
                            }
                        
                        var dealURL = 'http://dealsbycommunity.com/deal/' + records[i].objectID + '/' + records[i].deal_slug;
                        
		  				htmlTemplate = htmlTemplate + '<!-- A row is a deal --><div id=' + records[i].objectID + ' class="row deal" ><!-- This is  pic of the poster -->  <div class="col-sm-2 deal-poster-image">      <img src="http://wfarm2.dataknet.com/static/resources/icons/set108/b5cdab07.png" width="100%" height="100%">  </div><!-- This is deal portion -->  <div class="col-sm-10"> <!-- This is to show title and Code and share a deal button-->    <div class="row">      <div class="col-sm-8 deal-title"><button type="button" class="btn-xs btn-success">verified</button>' +        '<h3><a href="'+ dealURL +'">'+ records[i].deal_title +'</a></h3>      </div>      <div class="col-sm-2 deal-coupon">        <span class="deal-coupon-code">' + records[i].deal_coupon + '</span>      </div>    </div>    <!-- This is to show description --> <div class="row"><div class="col-sm-8">' + '<a href="' + records[i].deal_url + '" target="_blank">' + records[i].deal_url + '</a>' + '</div></div> <div class="row"><div class="col-sm-8"><img src="'+ records[i].deal_image_url +'" class="img-responsive"></div></div>  <div class="row">      <div class="col-sm-8 deal-description">' +        records[i].deal_description    + '</div>    </div> <div class="row"><div class="share"  deal-title="' + records[i]["deal_title"] + '" deal-url="' + dealURL +'" class="col-sm-4"></div></div><br><br>    <div class="row">      <div class="col-md-8"> <div id="comments-container"> </div></div>  </div>       </div>    </div><hr>';
		  			};

		  			$("#deal-container").html(htmlTemplate);
                    $('.deal').each(function() {
                        loadDealComments(this);
                    });
                    $('.share').each(function() {
                        attachShareOptionsThisDeal(this);
                    });

                    loadPagination($('#deal-pagination-bar'),query, nbPages);
		  		}

		  		else {
		  			var htmlTemplate = '<br> No Deals Found Matching the Search Criteria';
		  			$("#deal-container").html(htmlTemplate);	
                    loadPagination($('#deal-pagination-bar'),query, nbPages);
		  		}
		  		
		  		}
			);	
		},500)
		
	}
});

