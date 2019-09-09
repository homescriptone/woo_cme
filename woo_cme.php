<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              #
 * @since             1.0.0
 * @package           Woo_cme
 *
 * @wordpress-plugin
 * Plugin Name:       WooCommerce MyAccount Editor
 * Plugin URI:        #
 * Description:       Exclusively made for the whatsapp shop.
 * Version:           1.0.0
 * Author:            HomeScript
 * Author URI:        #
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woo_cme
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
define( 'WOO_CME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woo_cme-activator.php
 */
function activate_woo_cme() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo_cme-activator.php';
	Woo_cme_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woo_cme-deactivator.php
 */
function deactivate_woo_cme() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo_cme-deactivator.php';
	Woo_cme_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_woo_cme' );
register_deactivation_hook( __FILE__, 'deactivate_woo_cme' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woo_cme.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woo_cme() {

	$plugin = new Woo_cme();
	$plugin->run();

}
run_woo_cme();
