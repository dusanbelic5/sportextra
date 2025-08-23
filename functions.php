<?php
/**
 * Sport Extra functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Sport Extra
 */

 wp_enqueue_script('jQuery');
 if ( ! defined( '_S_VERSION' ) ) {
	 // Replace the version number of the theme on each release.
	 define( '_S_VERSION', time() );
 }
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sportExtra_setup() {

	add_theme_support( "title-tag" );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'blog-main-post', 500, 500 ); // 220 pixels wide by 180 pixels tall, soft proportional crop mode

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary', 'sport-extra' ),
		    'footer' => esc_html__('Footer', 'sport-extra'),
			'fixed' => esc_html__('Fixed', 'sport-extra')
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);



	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 94,
			'width'       => 11,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'sportExtra_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sport_extra_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'sport_extra_content_width', 640 );
}
add_action( 'after_setup_theme', 'sport_extra_content_width', 0 );


/**
 * Enqueue scripts and styles.
 */
function sport_extra_scripts() {
	wp_enqueue_style( 'sport-extra-style', get_stylesheet_uri(), array(), _S_VERSION );

	wp_enqueue_script( 'sport-extra-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	//wp_enqueue_script( 'sport-extra-tiny-slider', get_template_directory_uri() . '/js/tiny-slider.min.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sport_extra_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';




add_action('init','register_all_blocks');


// Block connection

function register_all_blocks(){

	$blocks = glob(__DIR__.'/blocks/*');
	foreach ($blocks as $block){
		if (is_dir( $block )){
			register_block_type( $block );
		}
	}

}



/* Gutenberg block category */

function add_block_category( $categories ) {
    return array_merge(
        $categories,
        [
            [
                'slug'  => 'sport-extra',
                'title' => __( 'Sport Extra', 'sport-extra' ),
            ],
        ]
    );
}
add_action( 'block_categories', 'add_block_category', 10, 2 );





remove_action( 'wp_enqueue_scripts', 'wp_enqueue_classic_theme_styles' );


//Remove Gutenberg Block Library CSS from loading on the frontend
function smartwp_remove_wp_block_library_css(){
 wp_dequeue_style( 'wp-block-library' );
 wp_dequeue_style( 'wp-block-library-theme' );
 wp_dequeue_style( 'wc-blocks-style' ); // Remove WooCommerce block CSS
} 
add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );





function insert_jquery_in_header(){
	wp_enqueue_script('jquery', false, array(), false, false);
}
add_filter('wp_enqueue_scripts','insert_jquery_in_header',1);




    function currentYear(){
        return date('Y');
    }





	add_action('admin_init', function () {
		// Redirect any user trying to access comments page
		global $pagenow;
		 
		if ($pagenow === 'edit-comments.php') {
			wp_safe_redirect(admin_url());
			exit;
		}
	 
		// Remove comments metabox from dashboard
		remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
	 
		// Disable support for comments and trackbacks in post types
		foreach (get_post_types() as $post_type) {
			if (post_type_supports($post_type, 'comments')) {
				remove_post_type_support($post_type, 'comments');
				remove_post_type_support($post_type, 'trackbacks');
			}
		}
	});
	 
	// Close comments on the front-end
	add_filter('comments_open', '__return_false', 20, 2);
	add_filter('pings_open', '__return_false', 20, 2);
	 
	// Hide existing comments
	add_filter('comments_array', '__return_empty_array', 10, 2);
	 
	// Remove comments page in menu
	add_action('admin_menu', function () {
		remove_menu_page('edit-comments.php');
	});
	 
	// Remove comments links from admin bar
	add_action('init', function () {
		if (is_admin_bar_showing()) {
			remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
		}
	});


	
	add_filter('walker_nav_menu_start_el', function($item_output, $item, $depth, $args) {
		if (isset($args->theme_location) && $args->theme_location === 'fixed') {
			
			if ($item->object === 'category') {
				$icon = get_field('category_icon', 'category_' . $item->object_id);
	
				// If it's an array, get the 'url' key
				if (is_array($icon) && isset($icon['url'])) {
					$icon_url = $icon['url'];
				} elseif (is_string($icon)) {
					$icon_url = $icon;
				} else {
					$icon_url = '';
				}
	
				if (!empty($icon_url)) {
					$icon_html = '<img src="' . esc_url($icon_url) . '" alt="" class="menu-category-icon" />';
					// Insert inside the link, before the category name
					$item_output = preg_replace('/(<a\b[^>]*>)(.*)/i', '$1' . $icon_html . '$2', $item_output);
				}
			}
		}
		return $item_output;
	}, 10, 4);
	