<?php


class FLASHCARDS_CUSTOM_META {

	public function __construct() {

		add_action( 'add_meta_boxes', array( $this, 'register_post_meta_box' ) );
		add_action( 'save_post', array( $this, 'save_post_meta_box_values' ) );

	}

	public function register_post_meta_box() {

		add_meta_box( 'flashcards-meta', 'Custom Meta for Flashcards Posts', array( $this, 'post_meta_box_callback' ), 'post', 'normal' );

	}

	public function post_meta_box_callback() {

		global $post;
		$url_val = get_post_meta( $post->ID, 'flashcards_url', true );
		$example_val = get_post_meta( $post->ID, 'flashcards_example', true );
		$param_val = get_post_meta( $post->ID, 'flashcards_parameter', true );

		//sure, ternary operators are great, but I *like* this structure
		if ( isset( $url_val ) ) {
			$url = $url_val;
		} else {
			$url = '';
		}

		if ( isset( $example_val ) ) {
			$example = $example_val;
		} else {
			$example = '';
		}

		if ( isset( $param_val ) ) {
			$params = $param_val;
		} else {
			$params = '';
		}

		//set the nonce field
		wp_nonce_field( 'post_meta_box_nonce', 'post_meta_box' );

		?>
			<p>Place the URL of the resource for this card.</p>
			<input type="text" class="widefat" name="flashcards_url" placeholder="Add a URL to a Resource" value="<?php echo $url ?>"/>
			<p>Enter all of the parameters along with the function call itself.</p>
			<input type="text" class="widefat" name="flashcards_parameter" placeholder="Provide the function and it's parameters" value="<?php echo $param_val ?>"/>
			<p>Provide a short example</p>
		<?php

		wp_editor( $example_val, 'flashcards_example', array(
    		'wpautop'       => true,
    		'media_buttons' => false,
    		'textarea_name' => 'flashcards_example',
    		'textarea_rows' => 10,
    		'teeny'         => false
		) );

	}

	public function save_post_meta_box_values( $post_id ) {
		// Bail if we're doing an auto save
	    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return false; }
	     
	    // if our nonce isn't there, or we can't verify it, bail
	    if( !isset( $_POST['post_meta_box'] ) || !wp_verify_nonce( $_POST['post_meta_box'], 'post_meta_box_nonce' ) ) { return false; }
	    
	    // Make sure your data is set before trying to save it
	    if( isset( $_POST['post_meta_box'] ) ) {
	        update_post_meta( $post_id, 'flashcards_url', wp_kses( $_POST['flashcards_url'] ) );
	        update_post_meta( $post_id, 'flashcards_example', wp_kses( $_POST['flashcards_example'] ) );
	        update_post_meta( $post_id, 'flashcards_parameter',  $_POST['flashcards_parameter'] );
	    }

	}


}