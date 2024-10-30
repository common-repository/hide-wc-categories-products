<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://profiles.wordpress.org/vijayrathod245
 * @since      1.0.0
 *
 * @package    Hiding_WC_Products_Terms
 * @subpackage Hiding_WC_Products_Terms/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Hiding_WC_Products_Terms
 * @subpackage Hiding_WC_Products_Terms/includes
 * @author     Vijay Rathod <vijayrathod245@gmail.com>
 */
class Hiding_WC_Products_Terms_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'hiding-wc-products-terms',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
