<?php

use Timber\Site;

class StarterSite extends Site {

	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );

		add_action( 'init', 'disable_wp_emojicons' );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		add_action( 'init', array( $this, 'register_acf_blocks' ) );
		add_action('inline_file', array($this, 'inline_file'));
        add_action( 'wp_enqueue_scripts', array( $this, 'assets' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'bs_dequeue_dashicons' ) );
		 
		if( function_exists('acf_add_options_page') ) {
            acf_add_options_sub_page('Theme');
            acf_add_options_sub_page('Analytics/Tracking');
        }


        add_filter( 'emoji_svg_url', '__return_false' );
		add_filter( 'timber/context', array( $this, 'add_to_context' ) );
		add_filter( 'timber/twig', array( $this, 'add_to_twig' ) );
		add_filter( 'timber/twig/environment/options', [ $this, 'update_twig_environment_options' ] );
        add_filter( 'upload_mimes', array($this, 'svg_mime_types' ));


		// Comment out to Enable oEmbed (responsible for embedding twitter etc)
		remove_action('wp_head', 'wp_oembed_add_discovery_links', 10 );
		remove_action('wp_head', 'wp_oembed_add_host_js');
		remove_action('rest_api_init', 'wp_oembed_register_route');
		remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

		// Header Removal
		remove_action('wp_head', 'rsd_link');
		remove_action('wp_head', 'wlwmanifest_link');
		remove_action('wp_head', 'wp_generator'); // Hide WP Version for security
		remove_action('wp_head', 'wp_shortlink_wp_head');
		remove_action('wp_head', 'rest_output_link_wp_head', 10); //Remove wp-json/ link
		
		add_action('admin_head', array($this, 'fix_svg_thumb_display'));


        require_once('toggle_acf_edit.php');

		if (!$showacf) {
            require_once('acf-edit-screen-disabler.php');
            if (function_exists('get_field')) {
                if (!get_field('enable_acf_edit', 'option')) {
                    add_filter('acf/settings/show_admin', '__return_false');
                    //DO NOT COMMENT OUT OR DISABLE USE THEME OPTIONS TICK BOX INSTEAD
                }
            }
        }

		parent::__construct();
	}

	
	public function register_post_types() {
		// This is where you can register custom post types
	}
	 
	public function register_taxonomies() {
		// This is where you can register custom taxonomies.
	}


	function register_acf_blocks() {
        if ( ! function_exists( 'acf_register_block' ) ) {
            return;
        }     
    }


	/**
	 * This is where you add some context
	 *
	 * @param string $context context['this'] Being the Twig's {{ this }}.
	 */
	public function add_to_context( $context ) {
		$context['foo']   = 'bar';
		$context['stuff'] = 'I am a value set in your functions.php file';
		$context['notes'] = 'These values are available everytime you call Timber::context();';

		$context['menu']  = Timber::get_menu();
		$context['header']  = Timber::get_menu('Header');
		$context['site']  = $this;

		if (function_exists('get_fields')) {
            $context['options'] = get_fields('option');
        }

		$context['page_stats'] = Timber\Helper::start_timer();
		return $context;
	}



	
	public function theme_supports() {
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		// add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'script',
				'style',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'audio',
			)
		);

		add_theme_support( 'menus' );
	}

 

	/**
	 * This is where you can add your own functions to twig.
	 *
	 * @param Twig\Environment $twig get extension.
	 */
	public function add_to_twig( $twig ) {
		/**
		 * Required when you want to use Twig’s template_from_string.
		 * @link https://twig.symfony.com/doc/3.x/functions/template_from_string.html
		 */
		// $twig->addExtension( new Twig\Extension\StringLoaderExtension() );
		// $twig->addFilter( new Twig\TwigFilter( 'myfoo', [ $this, 'myfoo' ] ) );

		$twig->addFunction( new Twig\TwigFunction('query_cat', array($this, 'query_cat')));
		return $twig;
	}



	  /**
     * Query Cat
     * Queries passed category id's and limits results to passed limit
     *
     * This is registered as a Timber function and can be called in templates
     * with the following syntax:
     *
     *      {{ query_cat([1, 2, 3], 3) }}
     *
     * This would return posts in categories 1, 2, or 3 and limit the response
     * to 3 results.
     */
    function query_cat(
        $cats = [],
        $limit = 3,
        $post_type = 'any',
        $orderby = 'date',
        $offset = 0,
        $exclude = []
    ) {
        return Timber::get_posts(array(
            'post_type' => $post_type,
            'cat' => $cats,
            'posts_per_page' => $limit,
            'orderby' => $orderby,
            'offset' => $offset,
            'post__not_in' => $exclude
        ));
    }



	
    function fix_svg_thumb_display() {
		echo '<style> td.media-icon img[src$=".svg"], img[src$=".svg"].attachment-post-thumbnail { width: 100% !important; height: auto !important; } </style>';
		// Limits sizes of SVGs in WordPress backend
    }
  


    function svg_mime_types( $mimes ) {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
		
	  /*Allows SVGs to be uploaded in the wordpress media library*/
		
    }



    function inline_file($path) {
        if ( $path ) {
            echo file_get_contents($_SERVER['DOCUMENT_ROOT'] . parse_url($path)['path']);
        }

		
		/*      Inline File
		 		 This action will echo the contents of a file when passed a relative path, ath
		 		 the point the function was called.
		 		 The intended use of this function is for inlining files within templates, for
		 		 example: embedding an SVG.
		 */
	
    }



	
    function assets( $twig ) {
       
        wp_deregister_script('jquery');  // Remove Wp's jQuery
        require_once 'enqueues.php';
        require('cache_bust.php');

        wp_enqueue_script( 'essential.js', BUNDLE_JS_SRC, array(), $cache_ver, true);  
        wp_enqueue_style( 'main.css', MAIN_CSS_SRC, array(), $cache_ver, 'all' );  
    }


    function bs_dequeue_dashicons() {
		if ( ! is_user_logged_in() ) {
			wp_deregister_style( 'dashicons' );
		}
	}


	/**
	 * Updates Twig environment options.
	 *
	 * @link https://twig.symfony.com/doc/2.x/api.html#environment-options
	 *
	 * \@param array $options An array of environment options.
	 *
	 * @return array
	 */
	function update_twig_environment_options( $options ) {
	    // $options['autoescape'] = true;

	    return $options;
	}

}
