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
	console.log(checkingposts);
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

jQuery(document).ready(function($){

	$el = $('card-content');

	//get all of the posts from the server
	getPostsFromServer( );

	//each time we click on the "Get Another Card" Button, make a call to setPostData
	$('#get-new').on('click', function(event) {
		//don't really need to pass along the event object, but will anyway just in case!
		setPostData(event);
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

			//render the content
			$('.title').text(singlepost['title'].rendered);
			$('.post').html(singlepost['content'].rendered);
			$('.category').text(singlepost['_embedded']['https://api.w.org/term'][0][0]['name']);
			$('.tag').text(singlepost['_embedded']['https://api.w.org/term'][1][0]['name']);
			$('.ajax-loader').hide();
		});
	}

	//check to see if the "card" is currently flipped, if it is, we'll want to flip it back
	function checkCardStatus() {

		if ( $('#mycard').hasClass('flip') ) {
			$('#mycard').toggleClass('flip');
		}

	}

	function removeFromStack() {
		//when the remove from stack button is clicked
		//go back to the server and place the post in a category that declares this is "done"
		//we don't want to have to make another call for all the posts though
		//so just remove the post from what basically amounts to the local cache - the cleanedposts array
	}

});