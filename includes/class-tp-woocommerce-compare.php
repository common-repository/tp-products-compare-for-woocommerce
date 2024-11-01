<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       www.tplugins.com
 * @since      1.0.0
 *
 * @package    Tp_Woocommerce_Compare
 * @subpackage Tp_Woocommerce_Compare/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Tp_Woocommerce_Compare
 * @subpackage Tp_Woocommerce_Compare/includes
 * @author     TP Plugins <pluginstp@gmail.com>
 */
class Tp_Woocommerce_Compare {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Tp_Woocommerce_Compare_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'TP_WOOCOMMERCE_COMPARE_VERSION' ) ) {
			$this->version = TP_WOOCOMMERCE_COMPARE_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'tp-woocommerce-compare';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Tp_Woocommerce_Compare_Loader. Orchestrates the hooks of the plugin.
	 * - Tp_Woocommerce_Compare_i18n. Defines internationalization functionality.
	 * - Tp_Woocommerce_Compare_Admin. Defines all hooks for the admin area.
	 * - Tp_Woocommerce_Compare_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-tp-woocommerce-compare-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-tp-woocommerce-compare-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-tp-woocommerce-compare-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/tp-woocommerce-compare-admin-display.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-tp-woocommerce-compare-public.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		//require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/tp-woocommerce-compare-public-display.php';

		$this->loader = new Tp_Woocommerce_Compare_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Tp_Woocommerce_Compare_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Tp_Woocommerce_Compare_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Tp_Woocommerce_Compare_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		$this->loader->add_filter( 'plugin_action_links_'.TPWC_PLUGIN_BASENAME, $plugin_admin,'settings_link', 10, 2 );
		$this->loader->add_filter( 'plugin_row_meta', $plugin_admin, 'get_pro_link', 10, 2 );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {
		$tpwc_open_compare_button_type = get_option('tpwc_open_compare_button_type');
		
		$plugin_public = new Tp_Woocommerce_Compare_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		//--------------------------------------------------------------------------
		$this->loader->add_action( 'init', $plugin_public, 'iframe_add_rewrite' );
		$this->loader->add_filter( 'query_vars', $plugin_public, 'iframe_filter_vars' );
		$this->loader->add_action( 'template_redirect', $plugin_public, 'catch_iframe' );
		//--------------------------------------------------------------------------

		//add_compare_button position
		//$this->loader->add_action( 'woocommerce_after_shop_loop_item', $plugin_public, 'add_compare_button', 10 ); //before add to cart
		$this->loader->add_action( 'woocommerce_after_shop_loop_item', $plugin_public, 'add_compare_button', 20 ); //after add to cart

		$this->loader->add_action( 'tpwpc_after_addtocart', $plugin_public, 'add_compare_button', 10, 2 );
		$this->loader->add_filter('tpwpc_after_addtocart', $plugin_public, 'add_compare_button', 10, 2 );

		$this->loader->add_action("wp_ajax_tp_compare_item_remove", $plugin_public, "tp_compare_item_remove");
		$this->loader->add_action("wp_ajax_nopriv_tp_compare_item_remove", $plugin_public, "tp_compare_item_remove");

		//$this->loader->add_action("tp_compare_build", $plugin_public, "tp_compare_build");
		//$this->loader->add_action("tp_compare_build", $plugin_public, "tp_compare_build");

		//$this->loader->add_action("wp_footer", $plugin_public, "tp_compare_link_button1");

		$this->loader->add_action("wp_footer", $plugin_public, "tp_compare_css_footer");

		$this->loader->add_action("tp_compare_view_footer", $plugin_public, "tp_compare_css_footer");

		$this->loader->add_action("wp_ajax_tp_compare_load_compare_table", $plugin_public, "tp_compare_load_compare_table");
		$this->loader->add_action("wp_ajax_nopriv_tp_compare_load_compare_table", $plugin_public, "tp_compare_load_compare_table");

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Tp_Woocommerce_Compare_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
