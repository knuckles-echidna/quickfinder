<?php

class QuickfinderPostType {

	function __construct() {

		add_action( 'init', array( $this, 'create_post_type' ) );

		if ( is_admin() ) {
			add_action( 'load-post.php', array( $this, 'init_metabox' ) );
			add_action( 'load-post-new.php', array( $this, 'init_metabox' ) );
		}

	}

	public function create_post_type() {

		$name          = 'Quickfinder';
		$singular_name = 'Quickfinder';
		$taxonomy_name = 'quickfinder_category';
		register_post_type(
			strtolower( $name ),
			array(
				'labels'              => array(
					'name'               => _x( $name, 'post type general name' ),
					'singular_name'      => _x( $singular_name, 'post type singular name' ),
					'menu_name'          => _x( $name, 'admin menu' ),
					'name_admin_bar'     => _x( $singular_name, 'add new on admin bar' ),
					'add_new'            => _x( 'Add New', strtolower( $name ) ),
					'add_new_item'       => __( 'Add New ' . $singular_name ),
					'new_item'           => __( 'New ' . $singular_name ),
					'edit_item'          => __( 'Edit ' . $singular_name ),
					'view_item'          => __( 'View ' . $singular_name ),
					'all_items'          => __( 'All ' . $name ),
					'search_items'       => __( 'Search ' . $name ),
					'parent_item_colon'  => __( 'Parent :' . $name ),
					'not_found'          => __( 'No ' . strtolower( $name ) . ' found.' ),
					'not_found_in_trash' => __( 'No ' . strtolower( $name ) . ' found in Trash.' )
				),
				'exclude_from_search' => true,
				'publicly_queryable'  => false,
				'public'              => true,
				'has_archive'         => strtolower( $taxonomy_name ),
				'hierarchical'        => false,
				'rewrite'             => array( 'slug' => $name ),
				'menu_icon'           => 'dashicons-embed-photo',
				'supports'            => [
					'title',
					'editor',
					'revisions'
				]
			)
		);
	}

	/**
	 * Meta box initialization.
	 */
	public function init_metabox() {
		add_action( 'add_meta_boxes', array( $this, 'add_metabox' ) );
		add_action( 'save_post', array( $this, 'save_metabox' ), 10, 2 );
	}

	/**
	 * Adds the meta box.
	 */
	public function add_metabox() {
		add_meta_box(
			'my-meta-box',
			__( 'Shortcode', 'quickfinder' ),
			array( $this, 'render_metabox' ),
			'quickfinder',
			'side',
			'default'
		);

	}

	/**
	 * Renders the meta box.
	 */
	public function render_metabox( $post ) {
		?>
        <input type="text" readonly value="[quickfinder id=<?php echo $post->ID ?>]">
        <p><small><?php _e( 'Use this shortcode for display Quickfinder\'s content ', 'quickfinder' ); ?></small></p>
		<?php
		// Add nonce for security and authentication.
		wp_nonce_field( 'custom_nonce_action', 'custom_nonce' );
	}

	/**
	 * Handles saving the meta box.
	 *
	 * @param int $post_id Post ID.
	 * @param WP_Post $post Post object.
	 *
	 * @return null
	 */
	public function save_metabox( $post_id, $post ) {
		// Add nonce for security and authentication.
		$nonce_name   = isset( $_POST['custom_nonce'] ) ? $_POST['custom_nonce'] : '';
		$nonce_action = 'custom_nonce_action';

		// Check if nonce is valid.
		if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) ) {
			return;
		}

		// Check if user has permissions to save data.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		// Check if not an autosave.
		if ( wp_is_post_autosave( $post_id ) ) {
			return;
		}

		// Check if not a revision.
		if ( wp_is_post_revision( $post_id ) ) {
			return;
		}
	}
}


