<?php
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       www.tplugins.com
 * @since      1.0.0
 *
 * @package    Tp_Woocommerce_Compare
 * @subpackage Tp_Woocommerce_Compare/public/partials
 */

do_action('tpwc_register_hook');

wp_head();

//wp_enqueue_script( 'jquery' );

$tpwc_limit_products_to_compare = get_option('tpwc_limit_products_to_compare');

if(wp_is_mobile()){
    $tpwc_limit_products_to_compare = 2;
}

echo '<base target="_parent">';
echo '<div id="tp-compare-max-'.$tpwc_limit_products_to_compare.'" class="tp-compare-main">';
    //wp_dbug($_GET);

    do_action('tp_compare_before_compare_table');

    echo '<div class="tp_compare_title">'.__('Compare Products').'</div>';

    echo '<div id="tp_compare_title_max_products_ajax">'.esc_html($tp_compare_title_max_products).'</div>';

    echo '<div class="tp-compare-roller">';
        echo '<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>';
    echo '</div>'; //tp-compare-roller

    echo '<div id="tp-compare-ajax-results">';
        do_action( 'tp_compare_build' );
    echo '</div>'; //tp-compare-ajax-results

    do_action('tp_compare_after_compare_table');

    echo '<div id="tp-compare-dbug"></div>';

    do_action( 'tp_compare_view_footer' );

echo '</div>';

//$ajaxlink = admin_url('admin-ajax.php?action=my_user_vote&post_id='.$post->ID.'&nonce='.$nonce);
$ajaxlink = admin_url('admin-ajax.php');
?>

<style>
    * {
        scrollbar-width: thin;
        scrollbar-color: #999 #f5f5f5;
        box-sizing: border-box;
    }

    /* Works on Chrome, Edge, and Safari */
    *::-webkit-scrollbar {
        width: 12px;
    }

    *::-webkit-scrollbar-track {
        background: #f5f5f5;
        padding:3px 0;
    }

    *::-webkit-scrollbar-thumb {
        background-color: #999;
        border-radius: 8px;
        border: 3px solid #f5f5f5;
    }
    html{
        font-size: 14px;
        margin: 0 !important;
    }
    body{
        background: #ffffff;
        margin: 2%;
        font-family: Arial, Helvetica, sans-serif;
    }
    .tp-compare-link{
        display: none !important;
    }
    .tp-compare-roller{
        background: rgba(255, 255, 255, 0.8);
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 99;
        height: 100%;
        text-align: center;
    }
    #wpadminbar{
        display: none;
    }
    /* -------------------------------------------------------------------- */

    /* <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div> */

    .lds-roller {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
        margin: 15% 0;
    }
    .lds-roller div {
        animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
        transform-origin: 40px 40px;
    }
    .lds-roller div:after {
        content: " ";
        display: block;
        position: absolute;
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #cef;
        margin: -4px 0 0 -4px;
    }
    .lds-roller div:nth-child(1) {
        animation-delay: -0.036s;
    }
    .lds-roller div:nth-child(1):after {
        top: 63px;
        left: 63px;
    }
    .lds-roller div:nth-child(2) {
        animation-delay: -0.072s;
    }
    .lds-roller div:nth-child(2):after {
        top: 68px;
        left: 56px;
    }
    .lds-roller div:nth-child(3) {
        animation-delay: -0.108s;
    }
    .lds-roller div:nth-child(3):after {
        top: 71px;
        left: 48px;
    }
    .lds-roller div:nth-child(4) {
        animation-delay: -0.144s;
    }
    .lds-roller div:nth-child(4):after {
        top: 72px;
        left: 40px;
    }
    .lds-roller div:nth-child(5) {
        animation-delay: -0.18s;
    }
    .lds-roller div:nth-child(5):after {
        top: 71px;
        left: 32px;
    }
    .lds-roller div:nth-child(6) {
        animation-delay: -0.216s;
    }
    .lds-roller div:nth-child(6):after {
        top: 68px;
        left: 24px;
    }
    .lds-roller div:nth-child(7) {
        animation-delay: -0.252s;
    }
    .lds-roller div:nth-child(7):after {
        top: 63px;
        left: 17px;
    }
    .lds-roller div:nth-child(8) {
        animation-delay: -0.288s;
    }
    .lds-roller div:nth-child(8):after {
        top: 56px;
        left: 12px;
    }
    @keyframes lds-roller {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }

    /* -------------------------------------------------------------------- */

    .rTable {
        display: block;
        width: 100%;
    }
    .rTableHeading, .rTableBody, .rTableFoot, .rTableRow{
        clear: both;
    }
    .rTableHead, .rTableFoot{
        background-color: #DDD;
        font-weight: bold;
    }
    .rTableCell {
        border: 1px solid #999999;
        float: left;
        /* height: 17px; */
        overflow: hidden;
        padding: 3px 1.8%;
        width: 24%;
    }
    .rTableHead {
        border: 1px solid #999999;
        float: left;
        /* height: 17px; */
        overflow: hidden;
        padding: 3px 1.8%;
        width: 20%;
    }
    .rTable:after {
        visibility: hidden;
        display: block;
        font-size: 0;
        content: " ";
        clear: both;
        height: 0;
    }
    .rTableCellImage{
        padding: 0;
    }

</style>

<script>
    //$accounts_json = htmlentities(json_encode($accounts_array));
    jQuery( document ).ready(function() {
        //console.log( "ready!" );

        <?php if(isset($_GET['pid']) && $_GET['pid'] != -1): ?>
            tp_compare_register_session_storage(<?php echo sanitize_text_field($_GET['pid']); ?>);
        <?php endif; ?>
        
        tp_compare_load_compare_table();

    });

</script>

<?php wp_footer(); ?>