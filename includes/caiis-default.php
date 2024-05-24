<?php



/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    *  Remove the Back-End code editor
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
 
function remove_editor_menu() {
    remove_action('admin_menu', '_add_themes_utility_last', 101);
    if (!function_exists('get_field')) {
        return;
    }
    if (!get_field('enable_comments_menu', 'option')) {
      remove_menu_page( 'edit-comments.php' );
    }
}
add_action('_admin_menu', 'remove_editor_menu', 1);


/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    *  Remove unnecessary css
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
 
function remove_block_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'global-styles' );
    wp_dequeue_style( 'classic-theme-styles' );
    wp_dequeue_style( 'wpml-legacy-horizontal-list-0-css' );
    
}
add_action( 'wp_enqueue_scripts', 'remove_block_css', 100 );





/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    *  Disable Yoast's Hidden love letter  
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
 
add_action( 'template_redirect', function () {
    if ( ! class_exists( 'WPSEO_Frontend' ) ) {
        return;
    }
    $instance = WPSEO_Frontend::get_instance();
    // make sure, future version of the plugin does not break our site.
    if ( ! method_exists( $instance, 'debug_mark') ) {
        return ;
    }
    remove_action( 'wpseo_head', array( $instance, 'debug_mark' ), 2 );
}, 9999 );





/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    *   Remove the detail from the wordpress errors
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

function no_wordpress_errors() {
    return 'Something is wrong';
}
add_filter('login_errors', 'no_wordpress_errors');







 
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    *  Noindex Author 
    *  Adds a noindex meta tag on author archives 
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

function noindex_author() {
    if (is_author()) {
        echo '<meta name="robots" content="noindex" />';
    }
}
add_action('wp_head', 'noindex_author');


if ( !function_exists( 'wp_password_change_notification' ) ) {
    function wp_password_change_notification() {}
}



 
 
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
               Rss Feed Related
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/


if (function_exists('get_field')) {
    function disable_feeds() {
        wp_redirect( home_url(), 301 );
        die;
    }
      
      //Remove WP feeds
    add_action( 'do_feed',      'disable_feeds', -1 );
    add_action( 'do_feed_rdf',  'disable_feeds', -1 );
    add_action( 'do_feed_rss',  'disable_feeds', -1 );
    add_action( 'do_feed_rss2', 'disable_feeds', -1 );
    add_action( 'do_feed_atom', 'disable_feeds', -1 );
    
    // Disable comment feeds.
    add_action( 'do_feed_rss2_comments', 'disable_feeds', -1 );
    add_action( 'do_feed_atom_comments', 'disable_feeds', -1 );
    
    // Prevent feed links from being inserted in the <head> of the page.
    add_action( 'feed_links_show_posts_feed',    '__return_false', -1 );
    add_action( 'feed_links_show_comments_feed', '__return_false', -1 );
    remove_action( 'wp_head', 'feed_links',       2 );
    remove_action( 'wp_head', 'feed_links_extra', 3 );
}





/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                Disable xmlrpc
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

add_filter( 'xmlrpc_enabled', '__return_false' ); 


 