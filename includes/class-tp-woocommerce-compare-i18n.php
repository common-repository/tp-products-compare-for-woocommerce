<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       www.tplugins.com
 * @since      1.0.0
 *
 * @package    Tp_Woocommerce_Compare
 * @subpackage Tp_Woocommerce_Compare/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Tp_Woocommerce_Compare
 * @subpackage Tp_Woocommerce_Compare/includes
 * @author     TP Plugins <pluginstp@gmail.com>
 */
class Tp_Woocommerce_Compare_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'tp-woocommerce-compare',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
