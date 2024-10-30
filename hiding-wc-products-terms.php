<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://profiles.wordpress.org/vijayrathod245/
 * @since             1.0.0
 * @package           Hiding_WC_Products_Terms
 *
 * @wordpress-plugin
 * Plugin Name:       Hiding WC Products & Terms
 * Plugin URI:        https://wordpress.org/plugins/hiding-wc-products-terms/
 * Description:       The plugin allows you to hide products from a specific category on the woocommerce store.
 * Version:           1.0.1
 * Author:            Vijay Rathod
 * Author URI:        https://profiles.wordpress.org/vijayrathod245/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       hiding-wc-products-terms
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
define( 'HWPT_VERSION', '1.0.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-hiding-wc-products-terms-activator.php
 */
function activate_hiding_wc_products_terms() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-hiding-wc-products-terms-activator.php';
	Hiding_WC_Products_Terms_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-hiding-wc-products-terms-deactivator.php
 */
function deactivate_hiding_wc_products_terms() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-hiding-wc-products-terms-deactivator.php';
	Hiding_WC_Products_Terms_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_hiding_wc_products_terms' );
register_deactivation_hook( __FILE__, 'deactivate_hiding_wc_products_terms' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-hiding-wc-products-terms.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_hiding_wc_products_terms() {

	$plugin = new Hiding_WC_Products_Terms();
	$plugin->run();

}
run_hiding_wc_products_terms();
