<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://profiles.wordpress.org/vijayrathod245/
 * @since      1.0.0
 *
 * @package    Hiding_WC_Products_Terms
 * @subpackage Hiding_WC_Products_Terms/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Hiding_WC_Products_Terms
 * @subpackage Hiding_WC_Products_Terms/admin
 * @author     Vijay Rathod <vijayrathod245@gmail.com>
 */
class Hiding_WC_Products_Terms_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Hiding_WC_Products_Terms_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Hiding_WC_Products_Terms_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/hiding-wc-products-terms-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Hiding_WC_Products_Terms_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Hiding_WC_Products_Terms_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/hiding-wc-products-terms-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'hiding-wc-products-terms-chosen-cdn', plugin_dir_url( __FILE__ ) . 'js/hiding-wc-products-terms-chosen-cdn.js', array( 'jquery' ), $this->version, false );

	}

		/**
		* Create admin side hide wc categoriess & products main page
		* 
		* @since  1.0.0
		*/
		function hwpt_menu_page() {
			/* Required woocommerce */
			if (!defined('WC_VERSION')) { ?>
				<div class="error">
					<p>
						<strong><?php echo esc_html__('Hiding WC Products & Terms', 'hiding-wc-products-terms'); ?></strong> 
						<?php echo esc_html__('plugin not working because you need to install the WooCommerce plugin.', 'hiding-wc-products-terms') ?>
					</p>
				</div>
			<?php }else{
				add_menu_page(
				__( 'HWPT', 'hiding-wc-products-terms' ),
				__( 'HWPT', 'hiding-wc-products-terms' ),
				'manage_options',
				'hwpt-page',
				array( $this, 'hide_wc_products_terms' ) ,'dashicons-hidden');

				/* Register the Hide WC Categories Products sub page for the admin area. */
				add_submenu_page(
					'hwpt-page',
					__( 'Settings', 'hiding-wc-products-terms' ),
					__( 'Settings', 'hiding-wc-products-terms' ),
					'manage_options',
					'hwpt-sub-page',
					array( $this, 'hide_wc_products_terms_sub_settings_page' ));
			}
		}


	/**
	 * Render the  Hide WC Categories Products Main page function for plugin
	 *
	 * @since  1.0.0
	 */
	public function hide_wc_products_terms() {
		include_once 'partials/hiding-wc-products-terms-admin-display.php';
	}

	/**
	 * Render the Hide WC Categories Products sub page function for plugin
	 *
	 * @since  1.0.0
	 */
	public function hide_wc_products_terms_sub_settings_page() {
		if( ! current_user_can( 'manage_options' ) ){
				return;
		}
		if(isset( $_GET['hwpt_submit_category_settings_save'] )){
			add_settings_error( 'hide_cat_options', 'hide_cat_message', esc_html__( 'Settings Saved', 'hiding-wc-products-terms' ), 'success' );
		}
		settings_errors('hide_cat_options');
		include_once 'partials/hiding-wc-products-terms-select-option-settings-page-admin-display.php';
	}

	/**
	 * Get product category list
	 *
	 * @since  1.0.0
	 */
	public function hwpt_list() {
			
		$category_args = array(
			'taxonomy'     => 'product_cat',
			'orderby'      => 'name',
			'show_count'   => 0,
			'pad_counts'   => 0,
			'hierarchical' => 1,
			'title_li'     => '',
			'hide_empty'   => 0
		);
			
		$all_categories = get_categories($category_args);
		
		foreach($all_categories as $key => $category_data){
			$array_category[$key]['name'] =  $category_data->name;
			$array_category[$key]['slug'] =  $category_data->slug;
		}
			
		return $array_category;	
	}

	/*
	** Save the category name.
	*/
	public function hwpt_multi_select_save_submit_data(){
		if(isset($_POST['hwpt_multi_select_save_submit'])){
			$category_data = isset($_POST['multi_select_category']) ? $_POST['multi_select_category'] : [];
			//var_dump($category_data);
			$cat_multi_select_data_values = array_values($category_data);

			//if(is_array($cat_multi_select_data_values)){
				$multi_select_category_data_array = array_map('sanitize_text_field', $cat_multi_select_data_values);
			//}
			$multi_select_get_option_values = get_option( 'hide_wc_products_terms_list');
			update_option( 'hide_wc_products_terms_list', $category_data, '', 'yes');	
			if(!$multi_select_get_option_values){
				add_option( 'hide_wc_products_terms_list', $category_data, '', 'yes' );	
			}
		}
	}

	/*
	** Save the category checkbox data.
	*/
	public function hwpt_check_box_save_submit_data(){
		if(isset($_POST['hwpt_save_checkbox_value'])){
			$category_data_chk = isset($_POST['check_box_category']) ? $_POST['check_box_category'] : [];
			$cat_check_box_data_values = array_values($category_data_chk);
			$category_data_array = array_map('sanitize_text_field', $cat_check_box_data_values);
			$check_box_get_option_values = get_option( 'hide_wc_products_terms_list');
			update_option( 'hide_wc_products_terms_list', $category_data_chk, '', 'yes');	
			if(!$check_box_get_option_values){
				add_option( 'hide_wc_products_terms_list', $category_data_chk, '', 'yes' );	
			}
		}
	}

	/*
	** Hide category product
	*/
	function hwpt_custom_pre_get_posts_query($data) {
		$tax_query = (array) $data->get( 'tax_query' );
		$select_values = get_option('hide_wc_products_terms_list');
		$tax_query[] = array(
			'taxonomy' => 'product_cat',
			'field' => 'slug',
			'terms' => $select_values,
			'operator' => 'NOT IN'
		);
		$data->set( 'tax_query', $tax_query );
	}

	/**
	 * Create link on plugin page for hide wc categories products plugin settings
	 */
	public function hwpt_add_plugin_hide_wc_products_terms_settings_link($links){
		$settings_link = '<a href="admin.php?page=hwpt-sub-page">' . __('Settings') . '</a>';
		array_push($links, $settings_link);
		return $links;
	}

	/*
	** Save the category options data.
	*/
	 public function hwpt_submit_category_settings_save_data(){
		if(isset($_POST['hwpt_submit_category_settings_save'])){
			$category_settings_data = sanitize_text_field($_POST['select_hwpt_category']);
			$get_option_settings_values = get_option( 'hwpt_submit_category_settings_data');
			update_option( 'hwpt_submit_category_settings_data', $category_settings_data, '', 'yes');	
			if(!$get_option_settings_values){
				add_option( 'hwpt_submit_category_settings_data', $category_settings_data, '', 'yes' );	
			}
		}
	}
}
