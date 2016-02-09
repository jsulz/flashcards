var $el;
var posts = {};
var cleanedPosts = [];

//get the posts from the server and load them into the posts var
function getPostsFromServer( ) {
	doAjax( wpInfo.api_url, {} )
		.done( function( data ) {
			posts = data;

			//now remove the posts we don't want
			removeUnwanted();
		} );

}

function filtering( checkingposts ) {
	return jQuery.inArray( 1, checkingposts.categories);
}

function removeUnwanted() {
	for (var key in posts) {
		cleanedPosts = posts.filter(filtering, key);
	}
}

//after loading all of the post objects into the posts var, grab a random post from the stack and return it
function getRandomPost() {
	var post = cleanedPosts[ Math.floor( Math.random() * cleanedPosts.length ) ];
	return post;
}

//go and get the posts!
function doAjax( endpoint, data ) {
	return jQuery.ajax( {
		url: endpoint,
		dataType: 'json',
		data: data
	} );
}

(function($, _, undefined){

	$el = $('card-content');

	var post;
	$el = $( '#js-data' );

	//get all of the posts from the server
	getPostsFromServer( );

	//each time we click on the "Get Another Card" Button, make a call to setPostData
	$('#get-new').on('click', function(event) {
		//don't really need to pass along the event object, but will anyway just in case!
		setPostData(event);
	});

	//only happens when the post var is set because this button is hidden by default and requires interaction with the get-new button to be seen
	$('#remove').on( 'click', function(event) {
		removeFromStack(event);
	});

	function setPostData () {

		$('.title').text('');
		$('.category').text('');
		$('.tag').text('');
		$('.ajax-loader').show();

		//check to see whether or not the card is currently showing the "back", if it is, flip it, otherwise you're good!
		checkCardStatus();

		//get a random post from the stack of posts we got by calling to getPostsFromServer
		post = getRandomPost();

		//take the post from the above call and use another API call to drill down and get some more data
		getMoreInfo(post, {});

	}

	function getMoreInfo( singlepost, data ) {

		//take the post data from our randomly generated post and build a new API call
		$.get( wpInfo.api_url + '/?filter[name]=' + singlepost['slug'] + '&_embed', function( data ) {
			singlepost = data[0];
			console.log(singlepost);

				template = _.template( $( '#post-tmpl' ).html(), singlepost );

			$el.html( template );

			//render the content
			$('.ajax-loader').hide();
			$('.accordion').on('click', '.accordion-button', function(event){
				event.preventDefault();
				$(this).next('.accordion-content').not(':animated').slideToggle('fast');
				$(this).next('.accordion-content').siblings('.accordion-content').slideUp('fast');
			});
		});
	}

	//check to see if the "card" is currently flipped, if it is, we'll want to flip it back
	function checkCardStatus() {

		if ( $('#mycard').hasClass('flip') ) {
			$('#mycard').toggleClass('flip');
		}

	}

	function removeFromStack(event) {
		console.log(event);
		clean = cleanedPosts.indexOf( post );
		cleanedPosts.splice(clean, 1);
		removeToDeleted( post );
		setPostData();

	}

	function removeToDeleted( currentpost ) {
		$.ajax({
			type: "POST",
			beforeSend: function(xhr) {
				xhr.setRequestHeader( 'Authorization', 'Basic ' + 'amFyZWQ6RkI2ciBPbFdsIGV4cEMgeEY4MA==');
			},
			url: wpInfo.api_url + '/' + currentpost.id + '?' + 'categories[]=1',
		});
	}

})(jQuery, _);