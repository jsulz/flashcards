<?php


class FLASHCARDS_SETTINGS_PAGE  {

	public function __construct() {
		add_action( 'admin_init', array( $this, 'flashcards_settings_init') );
		add_action( 'admin_menu', array( $this, 'flashcards_settings_menu') );
	}

	public function flashcards_settings_menu() {

		add_options_page( 
			'Flashcards Settings', 
			__( 'Flashcards', 'flashcards-text-domain' ), 
			'edit_posts', 
			'flashcards-settings', 
			array( $this, 'flashcards_options_callback')
			);

	}

	public function flashcards_settings_init() {

		//register the settings group and the settings themselves
		register_setting( 'flashcards_settings_group', 'flashcard_settings' );
		//create a settings section - there can be multiple settings sections, just make sure you attribute
		//the settings fields to the sections you want
		add_settings_section( 
			'flashcard-settings-page', 
			__( 'Flashcards', 'flashcards-text-domain'  ), 
			array( $this, 'flashcards_settings_section_callback' ), 
			'flashcards_settings_group' );
		//create the settings fields, associate them with the required settings sections
		add_settings_field( 
			'flashcards-settings-fields', 
			__('Settings for WP REST API Integration', 'flashcards-text-domain' ), 
			array( $this, 'flash_settings_fields_callback' ), 
			'flashcards_settings_group', 
			'flashcard-settings-page' );
		
	}

	public function flashcards_settings_section_callback() {

			echo __('<p>Here be the settings page for the Flashcards Theme! We\'ll keep it nice and light for the time being, but maybe there will be more here later!</p>' . 
				'<p>To use this part of the theme, you\'ll need the Applications Passwords plugin. Follow their instructions on the <a href="https://github.com/georgestephanis/application-passwords">GitHub page for the plugin repo</a> and install the plugin on your site.</p>', 'flashcards-text-domain');


	}

	public function flash_settings_fields_callback() {

		//just to make sure
		if ( !current_user_can( 'manage_options' ) ) {
			$message = __( 'Sorry, you do not have sufficient permissions to edit this page', 'flashcards-text-domain' );
			wp_die( $message );
		}

		$settings = (array) get_option( 'flashcard_settings' );

		if ( isset( $settings[ 'username' ] ) ) {
			$username = esc_attr( $settings[ 'username' ] );
		} else {
			$username ='';
		}

		if ( isset( $settings[ 'app_key' ] ) ) {
			$app_key = esc_attr( $settings[ 'app_key' ] );
		} else {
			$app_key ='';
		}

		?>

		<p>
			<label>Please enter the username associated with your application key.</label>
			<input type="text" name="flashcard_settings[username]" value="<?php echo $username; ?>" />
		</p>
		<p>
			<label>Please enter the application key.</label>
			<input type="text" class="widefat" name="flashcard_settings[app_key]" value="<?php echo $app_key; ?>" />
		</p>

		<?php

	}

	public function flashcards_options_callback() {
		?>
		<div class='wrap'>

			<h2>Flashcards Settings</h2>
			<form action='options.php' method='POST'>
				<?php 

					//output the settings fields using the settings group registered in register_settings
					settings_fields( 'flashcards_settings_group' );

				?>
				<?php 

					//output the settings sections using the options page slug to grab everything
					//can optionally include individual sections here if needed
					do_settings_sections( 'flashcards_settings_group' );

				?>
				<?php 

					//output the submit button for the <form> element
					submit_button( );

				?>
			</form>

		</div>
		<?php
	}

}

?>