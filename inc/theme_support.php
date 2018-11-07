<?php
/**
 * BLANKDOMAINNAME functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package BLANKDOMAINNAME
 */

if ( ! function_exists( 'BLANKDOMAINNAME_setup' ) ) {

    /**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function BLANKDOMAINNAME_setup() {

        /*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on BLANKDOMAINNAME, use a find and replace
		 * to change 'BLANKDOMAINNAME' to the name of your theme in all the template files.
		 */

        load_theme_textdomain( BLANKDOMAINNAME_text_domain(), get_template_directory() . '/languages' );


		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'BLANKDOMAINNAME' ),
		) );


    	/*
    	 * Let WordPress manage the document title.
    	 * By adding theme support, we declare that this theme does not use a
    	 * hard-coded <title> tag in the document head, and expect WordPress to
    	 * provide it for us.
    	 */
    	add_theme_support( 'title-tag' );


        // Add default posts and comments RSS feed links to head
        add_theme_support( 'automatic-feed-links' );


        /*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );


        //Add HTML5 and all the good stuff
        add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'widgets' ) );

        /*
        * Enable support for Post Formats.
        *
        * @link https://codex.wordpress.org/Post_Formats
        * @link https://codex.wordpress.org/Function_Reference/add_theme_support
        */

        add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'status', 'image', 'video', 'audio', 'quote' ) );


        /** Remove default gallery styling **/

        add_filter( 'use_default_gallery_style', '__return_false' );


        /**
         * Support Microdata being added to WordPress
         *
         * @link https://core.trac.wordpress.org/ticket/30783
         */

        add_theme_support( 'microformats2' );
        add_theme_support( 'microformats' );
        add_theme_support( 'microdata' );


        // Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

    }

}
add_action( 'after_setup_theme', 'BLANKDOMAINNAME_setup' );



/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function BLANKDOMAINNAME_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'BLANKDOMAINNAME' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'BLANKDOMAINNAME' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'BLANKDOMAINNAME_widgets_init' );
