<?php

function load_flashcards_scripts() {

		wp_enqueue_script( 'front-end', get_template_directory_uri() . '/js/ui.js', array('jquery'), '.1', true );
		wp_enqueue_script( 'app', get_template_directory_uri() . '/js/app.js', array('jquery'), '.1', true );
		wp_enqueue_style( 'main-theme-styles', get_stylesheet_uri() );

		wp_localize_script( 'app', 'wpInfo', 			

			array(
				
				'api_url'			 => rest_url() . 'wp/v2/posts',
				'template_directory' => get_template_directory_uri() . '/',
				'nonce'				 => wp_create_nonce( 'wp_rest' ),
				
			) );

}

add_action( 'wp_enqueue_scripts', 'load_flashcards_scripts');

?>