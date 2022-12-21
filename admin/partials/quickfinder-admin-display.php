<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://webcosmonauts.pl/
 * @since      1.0.0
 *
 * @package    Quickfinder
 * @subpackage Quickfinder/admin/partials
 */
class QuickfinderAdminDisplay {


	public function __construct() {
		add_action( 'admin_menu', array( $this, 'pluginskeleton_menu' ) );

	}

	public function pluginskeleton_menu() {
		add_menu_page( 'Quickfinder', 'Quickfinder', 'manage_options', 'quickfinder.php', array(
			$this,
			'quickfinder_page'
		) );
	}

	public function quickfinder_page() {
		echo 'i am here';
	}

}
