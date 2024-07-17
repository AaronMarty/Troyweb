<?php
/**
 * troyweb applicant functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package troyweb_applicant
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function troyweb_applicant_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on troyweb applicant, use a find and replace
		* to change 'troyweb-applicant' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'troyweb-applicant', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'troyweb-applicant' ),
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

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'troyweb_applicant_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
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
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'troyweb_applicant_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function troyweb_applicant_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'troyweb_applicant_content_width', 640 );
}
add_action( 'after_setup_theme', 'troyweb_applicant_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function troyweb_applicant_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'troyweb-applicant' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'troyweb-applicant' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'troyweb_applicant_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function troyweb_applicant_scripts() {
	wp_enqueue_style( 'troyweb-applicant-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'troyweb-applicant-style', 'rtl', 'replace' );

	wp_enqueue_script( 'troyweb-applicant-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
    if ( is_singular('applicant') ) {
        wp_enqueue_style( 'fontawesome-cdn', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css', array(), '5.13.1', 'all' );
        wp_enqueue_style( 'bootstrap-cdn', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.0/css/bootstrap.min.css', array(), '5.0.0', 'all' );
        wp_enqueue_style( 'single-applicant-style', get_template_directory_uri() . '/assets/applicant.css', array(), '1.0.0', 'all' );
    }
}
add_action( 'wp_enqueue_scripts', 'troyweb_applicant_scripts' );


/**
 * Register Custom Post Types
 */


// Register Custom Post Types and Taxonomies
function register_custom_post_types_and_taxonomies()
{
    // Register Applicant Post Type
    $applicant_labels = array(
        'name' => _x('Applicants', 'Post Type General Name', 'troyweb-applicant'),
        'singular_name' => _x('Applicant', 'Post Type Singular Name', 'troyweb-applicant'),
        'menu_name' => __('Applicants', 'troyweb-applicant'),
        'name_admin_bar' => __('Applicant', 'troyweb-applicant'),
        'archives' => __('Applicant Archives', 'troyweb-applicant'),
        'attributes' => __('Applicant Attributes', 'troyweb-applicant'),
        'parent_item_colon' => __('Parent Applicant:', 'troyweb-applicant'),
        'all_items' => __('All Applicants', 'troyweb-applicant'),
        'add_new_item' => __('Add New Applicant', 'troyweb-applicant'),
        'add_new' => __('Add New', 'troyweb-applicant'),
        'new_item' => __('New Applicant', 'troyweb-applicant'),
        'edit_item' => __('Edit Applicant', 'troyweb-applicant'),
        'update_item' => __('Update Applicant', 'troyweb-applicant'),
        'view_item' => __('View Applicant', 'troyweb-applicant'),
        'view_items' => __('View Applicants', 'troyweb-applicant'),
        'search_items' => __('Search Applicant', 'troyweb-applicant'),
        'not_found' => __('Not found', 'troyweb-applicant'),
        'not_found_in_trash' => __('Not found in Trash', 'troyweb-applicant'),
        'featured_image' => __('Featured Image', 'troyweb-applicant'),
        'set_featured_image' => __('Set featured image', 'troyweb-applicant'),
        'remove_featured_image' => __('Remove featured image', 'troyweb-applicant'),
        'use_featured_image' => __('Use as featured image', 'troyweb-applicant'),
        'insert_into_item' => __('Insert into applicant', 'troyweb-applicant'),
        'uploaded_to_this_item' => __('Uploaded to this applicant', 'troyweb-applicant'),
        'items_list' => __('Applicants list', 'troyweb-applicant'),
        'items_list_navigation' => __('Applicants list navigation', 'troyweb-applicant'),
        'filter_items_list' => __('Filter applicants list', 'troyweb-applicant'),
    );
    $applicant_args = array(
        'label' => __('Applicant', 'troyweb-applicant'),
        'description' => __('Applicant Description', 'troyweb-applicant'),
        'labels' => $applicant_labels,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'revisions'),
        'taxonomies' => array(),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-portfolio',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );
    register_post_type('applicant', $applicant_args);

    // Register Core Value Post Type
    $core_value_labels = array(
        'name' => _x('Core Values', 'Post Type General Name', 'troyweb-applicant'),
        'singular_name' => _x('Core Value', 'Post Type Singular Name', 'troyweb-applicant'),
        'menu_name' => __('Core Values', 'troyweb-applicant'),
        'name_admin_bar' => __('Core Value', 'troyweb-applicant'),
        'archives' => __('Core Value Archives', 'troyweb-applicant'),
        'attributes' => __('Core Value Attributes', 'troyweb-applicant'),
        'parent_item_colon' => __('Parent Core Value:', 'troyweb-applicant'),
        'all_items' => __('All Core Values', 'troyweb-applicant'),
        'add_new_item' => __('Add New Core Value', 'troyweb-applicant'),
        'add_new' => __('Add New', 'troyweb-applicant'),
        'new_item' => __('New Core Value', 'troyweb-applicant'),
        'edit_item' => __('Edit Core Value', 'troyweb-applicant'),
        'update_item' => __('Update Core Value', 'troyweb-applicant'),
        'view_item' => __('View Core Value', 'troyweb-applicant'),
        'view_items' => __('View Core Values', 'troyweb-applicant'),
        'search_items' => __('Search Core Value', 'troyweb-applicant'),
        'not_found' => __('Not found', 'troyweb-applicant'),
        'not_found_in_trash' => __('Not found in Trash', 'troyweb-applicant'),
        'featured_image' => __('Featured Image', 'troyweb-applicant'),
        'set_featured_image' => __('Set featured image', 'troyweb-applicant'),
        'remove_featured_image' => __('Remove featured image', 'troyweb-applicant'),
        'use_featured_image' => __('Use as featured image', 'troyweb-applicant'),
        'insert_into_item' => __('Insert into core value', 'troyweb-applicant'),
        'uploaded_to_this_item' => __('Uploaded to this core value', 'troyweb-applicant'),
        'items_list' => __('Core Values list', 'troyweb-applicant'),
        'items_list_navigation' => __('Core Values list navigation', 'troyweb-applicant'),
        'filter_items_list' => __('Filter core values list', 'troyweb-applicant'),
    );
    $core_value_args = array(
        'label' => __('Core Value', 'troyweb-applicant'),
        'description' => __('Core Value Description', 'troyweb-applicant'),
        'labels' => $core_value_labels,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'revisions'),
        'taxonomies' => array(),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-awards',
        'menu_position' => 6,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );
    register_post_type('core_value', $core_value_args);

    // Register Skills Taxonomy for Applicant Post Type
    $skills_labels = array(
        'name' => _x('Skills', 'Taxonomy General Name', 'troyweb-applicant'),
        'singular_name' => _x('Skill', 'Taxonomy Singular Name', 'troyweb-applicant'),
        'menu_name' => __('Skills', 'troyweb-applicant'),
        'all_items' => __('All Skills', 'troyweb-applicant'),
        'parent_item' => __('Parent Skill', 'troyweb-applicant'),
        'parent_item_colon' => __('Parent Skill:', 'troyweb-applicant'),
        'new_item_name' => __('New Skill Name', 'troyweb-applicant'),
        'add_new_item' => __('Add New Skill', 'troyweb-applicant'),
        'edit_item' => __('Edit Skill', 'troyweb-applicant'),
        'update_item' => __('Update Skill', 'troyweb-applicant'),
        'view_item' => __('View Skill', 'troyweb-applicant'),
        'separate_items_with_commas' => __('Separate skills with commas', 'troyweb-applicant'),
        'add_or_remove_items' => __('Add or remove skills', 'troyweb-applicant'),
        'choose_from_most_used' => __('Choose from the most used', 'troyweb-applicant'),
        'popular_items' => __('Popular Skills', 'troyweb-applicant'),
        'search_items' => __('Search Skills', 'troyweb-applicant'),
        'not_found' => __('Not Found', 'troyweb-applicant'),
        'no_terms' => __('No skills', 'troyweb-applicant'),
        'items_list' => __('Skills list', 'troyweb-applicant'),
        'items_list_navigation' => __('Skills list navigation', 'troyweb-applicant'),
    );
    $skills_args = array(
        'labels' => $skills_labels,
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
    );
    register_taxonomy('skills', array('applicant'), $skills_args);

    // Register Experience Taxonomy for Applicant Post Type
    $experience_labels = array(
        'name' => _x('Experience', 'Taxonomy General Name', 'troyweb-applicant'),
        'singular_name' => _x('Experience', 'Taxonomy Singular Name', 'troyweb-applicant'),
        'menu_name' => __('Experience', 'troyweb-applicant'),
        'all_items' => __('All Experience', 'troyweb-applicant'),
        'parent_item' => __('Parent Experience', 'troyweb-applicant'),
        'parent_item_colon' => __('Parent Experience:', 'troyweb-applicant'),
        'new_item_name' => __('New Experience Name', 'troyweb-applicant'),
        'add_new_item' => __('Add New Experience', 'troyweb-applicant'),
        'edit_item' => __('Edit Experience', 'troyweb-applicant'),
        'update_item' => __('Update Experience', 'troyweb-applicant'),
        'view_item' => __('View Experience', 'troyweb-applicant'),
        'separate_items_with_commas' => __('Separate experience with commas', 'troyweb-applicant'),
        'add_or_remove_items' => __('Add or remove experience', 'troyweb-applicant'),
        'choose_from_most_used' => __('Choose from the most used', 'troyweb-applicant'),
        'popular_items' => __('Popular Experience', 'troyweb-applicant'),
        'search_items' => __('Search Experience', 'troyweb-applicant'),
        'not_found' => __('Not Found', 'troyweb-applicant'),
        'no_terms' => __('No experience', 'troyweb-applicant'),
        'items_list' => __('Experience list', 'troyweb-applicant'),
        'items_list_navigation' => __('Experience list navigation', 'troyweb-applicant'),
    );
    $experience_args = array(
        'labels' => $experience_labels,
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
    );
    register_taxonomy('experience', array('applicant'), $experience_args);
}

// Hook into the 'after_setup_theme' action to register the custom post types and taxonomies
add_action('after_setup_theme', 'register_custom_post_types_and_taxonomies');


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

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}




/**
 * Add ACF field of Species.
 */

if( function_exists('acf_add_local_field_group') ) {

    acf_add_local_field_group(array(
        'key' => 'group_species',
        'title' => 'Species Information',
        'fields' => array(
            array(
                'key' => 'field_species',
                'label' => 'Species',
                'name' => 'species',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'applicant',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));

}

