<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://webcosmonauts.pl/
 * @since      1.0.0
 *
 * @package    Quickfinder
 * @subpackage Quickfinder/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Quickfinder
 * @subpackage Quickfinder/includes
 * @author     Dmitry [knuckles] Rodionov <info@webcosmonauts.pl>
 */
class Quickfinder_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'quickfinder',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
