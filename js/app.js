var $el;
var posts = {};

function getPostsFromServer( callback ) {
	// TODO: AJAX get posts from server
	doAjax( wpInfo.api_url, {} )
		.done( function( data ) {
			posts = data;
		} );

}

function getRandomPost() {
	var post = posts[ Math.floor( Math.random() * posts.length ) ];
	return post;
}

function doAjax( endpoint, data ) {
	return jQuery.ajax( {
		url: endpoint,
		dataType: 'json',
		data: data
	} );
}

jQuery(document).ready(function($){

	$el = $('card-content');

	getPostsFromServer( setpostdata );

	$('#get-new').on('click', function(event) {
		setpostdata(event);
	});

	function setpostdata () {
		checkCardStatus();
		post = getRandomPost();
		console.log(post);
		//$('.title').text(post['title'].rendered);
		//$('.post').html(post['content'].rendered);
		//$('.link a').attr('href', post['flashcards_url']);
		getMoreInfo(post, {});
	}

	function getMoreInfo( singlepost, data ) {
		$.get( wpInfo.api_url + '/?filter[name]=' + singlepost['slug'] + '&_embed', function( data ) {
			singlepost = data[0];
			$('.title').text(post['title'].rendered);
			$('.post').html(post['content'].rendered);
			$('.link a').attr('href', post['flashcards_url']);
		});
	}

	function checkCardStatus() {

		if ( $('#mycard').hasClass('flip') ) {
			$('#mycard').toggleClass('flip');
		}

	}

});