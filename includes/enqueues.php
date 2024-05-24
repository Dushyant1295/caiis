<?php

define('BUNDLE_JS_SRC', get_template_directory_uri() . '/dist/bundle.js');
define('MAIN_CSS_SRC', get_template_directory_uri() . '/dist/style.css');










/*
        If you want different CSS for Arabic, you can do it like this.
        It will load Arabic CSS on an Arabic website.
        Just add this one line in the Timber class inside the function add_to_context( $context ).

            $context['current_lang'] = ICL_LANGUAGE_CODE;



        And inside the function assets( $twig ), do it like this:
    
            if (ICL_LANGUAGE_CODE == "ar") {
                wp_enqueue_style( 'main.css', MAIN_CSS_SRC_AR, array(), $cache_ver, 'all' );
            } else {
                wp_enqueue_style( 'main.css', MAIN_CSS_SRC, array(), $cache_ver, 'all' );  
            }
*/ 
