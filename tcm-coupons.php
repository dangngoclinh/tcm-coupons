<?php
/*
	Plugin NAme: TCM Coupons
	Plugin URI: https://tapchimua.com
	Description: tcm coupons
	Version: 1.0
	Author URI: https://tapchimua.com
	Text Domain: tcm-coupons
	Domain Path: /lang
*/

define('PLUGIN_NAME', 'TCM Coupons');
define('TCM_COUPON_VERSION', '1.0');
define('TCM_MINIMUM_WP_VERSION', '4.0');
define('TCM_COUPON_TYPE_POST', 'coupons');
define('TCM_COUPON_URL', plugin_dir_url(__FILE__));
define('TCM_COUPON_DIR', plugin_dir_path(__FILE__));
define('TCM_COUPON_LANGUAGES', dirname(plugin_basename(__FILE__)) . '/lang');


require_once ( TCM_COUPON_DIR . 'inc/class.tcm-coupons.php' );
require_once ( TCM_COUPON_DIR . 'inc/shortcodes.php' );

register_activation_hook(__FILE__, array('TCMCoupons', 'active'));
register_deactivation_hook(__FILE__, array('TCMCoupons', 'deactive'));
TCMCoupons::setup();