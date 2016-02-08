<?php

function register_flashcards_functions() {

	return new FLASHCARDS_FUNCTIONS();

}

add_action('init', 'register_flashcards_functions' );

class FLASHCARDS_FUNCTIONS {

	public function __construct() {

		$this->define_file_paths();
		$this->require_files();
		add_action( 'wp_enqueue_scripts', array( $this, 'load_flashcards_scripts' ) );
		add_action( 'rest_api_init', array( $this, 'adding_fields_to_rest' ) );
		new FLASHCARDS_CUSTOM_META();

	}

	public function define_file_paths() {

		define( 'ADMIN_FOLDER', get_template_directory() . '/admin/');
		define( 'THEME_SETTINGS', ADMIN_FOLDER . 'theme_settings.php');
		define( 'THEME_CUSTOM_META', ADMIN_FOLDER . 'theme_custom_fields.php');

	}

	public function require_files() {

		require( THEME_SETTINGS );
		require( THEME_CUSTOM_META );

	}

	public function adding_fields_to_rest() {

		register_rest_field('post', 'flashcards_url', array(
				'get_callback' => array( $this, 'adding_fields_callback'),
				'update_callback' => null,
				'schema' 	=> null
			));

		register_rest_field('post', 'flashcards_example', array(
				'get_callback' => array( $this, 'adding_fields_callback'),
				'update_callback' => null,
				'schema' 	=> null
			));

		register_rest_field('post', 'flashcards_parameter', array(
				'get_callback' => array( $this, 'adding_fields_callback'),
				'update_callback' => null,
				'schema' 	=> null
			));
	}

	public function adding_fields_callback(  $object, $field_name, $request ) {

		return get_post_meta( $object['id'], $field_name, true );

	}

	public function load_flashcards_scripts() {

		wp_enqueue_script( 'front-end', get_template_directory_uri() . '/js/ui.js', array('jquery'), '.1', true );
		wp_enqueue_script( 'app', get_template_directory_uri() . '/js/app.js', array('jquery', 'underscore'), '.1', true );
		wp_enqueue_style( 'main-theme-styles', get_stylesheet_uri() );

		wp_localize_script( 'app', 'wpInfo', 			

			array(
				
				'api_url'			 => rest_url() . 'wp/v2/posts',
				'template_directory' => get_template_directory_uri() . '/',
				'nonce'				 => wp_create_nonce( 'wp_rest' ),
				
			) );

	}


}

?>