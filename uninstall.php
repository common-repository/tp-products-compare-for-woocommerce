<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future version of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 *
 * For more information, see the following discussion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 * @link       www.tplugins.com
 * @since      1.0.0
 *
 * @package    Tp_Woocommerce_Compare
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Delete options.
//$wpdb->query( "DELETE FROM $wpdb->options WHERE option_name LIKE 'tpwc\_%';" );
//$wpdb->query( "DELETE FROM $wpdb->options WHERE option_name LIKE 'widget\_woocommerce\_%';" );

delete_option( 'tpwc_fields_to_show' );
delete_option( 'tpwc_share_fields_to_show' );
delete_option( 'tpwc_view_box_background' );
delete_option( 'tpwc_window_pop_up_background' );
delete_option( 'tpwc_display_share_buttons' );
delete_option( 'tpwc_remove_product_type' );
delete_option( 'tpwc_add_to_cart_background' );
delete_option( 'tpwc_add_to_cart_color' );
delete_option( 'tpwc_add_to_cart_padding' );
delete_option( 'tpwc_add_to_cart_border_radius' );
delete_option( 'tpwc_strart_color' );
delete_option( 'tpwc_limit_products_to_compare' );
delete_option( 'tpwc_open_compare_button_type', 'button1' );
delete_option( 'tpwc_display_titles' );
delete_option( 'tpwc_highlight_cheapest_price' );
delete_option( 'tpwc_open_compare_button_color' );
delete_option( 'tpwc_open_compare_button_background' );
delete_option( 'tpwc_open_compare_button_padding' );
delete_option( 'tpwc_product_compare_button_color' );
delete_option( 'tpwc_product_compare_button_background' );
delete_option( 'tpwc_product_compare_button_padding' );