var posts_mockup = [
	{ ID: 1, title: "append()", link: 'http://example.com/1/', content: 'Define append', categories: 'JavaScript', tags: 'Object' },
	{ ID: 484, title: "include()", link: 'http://example.com/2/', content: 'Define include', categories: 'PHP', tags: 'Function' },
	{ ID: 343, title: "wp_head", link: 'http://example.com/3/', content: 'Define wp_head', categories: 'WordPress', tags:  'Action' },
	{ ID: 39, title: "background", link: 'http://example.com/4/', content: 'Define background', categories: 'CSS', tags: 'Property' },
	{ ID: 3434, title: "ajax()", link: 'http://example.com/5/', content: 'Define ajax()', categories: 'jQuery', tags: 'Function' },
];

var $el;
var posts = {};

function getPostsFromServer(  ) {
	// TODO: AJAX get posts from server
	
	posts = posts_mockup;

}

function getRandomPost() {
	var post = posts[ Math.floor( Math.random() * posts.length ) ];
	return post;
}

jQuery(document).ready(function($){

	$el = $('card-content');

	$('#get-new').on('click', function(){
		getPostsFromServer();
		post = getRandomPost();
		console.log(post['categories']);
		$('.language').text(post['categories']);
		$('.context').text(post['tags']);
		$('.title').text(post['title']);
		$('.post').text(post['content']);
	});

});