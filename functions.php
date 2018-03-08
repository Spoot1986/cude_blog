<?php
/*
 * cude blog functions and definitions
 */

if (!function_exists('cude_blog_setup')) :

	function cude_blog_setup() {

		load_theme_textdomain( 'cude-blog', get_template_directory() . '/languages' );
		
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );

		register_nav_menus(array('menu-1' => esc_html__( 'Primary', 'cude-blog' ),));

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support( 'custom-background', apply_filters( 'cude_blog_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;

add_action( 'after_setup_theme', 'cude_blog_setup' );

function cude_blog_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'cude_blog_content_width', 640 );
}
add_action( 'after_setup_theme', 'cude_blog_content_width', 0 );

function cude_blog_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'cude-blog' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'cude-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<p class="widget-title">',
		'after_title'   => '</p>',
	));

	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'cude-blog' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'cude-blog' ),
		'before_widget' => '<div id="%1$s" class="footer_widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="title_widget"><p>',
		'after_title'   => '</p></div>',
	));
}
add_action( 'widgets_init', 'cude_blog_widgets_init' );

//Enqueue scripts and styles.
function cude_blog_scripts() {
	wp_enqueue_style('cude-blog-style', get_stylesheet_uri());
	wp_enqueue_style('sidr', get_template_directory_uri().'/css/jquery.sidr.light.min.css');
	wp_enqueue_style('font-awesome', get_template_directory_uri().'/css/font-awesome.css');
	wp_enqueue_style('mediascreen', get_template_directory_uri().'/css/mediascreen.css');

	wp_enqueue_script('jquery');
	wp_enqueue_script('sidr', get_template_directory_uri().'/js/jquery.sidr.min.js');
	wp_enqueue_script('scripts', get_template_directory_uri().'/js/scripts.js');

	if (is_singular() && comments_open() && get_option('thread_comments')){
		wp_enqueue_script('comment-reply');
	}
	
}
add_action( 'wp_enqueue_scripts', 'cude_blog_scripts' );


require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/customizer.php';