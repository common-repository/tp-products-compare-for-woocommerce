<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              www.tplugins.com
 * @since             1.0.0
 * @package           Tp_Woocommerce_Compare
 *
 * @wordpress-plugin
 * Plugin Name:       TP Products Compare for Woocommerce
 * Plugin URI:        www.tplugins.com
 * Description:       Add an option for your customers to make product comparisons.
 * Version:           1.0.0
 * Author:            TP Plugins
 * Author URI:        https://www.tplugins.com/category/documentation/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tp-woocommerce-compare
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
define( 'TP_WOOCOMMERCE_COMPARE_VERSION', '1.0.0' );
define('TPWC_PLUGIN_NAME', 'TP Woocommerce Compare');
define('TPWC_PLUGIN_HOME', 'https://www.tplugins.com/');
define('TPWC_PLUGIN_BASENAME', plugin_basename(__FILE__));
define('TPWC_PLUGIN_PRO_SLUG', 'tp-woocommerce-compare-pro');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tp-woocommerce-compare-activator.php
 */
function activate_tp_woocommerce_compare() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tp-woocommerce-compare-activator.php';
	Tp_Woocommerce_Compare_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tp-woocommerce-compare-deactivator.php
 */
function deactivate_tp_woocommerce_compare() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tp-woocommerce-compare-deactivator.php';
	Tp_Woocommerce_Compare_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_tp_woocommerce_compare' );
register_deactivation_hook( __FILE__, 'deactivate_tp_woocommerce_compare' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tp-woocommerce-compare.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_tp_woocommerce_compare() {

	$plugin = new Tp_Woocommerce_Compare();
	$plugin->run();

}
run_tp_woocommerce_compare();