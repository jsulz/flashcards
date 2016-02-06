<?php

function register_flashcards_functions() {

	return new FLASHCARDS_FUNCTIONS();

}

add_action('init', 'register_flashcards_functions' );

class FLASHCARDS_FUNCTIONS {

	public function __construct() {

		add_action( 'add_meta_boxes', array( $this, 'register_post_meta_box' ) );
		add_action( 'save_post', array( $this, 'save_post_meta_box_values' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'load_flashcards_scripts' ) );

	}

	public function register_post_meta_box() {

		add_meta_box( 'flashcards-url', 'A URL For Post Resource', array( $this, 'post_meta_box_callback' ), 'post', 'normal' );

	}

	public function post_meta_box_callback() {

		global $post;

		$urlval = get_post_meta( $post->ID, 'flashcards_url', true );

		//sure, ternary operators are great, but I *like* this structure
		if ( isset( $urlval['flashcards_url'] ) ) {
			$url = $urlval;
		} else {
			$url = '';
		}

		//set the nonce field
		wp_nonce_field( 'post_meta_box_nonce', 'post_meta_box' );

		?>
			<p>This is the content that will appear in the post meta box.</p>
			<input type="text" class="widefat" name="flashcards_url" placeholder="Here are some settings" value="<?php echo $url[0] ?>"/>

		<?php

	}

	public function save_post_meta_box_values( $post_id ) {

		// Bail if we're doing an auto save
	    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return false; }
	     
	    // if our nonce isn't there, or we can't verify it, bail
	    if( !isset( $_POST['post_meta_box'] ) || !wp_verify_nonce( $_POST['post_meta_box'], 'post_meta_box_nonce' ) ) { return false; }
	    
	    // Make sure your data is set before trying to save it
	    if( isset( $_POST['post_meta_box'] ) )
	        update_post_meta( $post_id, 'flashcards_url', wp_kses( $_POST['flashcards_url'] ) );

	}

	public function load_flashcards_scripts() {

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


}

?>