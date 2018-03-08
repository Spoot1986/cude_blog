<?php
/*
 * Theme Customizer
 */

function cude_blog_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'cude_blog_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'cude_blog_customize_partial_blogdescription',
		) );

		$wp_customize->add_section('cude_settings' , array(
	        'title'    => __('Post/page settings', 'cude-blog'),
	        'priority' => 15
	    ));

		$wp_customize->add_setting('blog_title', array(
	  		'capability' => 'edit_theme_options',
	  		'default' => 'Blog Title',
	  		'sanitize_callback' => 'sanitize_text_field',
		));

		$wp_customize->add_control('blog_title', array(
		  'type' => 'input',
		  'section' => 'cude_settings',
		  'label' => __('Blog Title', 'cude-blog'),
		));

		$wp_customize->add_setting('blog_img', array(
	        'capability'        => 'edit_theme_options',
	        'sanitize_callback' => 'esc_url',
	        'default' => '',
	    ));

	    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'blog_img', array(
	        'label'    => __('Blog Image', 'cude-blog'),
	        'section'  => 'cude_settings',
	        'settings' => 'blog_img',
	    )));

		$wp_customize->add_setting('blog_tax', array(
	        'capability' => 'edit_theme_options',
	     	'default' => '',
	     	'sanitize_callback' => 'cude_blog_sanitize_checkbox',
	    ));

	    $wp_customize->add_control('blog_tax', array(
	        'settings' => 'blog_tax',
	        'label'    => __('Hide Categoty and Tags', 'cude-blog'),
	        'section'  => 'cude_settings',
	        'type'     => 'checkbox',
	    ));

	    $wp_customize->add_setting('blog_date', array(
	        'capability' => 'edit_theme_options',
	        'default' => '',
	        'sanitize_callback' => 'cude_blog_sanitize_checkbox',
	    ));

	    $wp_customize->add_control('blog_date', array(
	        'settings' => 'blog_date',
	        'label'    => __('Hide publication date', 'cude-blog'),
	        'section'  => 'cude_settings',
	        'type'     => 'checkbox',
	    ));

	    $wp_customize->add_setting('blog_img_dpp', array(
	        'capability' => 'edit_theme_options',
	        'default' => '',
	        'sanitize_callback' => 'cude_blog_sanitize_checkbox',
	    ));

	    $wp_customize->add_control('blog_img_dpp', array(
	        'settings' => 'blog_img_dpp',
	        'label'    => __('Use blog image as post/page featured image', 'cude-blog'),
	        'section'  => 'cude_settings',
	        'type'     => 'checkbox',
	    ));

	}
}
add_action( 'customize_register', 'cude_blog_customize_register' );


function cude_blog_customize_partial_blogname() {
	bloginfo( 'name' );
}

function cude_blog_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

function cude_blog_customize_preview_js() {
	wp_enqueue_script( 'cude-blog-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'cude_blog_customize_preview_js' );


//Sanitize Checkbox
function cude_blog_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}
