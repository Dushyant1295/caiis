<?php


include get_template_directory() . '/config/vite.php';

/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                 Timber Setup
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/includes/StarterSite.php';  // Refer this for Timber Class 

Timber\Timber::init();
Timber::$dirname = [ 'templates','views'];

new StarterSite();


/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                 Global Functions
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

require('includes/timber-page-performance.php');
require('includes/disable-emogies.php'); //called inside timber constructor


require('includes/caiis-default.php');


/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                LOGIN PAGE STYLE
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

require('includes/login-style.php');

add_action( 'login_enqueue_scripts', 'my_login_logo' );
add_action('wp_before_admin_bar_render', 'ec_dashboard_custom_logo');

 




/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            - Woocommerce setup
    Note: Currently, the 'woocommerce' folder in the theme 
    is empty. We need to grab the entire folder from the plugins
    and paste it inside the theme.
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

require('includes/woo-commerce.php');

*/
