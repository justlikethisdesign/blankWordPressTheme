<?php

/**
 * Enqueue all JS scripts
 *
 * This function is used to contain all JS scripts
 * needed to be included within the theme. It will
 * add all scripts into an array and pass to the
 * minifier/basic enqueuer
 */

function BLANKDOMAINNAME_enqueue_scripts(){

    global $wp_query;

    /**
     * Set up any localisation values
     *
     * All localisation is applied to theme-script script. This is to encourage the use of the minifier.
     * If the site is being run without minification, the main code must be called theme-script
     **/

    $debug = false;
    if (defined('WP_DEBUG') && true === WP_DEBUG) {
        $debug = true;
    }

    $localize_this = array (
        //General Data
        'ajax_url'                  => admin_url('admin-ajax.php'), //Standard ajax init
        'base_url'                  => site_url(),
        'img_url'                   => get_stylesheet_directory_uri() . '/assets/img/',
        'security'                  => wp_create_nonce('custom_theme_nonce'),
    );


    //Set the JS directory for this theme
    $JS_theme_dir           = get_stylesheet_directory_uri() . '/assets/js/';
    $JS_direct_path         = get_stylesheet_directory() . '/assets/js/';
    $JS_conditional_path    = get_stylesheet_directory_uri() . '/assets/js/front/conditionals/';

    /**
     * Scripts to be added in the header
     **/

    /**
    * Load Respond.js
    *
    * This allows responsive web design to work on IE 6-8. Run before all scripts to ensure it
    */
    wp_enqueue_script(
        'respond',
        $JS_conditional_path . 'respond.min.js',
        false ,
        '1.4.2',
        false
    );
    wp_script_add_data( 'respond', 'conditional', 'lt IE 9' ); //Add the condition to show if below IE9


    /**
    * Load HTML5 Shiv
    *
    * Allows the use of HTML in legacy IE
    */
    wp_enqueue_script(
        'html5_shiv',
        $JS_conditional_path . 'html5shiv.js',
        false ,
        '3.7.3',
        false
    );
    wp_script_add_data( 'html5_shiv', 'conditional', 'lt IE 9' ); //Add the condition to show if below IE9


    /**
     * Javascript Enqueuing
     *
     * If Debug is set, the file that is enqueued is an unminified
     *
     * The file is unminified, but compressed. The version number applied is also specific for a debug file.
     * This means when it goes live the version is smaller, and related to actual production versions.
     **/

    if ( $debug ){

        wp_enqueue_script(
            'theme_head_debug',
            $JS_theme_dir . 'head.js',
            BLANKDOMAINNAME_get_file_version_number( 'theme_head_debug', $JS_direct_path . 'head.js' ),
            false
        );

        wp_enqueue_script(
            'theme_script_debug',
            $JS_theme_dir . 'app.js',
            array('jquery'),
            BLANKDOMAINNAME_get_file_version_number( 'theme_script_debug', $JS_direct_path . 'app.js' ),
            false
        );
        wp_localize_script( 'theme_script_debug', 'theme_script_ajax', $localize_this );

    } else {

        wp_enqueue_script(
            'theme_head',
            $JS_theme_dir . 'head.min.js',
            BLANKDOMAINNAME_get_file_version_number( 'theme_head', $JS_direct_path . 'head.min.js' ),
            false
        );

        wp_enqueue_script(
            'theme_script',
            $JS_theme_dir . 'app.min.js',
            array('jquery'),
            BLANKDOMAINNAME_get_file_version_number( 'theme_script', $JS_direct_path . 'app.min.js' ),
            false
        );
        wp_localize_script( 'theme_script', 'theme_script_ajax', $localize_this );

    }

}
add_action( 'wp_enqueue_scripts', 'BLANKDOMAINNAME_enqueue_scripts' );


/**
* Dequeue jQuery Migrate script in WordPress.
*/
function BLANKDOMAINNAME_remove_jquery_migrate( &$scripts) {
    if(!is_admin()) {
        $scripts->remove( 'jquery');
    }
}
add_filter( 'wp_default_scripts', 'BLANKDOMAINNAME_remove_jquery_migrate' );


function enqueue_latest_jquery() {
    wp_deregister_script( 'wp-embed' ); // Remove functionality to embed other blogs
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js', false, NULL, true);
}
add_action('wp_enqueue_scripts', 'enqueue_latest_jquery');


/**
 * Add fallback for Jquery from CDN - local
 */

function jquery_cdn_fallback(){
    $fallback_url = get_stylesheet_directory_uri() . '/assets/js/fallback/jquery.min.js';
    echo "<script type='text/javascript'>
       if(!window.jQuery){
         var script = document.createElement('script');
         script.src = '" . $fallback_url . "';
         script.setAttribute('defer','defer');
         document.head.appendChild(script);
       }
    </script>";
}
add_action( 'wp_footer', 'jquery_cdn_fallback',20 );


/**
 * Add CSS styles to admin
 *
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
 **/
function BLANKDOMAINNAME_enqueue_admin_css_styles(){

    //Set the theme directory
    $CSS_theme_dir      = get_stylesheet_directory_uri() . '/assets/css/';

    wp_enqueue_style(
        'BLANKDOMAINNAME_admin',
        $CSS_theme_dir . 'admin-css.css',
        false,
        '1',
        false
    );

}
add_action( 'admin_enqueue_scripts', 'BLANKDOMAINNAME_enqueue_admin_css_styles' );


/**
 * Add JS scripts to admin
 *
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
 **/

function BLANKDOMAINNAME_enqueue_admin_js_scripts(){

    //Set the theme directory
    $JS_theme_dir   = get_stylesheet_directory_uri() . '/assets/js/admin/custom/';
    $JS_direct_path = get_stylesheet_directory() . '/assets/js/admin/custom/';

    $localize_this = array (
        //General Data
        'ajax_url' => admin_url('admin-ajax.php'), //Standard ajax init
    );

    wp_enqueue_script(
        'BLANKDOMAINNAME_media_libary_svg',
        $JS_theme_dir . 'media-libary-svg.js',
        false,
        '1',
        true
    );
    wp_localize_script( 'BLANKDOMAINNAME_media_libary_svg', 'theme_script_ajax', $localize_this );

}
add_action( 'admin_enqueue_scripts', 'BLANKDOMAINNAME_enqueue_admin_js_scripts' );


/**
 * Defer all scripts
 */

 function add_defer_attribute($tag, $handle) {
    // add script handles to the array below
    $scripts_to_defer = array(

        'jquery',
        
        'theme_script',
        'theme_script_debug',

        //GF Form Stuff
        'gform_conditional_logic',
        'gform_datepicker_init',
        'gform_gravityforms',
        'plupload-all',
        'gform_json',
        'gform_textarea_counter',
        'gform_masked_input',
        'gform_chosen',
        'chosen',
        'gform_placeholder',


    );

    foreach($scripts_to_defer as $defer_script) {
       if ($defer_script === $handle) {
          return str_replace(' src', ' defer="defer" src', $tag);
       }
    }
    return $tag;
 }
 add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);
