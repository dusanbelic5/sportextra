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
			'footer-categories' => esc_html__('Footer Categories', 'sport-extra'),
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

add_filter( 'widget_text', 'do_shortcode' );



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
	



// Register widget areas
function sport_extra_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Single Post Sidebar', 'sport-extra' ),
        'id'            => 'single-sidebar',
        'description'   => __( 'Single post sidebar for the Sport Extra theme.', 'sport-extra' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">', 
        'after_widget'  => '</div>', 
        'before_title'  => '<h3 class="widget-title">', 
        'after_title'   => '</h3>', 
    ) );
}
add_action( 'widgets_init', 'sport_extra_widgets_init' );



// Shortcode for tag related posts
function se_related_posts_by_tags_shortcode( $atts ) {
    global $post;

    // Ensure we're on a single post
    if ( ! is_singular( 'post' ) || ! isset( $post->ID ) ) {
        return '';
    }

    // Get current post tags
    $tags = wp_get_post_tags( $post->ID, array( 'fields' => 'ids' ) );
    if ( empty( $tags ) ) {
        return '';
    }

    // Query last 4 posts with same tags
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 4,
        'post__not_in'   => array( $post->ID ),
        'tag__in'        => $tags,
        'orderby'        => 'date',
        'order'          => 'DESC',
    );
    $related_query = new WP_Query( $args );

    // Build output
    $output = '<div class="se-related-posts-single"><div class="se-related-posts-single-title-section"><p class="h4">Extra vesti</p></div>';
    if ( $related_query->have_posts() ) {
        while ( $related_query->have_posts() ) {
            $related_query->the_post();

            $output .= '<article class="se-related-post-single">';

            // ✅ Image wrapped in link
            if ( has_post_thumbnail() ) {
                $output .= '<a href="' . get_the_permalink() . '" class="se-related-thumb">'
                        . get_the_post_thumbnail( get_the_ID(), 'thumbnail' )
                        . '</a>';
            }

            // ✅ Title wrapped in link
            $output .= '<p class="h4 se-related-title">'
                    . '<a href="' . get_the_permalink() . '">' . get_the_title() . '</a>'
                    . '</p>';

            $output .= '</article>';
        }
    } else {
        $output .= '';
    }
    $output .= '</div>';

    wp_reset_postdata();

    return $output;
}
add_shortcode( 'related_posts_by_tags', 'se_related_posts_by_tags_shortcode' );



// Shortcode for social icons on single post
function social_links_shortcode( $atts ) {
    // Get fields from ACF options page
	$heading = get_field('heading', 'option');
    $facebook  = get_field( 'facebook', 'option' );
    $instagram = get_field( 'instagram', 'option' );
	$youtube  = get_field( 'youtube', 'option' );
    $tiktok = get_field( 'tiktok', 'option' );


    $output = '<div class="se-widget-social-links"><div class="se-widget-social-links-heading-section"><p class="h4">'.$heading.'</p></div>';

	if ( $instagram ) {
		$output .= '<div class="se-widget-social-links-list"><a href="' . esc_url( $instagram ) . '" target="_blank" rel="noopener" aria-label="Instagram">';
		$output .= '<img src="' . get_template_directory_uri() . '/img/instagram-icon.svg" height="24" width="24" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" class="style-svg"/>';
		$output .= '</a>';
	}

	if ( $facebook ) {
		$output .= '<a href="' . esc_url( $facebook ) . '" target="_blank" rel="noopener" aria-label="Facebook">';
		$output .= '<img src="' . get_template_directory_uri() . '/img/facebook-icon.svg" height="15" width="32" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" class="style-svg"/>';
		$output .= '</a>';
	}

	if ( $youtube ) {
		$output .= '<a href="' . esc_url( $youtube ) . '" target="_blank" rel="noopener" aria-label="YouTube">';
		$output .= '<img src="' . get_template_directory_uri() . '/img/youtube-icon.svg" height="15" width="32" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" class="style-svg"/>';
		$output .= '</a>';
	}

	if ( $tiktok ) {
		$output .= '<a href="' . esc_url( $tiktok ) . '" target="_blank" rel="noopener" aria-label="TikTok">';
		$output .= '<img src="' . get_template_directory_uri() . '/img/tiktok-icon.svg" height="15" width="32" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" class="style-svg"/>';
		$output .= '</a></div>';
	}

    $output .= '</div>';

    return $output;
}
add_shortcode( 'social_links', 'social_links_shortcode' );

function sport_extra_archive_posts_per_page( $query ) {
    if ( ! is_admin() && $query->is_main_query() && is_archive() ) {
        $query->set( 'posts_per_page', 5 );
    }
}
add_action( 'pre_get_posts', 'sport_extra_archive_posts_per_page' );

function sport_extra_enable_comments() {
    add_post_type_support( 'post', 'comments' );
}
add_action( 'init', 'sport_extra_enable_comments' );


function se_remove_comment_url_field( $fields ) {
    if ( isset( $fields['url'] ) ) {
        unset( $fields['url'] );
    }
    return $fields;
}
add_filter( 'comment_form_default_fields', 'se_remove_comment_url_field' );


add_image_size('featured_news_image', 441, 248, true);
add_image_size('image_lazy', 44, 25, true);

add_image_size('posts_featured_image', 324, 182, true );


function se_custom_archive_posts_per_page( $query ) {

    if ( ! is_admin() && $query->is_main_query() && $query->is_archive() ) {
        $query->set( 'posts_per_page', 8 );
    }

}
add_action( 'pre_get_posts', 'se_custom_archive_posts_per_page' );