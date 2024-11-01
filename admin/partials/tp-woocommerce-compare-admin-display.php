<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.tplugins.com/
 * @since      1.0.0
 *
 * @package    Tp_Woocommerce_Compare
 * @subpackage Tp_Woocommerce_Compare/admin/partials
 */

// create custom plugin settings menu
add_action('admin_menu', 'tpwc_plugin_create_menu');

function tpwc_plugin_create_menu() {
    add_menu_page(TPWC_PLUGIN_NAME, TPWC_PLUGIN_NAME, 'manage_options', 'tpwc_plugin_settings_page', 'tpwc_plugin_settings_page' , plugins_url('/images/tp.png', __FILE__) );
    //add_menu_page( 'TP Woocommerce Product Gallery', 'TP Woocommerce Product Gallery', 'manage_options', 'tpwpg_settings', array( $this, 'tpwpg_plugin_options_page' ), 'dashicons-admin-tp', 110 );
    //call register settings function
    add_action( 'admin_init', 'register_tpwc_plugin_settings' );
}


function register_tpwc_plugin_settings() {
    //register our settings
    // register_setting('tpwc-plugin-settings-group','tpwc_only_in_desktop');
    
    // register_setting('tpwc-plugin-settings-group','tpwc_window_pop_up_color');
    // register_setting('tpwc-plugin-settings-group','tpwc_scroll_background');
    // register_setting('tpwc-plugin-settings-group','tpwc_scroll_color');

    register_setting('tpwc-plugin-settings-group','tpwc_fields_to_show');
    
    register_setting('tpwc-plugin-settings-group','tpwc_window_pop_up_background');
    register_setting('tpwc-plugin-settings-group','tpwc_display_share_buttons');
    register_setting('tpwc-plugin-settings-group','tpwc_remove_product_type');
    register_setting('tpwc-plugin-settings-group','tpwc_add_to_cart_background');
    register_setting('tpwc-plugin-settings-group','tpwc_add_to_cart_color');
    register_setting('tpwc-plugin-settings-group','tpwc_add_to_cart_padding');
    register_setting('tpwc-plugin-settings-group','tpwc_add_to_cart_border_radius');
    register_setting('tpwc-plugin-settings-group','tpwc_strart_color');
    register_setting('tpwc-plugin-settings-group','tpwc_limit_products_to_compare');
    register_setting('tpwc-plugin-settings-group','tpwc_open_compare_button_type');
    register_setting('tpwc-plugin-settings-group','tpwc_share_fields_to_show');
    register_setting('tpwc-plugin-settings-group','tpwc_display_titles');
    
    register_setting('tpwc-plugin-settings-group','tpwc_open_compare_button_color');
    register_setting('tpwc-plugin-settings-group','tpwc_open_compare_button_background');
    register_setting('tpwc-plugin-settings-group','tpwc_open_compare_button_padding');
    register_setting('tpwc-plugin-settings-group','tpwc_product_compare_button_color');
    register_setting('tpwc-plugin-settings-group','tpwc_product_compare_button_background');
    register_setting('tpwc-plugin-settings-group','tpwc_product_compare_button_padding');
    // register_setting('tpwc-plugin-settings-group','xxx');
    // register_setting('tpwc-plugin-settings-group','xxx');
    
}

function tpwc_plugin_settings_page() {

    $tp_woocommerce_compare_page_id = get_option('tp_woocommerce_compare_page_id');

    $tpwc_limit_products_to_compare = get_option('tpwc_limit_products_to_compare');
    $tpwc_display_share_buttons = get_option('tpwc_display_share_buttons');
    $tpwc_remove_product_type = get_option('tpwc_remove_product_type');
    $tpwc_add_to_cart_background = get_option('tpwc_add_to_cart_background');
    $tpwc_add_to_cart_color = get_option('tpwc_add_to_cart_color');
    $tpwc_add_to_cart_padding = get_option('tpwc_add_to_cart_padding');
    $tpwc_add_to_cart_border_radius = get_option('tpwc_add_to_cart_border_radius');
    $tpwc_strart_color = get_option('tpwc_strart_color');
    $tpwc_open_compare_button_type = get_option('tpwc_open_compare_button_type');
    $tpwc_display_titles = get_option('tpwc_display_titles');

    $tpwc_open_compare_button_color = get_option('tpwc_open_compare_button_color');
    $tpwc_open_compare_button_background = get_option('tpwc_open_compare_button_background');
    $tpwc_open_compare_button_padding = get_option('tpwc_open_compare_button_padding');

    $tpwc_product_compare_button_color = get_option('tpwc_product_compare_button_color');
    $tpwc_product_compare_button_background = get_option('tpwc_product_compare_button_background');
    $tpwc_product_compare_button_padding = get_option('tpwc_product_compare_button_padding');
       
    $tpwc_display_share_buttons_check = ($tpwc_display_share_buttons) ? 'checked="checked"' : '';
    $tpwc_display_titles_check = ($tpwc_display_titles) ? 'checked="checked"' : '';
    
    $tpwc_fields_to_show = get_option('tpwc_fields_to_show');
    $tpwc_view_box_background = get_option('tpwc_view_box_background');
    
    
?>
<div class="wrap">
<h1><?php echo TPWC_PLUGIN_NAME; ?></h1>

<form method="post" action="options.php">
    <?php settings_fields( 'tpwc-plugin-settings-group' ); ?>
    <?php do_settings_sections( 'tpwc-plugin-settings-group' ); ?>

    <nav id="tpwc-tab-nav">
        
        <span class="tabnav" data-sort="1">Settings</span>
        <span class="tabnav" data-sort="2">Comparison Table</span>
        <span class="tabnav" data-sort="3">Share Buttons (PRO)</span>
        <span class="tabnav" data-sort="4">Custom Css (PRO)</span>
        <span class="tabnav" data-sort="5">License (Get PRO)</span>
    </nav>

    <div id="tpwc-tab-contents">

        <div class="tabtxt tps_admin_section" data-sort="1">
            <div class="tpwc_admin_settings_left">

                <div class="tpwc_admin_settings_row">
                    <label class="tpwc-container-checkbox">Display only in desktop
                        <input type="checkbox" name="tpwc_only_in_desktop" value="1" <?php echo $tpwc_only_in_desktop_check; ?>>
                        <span class="checkmark"></span>
                    </label>
                    <span class="tpwc_admin_settings_desc">Display only on desktop</span>
                </div><!-- tpwc_admin_settings_row -->

                <div class="tpwc_admin_settings_row">
                    <div class="tpwc_triangle_topright_box"><div class="tpwc_triangle_topright"><span>PRO</span></div></div>
                    <label class="tpwc-container-checkbox">Display in product page
                        <input type="checkbox" name="tpwc_display_in_product_page" value="1" disabled>
                        <span class="checkmark"></span>
                    </label>
                    <span class="tpwc_admin_settings_desc">Let users the option to compare in product page</span>
                </div><!-- tpwc_admin_settings_row -->

                <div class="tpwc_admin_settings_row">
                    <label class="tpwc-container-select">Limit products to compare</label>
                    <select name="tpwc_limit_products_to_compare">
                        <option value="5" <?php if($tpwc_limit_products_to_compare == 5){echo 'selected';} ?>>5</option>
                        <option value="4" <?php if($tpwc_limit_products_to_compare == 4){echo 'selected';} ?>>4</option>
                        <option value="3" <?php if($tpwc_limit_products_to_compare == 3){echo 'selected';} ?>>3</option>
                        <option value="2" <?php if($tpwc_limit_products_to_compare == 2){echo 'selected';} ?>>2</option>
                    </select>
                    <span class="tpwc_admin_settings_desc">Limit products to compare on desktop (in mobile 2 products)</span>
                </div><!-- tpwc_admin_settings_row -->

                <div class="tpwc_admin_settings_row">
                    <div class="tpwc_admin_settings_row_col">
                        <label class="tpwc-container-select">Open compare button type</label>
                        <select name="tpwc_open_compare_button_type">
                            <option disabled value="viewpro">view (PRO)</option>
                            <option value="button1" selected>button style 1</option>
                            <option disabled value="button2pro">button style 2 (PRO)</option>
                            <option disabled value="button3pro">button style 3 (PRO)</option>
                        </select>
                        <span class="tpwc_admin_settings_desc">Box view or Button</span>
                    </div>

                    <div class="tpwc_admin_settings_row_col">
                        <div class="tpwc_admin_settings_row_col_30">
                            <label class="tpwc-container-select">button color</label>
                            <input type="text" class="tp_colorpiker" name="tpwc_open_compare_button_color" value="<?php echo $tpwc_open_compare_button_color; ?>" >
                        </div>

                        <div class="tpwc_admin_settings_row_col_30">
                            <label class="tpwc-container-select">button background</label>
                            <input type="text" class="tp_colorpiker" name="tpwc_open_compare_button_background" value="<?php echo $tpwc_open_compare_button_background; ?>" >
                        </div>

                        <div class="tpwc_admin_settings_row_col_30">
                            <label class="tpwc-container-select">button padding (in px)</label>
                            <input type="number" min="0" name="tpwc_open_compare_button_padding" value="<?php echo $tpwc_open_compare_button_padding; ?>" >
                        </div>
                    </div>
                </div><!-- tpwc_admin_settings_row -->

                <div class="tpwc_admin_settings_row">
                    <div class="tpwc_admin_settings_row_col_30">
                        <label class="tpwc-container-select">Product button color</label>
                        <input type="text" class="tp_colorpiker" name="tpwc_product_compare_button_color" value="<?php echo $tpwc_product_compare_button_color; ?>" >
                    </div>

                    <div class="tpwc_admin_settings_row_col_30">
                        <label class="tpwc-container-select">Product button background</label>
                        <input type="text" class="tp_colorpiker" name="tpwc_product_compare_button_background" value="<?php echo $tpwc_product_compare_button_background; ?>" >
                    </div>

                    <div class="tpwc_admin_settings_row_col_30">
                        <label class="tpwc-container-select">Product button padding (in px)</label>
                        <input type="number" min="0" name="tpwc_product_compare_button_padding" value="<?php echo $tpwc_product_compare_button_padding; ?>" >
                    </div>
                </div><!-- tpwc_admin_settings_row -->

                <div class="tpwc_admin_settings_row">
                    <div class="tpwc_admin_settings_row_col">
                        <label class="tpwc-container-input">View box background</label>
                        <input disabled type="text" class="tp_colorpiker" name="tpwc_view_box_background" value="<?php echo $tpwc_view_box_background; ?>" >
                        <span class="tpwc_admin_settings_desc">Select View box background</span>
                    </div>
                    <div class="tpwc_triangle_topright_box"><div class="tpwc_triangle_topright"><span>PRO</span></div></div>
                </div>
            
                <?php //echo tpwc_select_page_fields(); ?>

                <div class="tpwc_admin_settings_row">
                    <div class="tpwc_admin_settings_row_col">
                        <label class="tpwc-container-input">Window max width</label>
                        <input disabled type="number" name="tpwc_window_max_width" value="930" >
                        <span class="tpwc_admin_settings_desc">Select Window max width in px</span>
                        <div class="tpwc_triangle_topright_box"><div class="tpwc_triangle_topright"><span>PRO</span></div></div>
                    </div>
                </div><!-- tpwc_admin_settings_row -->
                
                <div class="tpwc_admin_settings_row">
                    <div class="tpwc_admin_settings_row_col">
                        <label class="tpwc-container-input">Pop up background</label>
                        <input type="text" class="tp_colorpiker" name="tpwc_window_pop_up_background">
                        <span class="tpwc_admin_settings_desc">Select Pop up Background</span>
                        <div class="tpwc_triangle_topright_box"><div class="tpwc_triangle_topright"><span>PRO</span></div></div>
                    </div>

                    <div class="tpwc_admin_settings_row_col">
                        <label class="tpwc-container-input">Pop up Color</label>
                        <input type="text" class="tp_colorpiker" name="tpwc_window_pop_up_color">
                        <span class="tpwc_admin_settings_desc">Select Pop up Color</span>
                        <div class="tpwc_triangle_topright_box"><div class="tpwc_triangle_topright"><span>PRO</span></div></div>
                    </div>
                </div>

                <div class="tpwc_admin_settings_row">
                    <div class="tpwc_admin_settings_row_col">
                        <label class="tpwc-container-input">Scroll Background</label>
                        <input type="text" class="tp_colorpiker" name="tpwc_scroll_background">
                        <span class="tpwc_admin_settings_desc">Select Scroll Background</span>
                        <div class="tpwc_triangle_topright_box"><div class="tpwc_triangle_topright"><span>PRO</span></div></div>
                    </div>

                    <div class="tpwc_admin_settings_row_col">
                        <label class="tpwc-container-input">Scroll Color</label>
                        <input type="text" class="tp_colorpiker" name="tpwc_scroll_color">
                        <span class="tpwc_admin_settings_desc">Select Scroll Color</span>
                        <div class="tpwc_triangle_topright_box"><div class="tpwc_triangle_topright"><span>PRO</span></div></div>
                    </div>
                </div>

            </div><!-- tpwc_admin_settings_left -->

            <div class="tpwc_admin_settings_right">
            </div><!-- tpwc_admin_settings_right -->
        </div><!-- tps_admin_section -->

        <div class="tabtxt tps_admin_section" data-sort="2">
            <div class="tpwc_admin_settings_left">

                <div class="tpwc_admin_settings_row">
                    <label class="tpwc-container-checkbox">Display titles
                        <input type="checkbox" name="tpwc_display_titles" value="1" <?php echo $tpwc_display_titles_check; ?>>
                        <span class="checkmark"></span>
                    </label>
                    <span class="tpwc_admin_settings_desc">Display titles for each field</span>
                </div><!-- tpwc_admin_settings_row -->

                <div class="tpwc_admin_settings_row">
                    <label class="tpwc-container-checkbox">Highlight cheapest price
                        <input disabled type="checkbox" name="tpwc_highlight_cheapest_price" value="1" checked>
                        <span class="checkmark"></span>
                    </label>
                    <span class="tpwc_admin_settings_desc">The cheapest price will highlight with bold and background</span>
                    <div class="tpwc_triangle_topright_box"><div class="tpwc_triangle_topright"><span>PRO</span></div></div>
                </div><!-- tpwc_admin_settings_row -->

                <div class="tpwc_admin_settings_row">
                    <h3>Fields to show</h3>
                    <?php echo tpwc_fields_to_show($tpwc_fields_to_show); ?>
                </div><!-- tpwc_admin_settings_row -->

                <div class="tpwc_admin_settings_row">
                    <label class="tpwc-container-select">Remove product type</label>
                    <select name="tpwc_remove_product_type">
                        <option value="x_icon" <?php if($tpwc_remove_product_type == 'x_icon'){echo 'selected';} ?>>X icon</option>
                        <option value="x_text" <?php if($tpwc_remove_product_type == 'x_text'){echo 'selected';} ?>>X text</option>
                    </select>
                    <!-- <span class="tpwc_admin_settings_desc">Display only on desktop</span> -->
                </div><!-- tpwc_admin_settings_row -->

                <div class="tpwc_admin_settings_row">
                    <h3>Add to cart Style</h3>
                    
                    <div class="tpwc_admin_settings_row_col">
                        <label class="tpwc-container-input">Background</label>
                        <input type="text" class="tp_colorpiker" name="tpwc_add_to_cart_background" value="<?php echo $tpwc_add_to_cart_background; ?>" >
                        <span class="tpwc_admin_settings_desc">Select Add to cart background</span>
                    </div>

                    <div class="tpwc_admin_settings_row_col">
                        <label class="tpwc-container-input">Color</label>
                        <input type="text" class="tp_colorpiker" name="tpwc_add_to_cart_color" value="<?php echo $tpwc_add_to_cart_color; ?>" >
                        <span class="tpwc_admin_settings_desc">Select Add to cart color</span>
                    </div>

                    <div class="tpwc_admin_settings_row_col">
                        <label class="tpwc-container-input">Padding</label>
                        <input type="number" name="tpwc_add_to_cart_padding" value="<?php echo $tpwc_add_to_cart_padding; ?>" >
                        <span class="tpwc_admin_settings_desc">Select Add to cart padding (in px)</span>
                    </div>

                    <div class="tpwc_admin_settings_row_col">
                        <label class="tpwc-container-input">Border radius</label>
                        <input type="number" name="tpwc_add_to_cart_border_radius" value="<?php echo $tpwc_add_to_cart_border_radius; ?>" >
                        <span class="tpwc_admin_settings_desc">Select Add to cart border radius (in px)</span>
                    </div>
                    
                </div><!-- tpwc_admin_settings_row -->

                <div class="tpwc_admin_settings_row">
                    <div class="tpwc_admin_settings_row_col">
                        <label class="tpwc-container-input">Stars color</label>
                        <input type="text" class="tp_colorpiker" name="tpwc_strart_color" value="<?php echo $tpwc_strart_color; ?>" >
                        <span class="tpwc_admin_settings_desc">Select rating stars color</span>
                    </div>
                </div><!-- tpwc_admin_settings_row -->

            </div><!-- tpwc_admin_settings_left -->
        </div><!-- tps_admin_section -->

        <div class="tabtxt tps_admin_section" data-sort="3">
            <div class="tpwc_admin_settings_left">
                <div class="tpwc_admin_settings_row">
                    <label class="tpwc-container-checkbox">Display Share Buttons
                        <input type="checkbox" name="tpwc_display_share_buttons" value="1" <?php echo $tpwc_display_share_buttons_check; ?>>
                        <span class="checkmark"></span>
                    </label>
                    <div class="tpwc_triangle_topright_box"><div class="tpwc_triangle_topright"><span>PRO</span></div></div>
                </div><!-- tpwc_admin_settings_row -->

                <div class="tpwc_admin_settings_row">
                    <h3>Fields to show</h3>
                    <?php echo tpwc_share_fields_to_show(); ?>
                    <div class="tpwc_triangle_topright_box"><div class="tpwc_triangle_topright"><span>PRO</span></div></div>
                </div><!-- tpwc_admin_settings_row -->

            </div><!-- tpwc_admin_settings_left -->
        </div><!-- tps_admin_section -->

        <div class="tabtxt tps_admin_section" data-sort="4">
            <div class="tpwc_admin_settings_left">
                <h3>This option is for developers only! If you do not know CSS it is not recommended to change it.</h3>
                <textarea id="tpwc_custom_css" class="tpwc_custom_css" name="tpwc_custom_css" disabled></textarea>
            </div><!-- tpwc_admin_settings_left -->
        </div><!-- tps_admin_section -->

        <div class="tabtxt tps_admin_section" data-sort="5">
            <div class="tpwc_admin_settings_left">
                <h2>Free Version</h2>
                <a href="https://www.tplugins.com/product/tp-woocommerce-compare-pro" target="_blank">Upgrade from the FREE version to the PRO version</a>
            </div><!-- tpwc_admin_settings_left -->

            <div class="tpwc_admin_settings_right">
            </div><!-- tpwc_admin_settings_right -->
        </div><!-- tps_admin_section -->

    </div><!-- tpwc-tab-contents -->
    
    <?php submit_button(); ?>

</form>

<script>

var tab = {
    nav : null, // holds all tabs
    txt : null, // holds all text containers
    init : function () {
    // tab.init() : init tab interface

    // Get all tabs + contents
    tab.nav = document.getElementById("tpwc-tab-nav").getElementsByClassName("tabnav");
    tab.txt = document.getElementById("tpwc-tab-contents").getElementsByClassName("tabtxt");

    // Error checking
    if (tab.nav.length==0 || tab.txt.length==0 || tab.nav.length!=tab.txt.length) {
        console.log("ERROR STARTING TABS");
    } else {
        // Attach onclick events to navigation tabs
        for (var i=0; i<tab.nav.length; i++) {
        tab.nav[i].dataset.pos = i;
        tab.nav[i].addEventListener("click", tab.switch);
        }

        // Default - show first tab
        tab.nav[0].classList.add("active");
        tab.txt[0].classList.add("active");
    }
    },

    switch : function () {
    // tab.switch() : change to another tab

    // Hide all tabs & text
    for (var t of tab.nav) {
        t.classList.remove("active");
    }
    for (var t of tab.txt) {
        t.classList.remove("active");
    }

    // Set current tab
    tab.nav[this.dataset.pos].classList.add("active");
    tab.txt[this.dataset.pos].classList.add("active");
    }
};

window.addEventListener("load", tab.init);

</script>

</div>
<?php

}

function tpwc_fields_to_show($tpwc_fields_to_show) {
    $html = '';
    $all_fields = array(
        'product_image'     => 'Product image',
        'add_to_cart'       => 'Add to cart',
        'price'             => 'Price',
        'rating'            => 'Rating',
        'short_description' => 'Short description',
        'long_description'  => 'Long description',
        'in_stock'          => 'In stock',
        'sku'               => 'SKU',
        'attributes'        => 'Product attributes',
        // 'xxx' => 'xxx',
        // 'xxx' => 'xxx',
        // 'xxx' => 'xxx',
        // 'xxx' => 'xxx',
        // 'xxx' => 'xxx',
        // 'xxx' => 'xxx',
        // 'xxx' => 'xxx'
    );

    foreach ($all_fields as $key => $value) {
        $checked = '';
        if($tpwc_fields_to_show && in_array($key, $tpwc_fields_to_show)){
            $checked = 'checked';
        }
        $html .= '<div class="tpwc-main-row">';
            $html .= '<label class="tpwc-container-checkbox">'.$value.'';
                $html .= '<input type="checkbox" name="tpwc_fields_to_show[]" value="'.$key.'" '.$checked.'>';
                $html .= '<span class="checkmark"></span>';
            $html .= '</label>';
        $html .= '</div>';
    }

    return $html;
}

function tpwc_share_fields_to_show() {
    $html = '';
    $all_fields = array(
        'email'     => 'Email',
        'facebook'  => 'Facebook',
        'linkedin'  => 'Linked In',
        'pinterest' => 'Pinterest',
        'print'     => 'Print',
        'twitter'   => 'Twitter',
        'whatsapp'  => 'Whatsapp'
    );

    foreach ($all_fields as $key => $value) {
        $checked = 'checked';
        $html .= '<div class="tpwc-main-row">';
            $html .= '<label class="tpwc-container-checkbox">'.$value.'';
                $html .= '<input type="checkbox" name="tpwc_share_fields_to_show[]" value="'.$key.'" '.$checked.'>';
                $html .= '<span class="checkmark"></span>';
            $html .= '</label>';
        $html .= '</div>';
    }

    return $html;
}