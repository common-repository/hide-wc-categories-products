<?php

/**
 * Fired during plugin activation
 *
 * @link       https://profiles.wordpress.org/vijayrathod245
 * @since      1.0.0
 *
 * @package    Hiding_WC_Products_Terms
 * @subpackage Hiding_WC_Products_Terms/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Hiding_WC_Products_Terms
 * @subpackage Hiding_WC_Products_Terms/includes
 * @author     Vijay Rathod <vijayrathod245@gmail.com>
 */
class Hiding_WC_Products_Terms_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		$category_data = array(
            'uncategorized'
        );
        update_option( 'hide_wc_products_terms_list', $category_data );
		
		$category_data_set_value = 'yes';
        update_option( 'hwpt_submit_category_settings_data', $category_data_set_value ); 
	}

}
