<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       www.tplugins.com
 * @since      1.0.0
 *
 * @package    Tp_Woocommerce_Compare
 * @subpackage Tp_Woocommerce_Compare/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Tp_Woocommerce_Compare
 * @subpackage Tp_Woocommerce_Compare/public
 * @author     TP Plugins <pluginstp@gmail.com>
 */
class Tp_Woocommerce_Compare_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		add_shortcode( 'tp_woocommerce_compare', array($this,'tp_woocommerce_compare_shortcode') );
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name.'-icons.fontello', plugin_dir_url( __FILE__ ) . 'icons/css/fontello.css', array(), $this->version, 'all' );
		//wp_enqueue_style( 'lity.min', plugin_dir_url( __FILE__ ) . 'css/lity.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'tpwclity.min', plugin_dir_url( __FILE__ ) . 'css/tpwclity.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tp-woocommerce-compare-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		//wp_enqueue_script( 'lity.min', plugin_dir_url( __FILE__ ) . 'js/lity.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'tpwclity.min', plugin_dir_url( __FILE__ ) . 'js/tpwclity.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tp-woocommerce-compare-public.js', array( 'jquery' ), $this->version, false );

		// Localize the script with new data
		$translation_array = array(
			//'display_url'               => plugin_dir_url( __FILE__ ) . 'partials/tp-woocommerce-compare-public-display.php',
			'display_url'               => esc_url( home_url('?tpwqiframe=true') ),
			'ajax_url'                  => admin_url('admin-ajax.php'),
			'text1'                     => 'Compare',
			'text2'                     => 'View Compare',
			'limit_products_to_compare' => get_option('tpwc_limit_products_to_compare'),
			'compare_page_id'           => get_option('tp_woocommerce_compare_page_id'),
		);
		wp_localize_script( $this->plugin_name, 'tpwc', $translation_array );

	}

	public function add_compare_button($product_id = false,$get = false) {
		global $post;
		//wp_dbug($get);
		if(!$product_id){
			$product_id = $post->ID;
		}
		//echo '<a class="btn" href="'.plugin_dir_url( __FILE__ ) . 'partials/tp-woocommerce-compare-public-display.php?pid='.$post->ID.''.'" data-lity="">'.__('Compare','tpwc').'</a>';
		$text = __('Compare','tpwc');
		$icon = '<i class="demo-icon tpwc-icon-balance-scale">ؘ</i>';

		if($get){
			return '<span id="tpwc-bb-pid-'.$product_id.'" class="tpwc-compare" data-pid="'.$product_id.'">'.$icon.' '.esc_html($text).'</span>';
		}
		else{
			echo '<span id="tpwc-bb-pid-'.$product_id.'" class="tpwc-compare" data-pid="'.$product_id.'">'.$icon.' '.esc_html($text).'</span>';
		}
		
	}

	/**
	 * Adds the rewrite rule for our iframe
	 * 
	 * @uses add_rewrite_rule
	 */
	public function iframe_add_rewrite() {
		add_rewrite_rule(
			'^tpwqiframe$',
			'index.php?tpwqiframe=true',
			'top'
		);
	}

	/**
	 * adds our iframe query variable so WP knows what it is and doesn't
	 * just strip it out
	 */
	public function iframe_filter_vars( $vars )	{
		$vars[] = 'tpwqiframe';
		$vars[] = 'pid';
		return $vars;
	}

	/**
	 * Catches our iframe query variable.  If it's there, we'll stop the 
	 * rest of WP from loading and do our thing.  If not, everything will
	 * continue on its merry way.
	 * 
	 * @uses get_query_var
	 * @uses get_posts
	 */
	public function catch_iframe() {
		//wp_dbug(get_query_var( 'pid' ));
		// no iframe? bail
		if( !get_query_var( 'tpwqiframe' ) || !get_query_var( 'pid' )) return;

		$product_id = get_query_var( 'pid' );

		require plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/tp-woocommerce-compare-public-display.php';
		// finally, call exit(); and stop wp from finishing (eg. loading the
		// templates
		exit();
	}

	//[tp_woocommerce_compare]
	function tp_woocommerce_compare_shortcode( $atts ) {
		$atts = shortcode_atts( array(
			'var1' => 'shortcode1',
			'var2' => 'shortcode2'
		), $atts, 'tp_woocommerce_compare' );
	
		return $this->tp_compare_build($atts);
	}

	public function tp_compare_css_footer() {
		$add_to_cart_background = get_option('tpwc_add_to_cart_background');
    	$add_to_cart_color = get_option('tpwc_add_to_cart_color');
    	$add_to_cart_padding = get_option('tpwc_add_to_cart_padding');
		$add_to_cart_border_radius = get_option('tpwc_add_to_cart_border_radius');
		$tpwc_strart_color = get_option('tpwc_strart_color');

		$open_compare_button_color = get_option('tpwc_open_compare_button_color');
		$open_compare_button_background = (get_option('tpwc_open_compare_button_background')) ? get_option('tpwc_open_compare_button_background') : 'none';
		$open_compare_button_padding = get_option('tpwc_open_compare_button_padding');

		$product_compare_button_color = get_option('tpwc_product_compare_button_color');
		$product_compare_button_background = (get_option('tpwc_product_compare_button_background')) ? get_option('tpwc_product_compare_button_background') : 'none';
		$product_compare_button_padding = get_option('tpwc_product_compare_button_padding');
		$compare_page_id = get_option('tp_woocommerce_compare_page_id');
		//wp_dbug();

		echo '<style>
					.tp-compare-item-add-to-cart a{
						background: '.$add_to_cart_background.' !important;
						color: '.$add_to_cart_color.' !important;
						padding: '.$add_to_cart_padding.'px !important;
						border-radius: '.$add_to_cart_border_radius.'px !important;
					}
					.tp-compare-item-add-to-cart a:hover{
						opacity: 0.8;
					}
					.tp-compare-item-rating .star-rating {
						color: '.$tpwc_strart_color.';
					}
					.tpwc-compare{
						background: '.$product_compare_button_background.' !important;
						color: '.$product_compare_button_color.' !important;
						padding: '.$product_compare_button_padding.'px !important;
					}
					.tpwc-compare:hover {
						background: '.$product_compare_button_background.' !important;
						opacity: 0.8;
					}
					.tp-compare-link{
						background: '.$open_compare_button_background.' !important;
						color: '.$open_compare_button_color.' !important;
						padding: '.$open_compare_button_padding.'px !important;
						border-radius: 10px !important;
					}
					.tp-compare-link:hover {
						background: '.$open_compare_button_background.' !important;
						opacity: 0.8;
					}
					.page-id-'.$compare_page_id.' .tp-compare-link{
						display: none;
					}
		      </style>';
	}

	public function tp_compare_load_compare_table() {
		$tp_compare = sanitize_text_field($_POST['tp_compare']);
		$tp_compare = str_replace("[","",$tp_compare);
		$tp_compare = str_replace("]","",$tp_compare);
		//wp_dbug(explode(",",$tp_compare));
		$products = explode(",",$tp_compare);
		echo $this->tp_compare_build_table($products);
		die();
	}

	public function tp_compare_build_table($products,$args = false) {
		if($products){
			if($_GET && $_GET['pids']){
				$products = explode(",",$_GET['pids']);
				$products = array_map( 'intval', $products );
			}

			if($args){
				echo '<div id="tp-compare-ajax-results">';
			}

			echo '<div class="tp-compare-items">';

				echo do_shortcode('[shop_messages]');

				$tpwc_fields_to_show = get_option('tpwc_fields_to_show');
				$tpwc_remove_product_type = get_option('tpwc_remove_product_type');
				$tpwc_display_titles = get_option('tpwc_display_titles');

				if($products){
					foreach ($products as $product_id) {
						$product = wc_get_product($product_id);
						//wp_dbug($product);
						if($product){
							$name = $product->get_name();
							$long_description = $product->get_description();
							$short_description = $product->get_short_description();
							$sku = $product->get_sku();
							$price = $product->get_price();
							$stock_quantity = $product->get_stock_quantity();
							$stock_status = $product->get_stock_status();
							$weight = $product->get_weight();
							$length = $product->get_length();
							$width = $product->get_width();
							$height = $product->get_height();
							$attributes = $product->get_attributes();
							$default_attributes = $product->get_default_attributes();
							$category_ids = $product->get_category_ids();
							$tag_ids = $product->get_tag_ids();
							$image_id = $product->get_image_id();
							$rating_counts = $product->get_rating_counts();
							$average_rating = $product->get_average_rating();
							$review_count = $product->get_review_count();
							$is_on_sale = $product->is_on_sale();
							$is_in_stock = $product->is_in_stock();
							$has_attributes = $product->has_attributes();
							$permalink = $product->get_permalink();
							$price_html = $product->get_price_html();
							//wp_dbug($price);
							//$list_attributes = $product->list_attributes();
							// $product_name = $product->get_name();
							// $product_name = $product->get_name();
							// $product_name = $product->get_name();
							// $product_name = $product->get_name();
							// $product_name = $product->get_name();
							// $product_name = $product->get_name();

							if($rating_counts && $average_rating){
								$rating_html = wc_get_rating_html( $average_rating, $rating_counts );
								//$rating_html = do_shortcode( '[product_rating id="'.$product_id.'"]' );
							}
							else{
								$rating_html = ''.__('none','tpwc').'';
							}
				
							$thumbnail_url = get_the_post_thumbnail_url($product_id);

							//wp_dbug($stock_status);
				
							echo '<div id="tp-compare-item-'.$product_id.'" class="tp-compare-item" data-pid="'.$product_id.'" data-price="'.$price.'">';

								if($tpwc_remove_product_type == 'x_icon'){
									$sale_class = 'tpwc-on-salse-icon';
									echo '<span class="tp-compare-item-remove" onclick="tp_compare_item_remove('.$product_id.');">X</span>';
								}
								else{ //x_text
									$sale_class = 'tpwc-on-salse-text';
									echo '<span class="tp-compare-item-remove-text" onclick="tp_compare_item_remove('.$product_id.');">X Remove</span>';
								}

								if($is_on_sale){
									echo '<span class="'.$sale_class.'">'.__('SALE','tpwc').'</span>';
								}

								do_action('tp_compare_loop_before_product_image',$product_id);

								if(in_array("product_image", $tpwc_fields_to_show)){
									echo '<div class="tp-compare-item-in tp-compare-item-image">';
										do_action('tp_compare_loop_inside_product_image',$product_id);
										echo '<img class="tpwc-pimage" src="'.esc_url($thumbnail_url).'" alt="'.$name.'" title="'.$name.'" >';
									echo '</div>'; //tp-compare-item-image
								}

								if(in_array("add_to_cart", $tpwc_fields_to_show)){
									echo '<div class="tp-compare-item-in tp-compare-item-add-to-cart">';
										echo do_shortcode('[add_to_cart id="'.$product_id.'" show_price="false" style="" class="ttt"]');
									echo '</div>'; //tp-compare-item-add-to-cart
								}
				
								echo '<div class="tp-compare-item-in tp-compare-item-name">';
									echo '<a href="'.$permalink.'">'.esc_html($name).'</a>';
								echo '</div>'; //tp-compare-item-name

								if(in_array("price", $tpwc_fields_to_show)){
									echo '<div class="tp-compare-item-in tp-compare-item-price">';
										if($tpwc_display_titles){
											echo '<div class="tp-compare-item-title">'.__('Price','tpwc').'</div>';
										}
										echo ''.$price_html.'';
									echo '</div>'; //tp-compare-item-price
								}
				
								if(in_array("sku", $tpwc_fields_to_show)){
									echo '<div class="tp-compare-item-in tp-compare-item-sku">';
										if($tpwc_display_titles){
											echo '<div class="tp-compare-item-title">'.__('SKU','tpwc').'</div>';
										}
										echo apply_filters( 'tp_compare_sku_filter', $sku, $product_id );
									echo '</div>'; //tp-compare-item-sku
								}

								if(in_array("rating", $tpwc_fields_to_show)){
									echo '<div class="tp-compare-item-in tp-compare-item-rating">';
										if($tpwc_display_titles){
											echo '<div class="tp-compare-item-title">'.__('Rating','tpwc').'</div>';
										}
										echo apply_filters( 'tp_compare_rating_filter', $rating_html, $product_id );
									echo '</div>'; //tp-compare-item-rating
								}

								if(in_array("in_stock", $tpwc_fields_to_show)){
									echo '<div class="tp-compare-item-in tp-compare-item-stock-status tp-compare-'.$stock_status.'">';
										if($tpwc_display_titles){
											echo '<div class="tp-compare-item-title">'.__('Stock','tpwc').'</div>';
										}
										echo ''.$stock_status.'';
									echo '</div>'; //tp-compare-item-stock-status
								}

								if(in_array("short_description", $tpwc_fields_to_show)){
									echo '<div class="tp-compare-item-in tp-compare-item-short-description">';
										if($tpwc_display_titles){
											echo '<div class="tp-compare-item-title">'.__('Description','tpwc').'</div>';
										}
										echo ''.$short_description.'';
									echo '</div>'; //tp-compare-item-image
								}

								if(in_array("long_description", $tpwc_fields_to_show)){
									echo '<div class="tp-compare-item-in tp-compare-item-long-description">';
										if($tpwc_display_titles){
											echo '<div class="tp-compare-item-title">'.__('Description','tpwc').'</div>';
										}
										echo ''.$long_description.'';
									echo '</div>'; //tp-compare-item-image
								}

								if(in_array("attributes", $tpwc_fields_to_show)){
									echo '<div class="tp-compare-item-in tp-compare-item-list-attributes">';
										if($tpwc_display_titles){
											echo '<div class="tp-compare-item-title">'.__('Attributes','tpwc').'</div>';
										}
										echo ''.wc_display_product_attributes($product).'';
									echo '</div>'; //tp-compare-item-list-attributes
								}

								do_action('tp_compare_loop_after_product_attributes',$product_id);

							echo '</div>'; //tp-compare-item
						}
					}
				} //if($products)

			echo '</div>'; //tp-compare-items

			if($args){
				echo '</div>'; //tp-compare-ajax-results
			}
		}
		else{
			echo '<h1>'.__('Your compare is empty','tpwc').'</h1>';
		}

		//die();

	}

	public function tp_compare_build($atts) {
		$html = '';
		//wp_dbug($atts);
		//return '<div class="tp_compare_build_page_ajax" id="tp-compare-ajax-results"></div>';

		$html .= '<div id="tp-compare-max-'.$tpwc_limit_products_to_compare.'" class="tp-compare-main-page">';
			//wp_dbug($_GET);

			$html .= do_action('tp_compare_before_compare_table');

			//$html .= '<div class="tp_compare_title">'.__('Compare Products').'</div>';

			$html .= '<div id="tp_compare_title_max_products_ajax"></div>';

			$html .= '<div class="tp-compare-roller">';
				$html .= '<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>';
			$html .= '</div>'; //tp-compare-roller

			$html .= '<div class="tp_compare_build_page_ajax" id="tp-compare-ajax-results"></div>'; //tp-compare-ajax-results

			$html .= do_action('tp_compare_after_compare_table');

			$html .= '<div id="tp-compare-dbug"></div>';

			$html .= do_action( 'tp_compare_view_footer' );

		$html .= '</div>';

		return $html;
	}

}
