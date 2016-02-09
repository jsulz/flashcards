jQuery(document).ready(function($) {

	$('#answer').on('click', function(event){
		event.preventDefault();
		$('#mycard').toggleClass('flip');
		if( $('#mycard').hasClass('flip') ) {
			$('#answer a').text("Front");
		} else {
			$('#answer a').text("Answer");
		}
	});

	$('#get-new').one('click', function(event){
		event.preventDefault();
		$('#usercontrols').show();
		$('#get-new a').text('Get Another Card');
	});

});