<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://webcosmonauts.pl/
 * @since             1.0.0
 * @package           Quickfinder
 *
 * @wordpress-plugin
 * Plugin Name:       Quickfinder
 * Plugin URI:        https://github.com/knuckles-echidna/quickfinder
 * Description:       Plugin made for quick navigation on website with preselected scenarios
 * Version:           1.0.0
 * Author:            Dmitry [knuckles] Rodionov
 * Author URI:        https://webcosmonauts.pl/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       quickfinder
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'QUICKFINDER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-quickfinder-activator.php
 */
function activate_quickfinder() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-quickfinder-activator.php';
	Quickfinder_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-quickfinder-deactivator.php
 */
function deactivate_quickfinder() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-quickfinder-deactivator.php';
	Quickfinder_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_quickfinder' );
register_deactivation_hook( __FILE__, 'deactivate_quickfinder' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-quickfinder.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_quickfinder() {

	$plugin = new Quickfinder();
	$plugin->run();

}
run_quickfinder();
