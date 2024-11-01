<?php

/**
 * Fired during plugin activation
 *
 * @link       www.tplugins.com
 * @since      1.0.0
 *
 * @package    Tp_Woocommerce_Compare
 * @subpackage Tp_Woocommerce_Compare/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Tp_Woocommerce_Compare
 * @subpackage Tp_Woocommerce_Compare/includes
 * @author     TP Plugins <pluginstp@gmail.com>
 */
class Tp_Woocommerce_Compare_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		
		add_option( 'tpwc_fields_to_show', array('product_image','add_to_cart','price','rating','short_description','in_stock','sku','attributes') );
		//add_option( 'tpwc_share_fields_to_show', array('product_image','add_to_cart','price','rating','short_description','in_stock','sku','attributes') );
		add_option( 'tpwc_view_box_background', '#d8d8d8' );
		add_option( 'tpwc_window_pop_up_background', '#ffffff' );
		add_option( 'tpwc_display_share_buttons', 1 );
		add_option( 'tpwc_remove_product_type', 'x_text' );
		add_option( 'tpwc_add_to_cart_background', '#525252' );
		add_option( 'tpwc_add_to_cart_color', '#ffffff' );
		add_option( 'tpwc_add_to_cart_padding', 10 );
		add_option( 'tpwc_add_to_cart_border_radius', 30 );
		add_option( 'tpwc_strart_color', '#ffc800' );
		add_option( 'tpwc_limit_products_to_compare', 4 );
		add_option( 'tpwc_open_compare_button_type', 'button1' );
		add_option( 'tpwc_display_titles', 0 );
		add_option( 'tpwc_highlight_cheapest_price', 0 );
		add_option( 'tpwc_open_compare_button_color', '#ffffff' );
		add_option( 'tpwc_open_compare_button_background', '#3e67d8' );
		add_option( 'tpwc_open_compare_button_padding', 10 );

		add_option( 'tpwc_product_compare_button_color', '#ffffff' );
		add_option( 'tpwc_product_compare_button_background', '#333333' );
		add_option( 'tpwc_product_compare_button_padding', 10 );

		//add_option( 'tpwc_xxx', 0 );
		//add_option( 'tpwc_xxx', 0 );
		//add_option( 'tpwc_xxx', 0 );
		//add_option( 'tpwc_xxx', 0 );
		//add_option( 'tpwc_xxx', 0 );
		//add_option( 'tpwc_xxx', 0 );
		//add_option( 'tpwc_xxx', 0 );

		//--------------------------------------------------------------------------------

		$new_page_title    = 'Compare Products';
		$new_page_slug     = 'tp_woocommerce_compare';
		$new_page_content  = '[tp_woocommerce_compare]';
		$new_page_template = ''; //ex. template-custom.php. Leave blank if you don't want a custom page template.
	
		//don't change the code bellow, unless you know what you're doing
	
		$page_check = get_page_by_title($new_page_title);
		$new_page = array(
			'post_type'    => 'page',
			'post_name'    => $new_page_slug, //slug
			'post_title'   => $new_page_title,
			'post_content' => $new_page_content,
			'post_status'  => 'publish',
			'post_author'  => 1,
		);
		if(!isset($page_check->ID)){
			$new_page_id = wp_insert_post($new_page);
			add_option( 'tp_woocommerce_compare_page_id', $new_page_id );
			if(!empty($new_page_template)){
				update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
			}
		}

	}

}
