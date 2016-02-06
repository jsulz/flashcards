jQuery(document).ready( function($) {
	console.log('hi');
	$('#answer').on('click', function(event){
		event.preventDefault();
		$('#mycard').toggleClass('flip');
		//$(this).removeClass('card-container');
	});

	$('#get-new').one('click', function(event){
		event.preventDefault();
		$('#usercontrols').show();
		$('#get-new a').text('Get Another Card');
	});

});