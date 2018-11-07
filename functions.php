<?php

/**
 * Get all theme vars
 */
require get_template_directory() . '/inc/config.php';

/**
 * Get all theme vars
 */
require get_template_directory() . '/inc/theme_support.php';

/**
 * Get all essential helper functions
 */
require get_template_directory() . '/inc/helpers/helpers.php';

/**
 * Get all transient functions
 */
require get_template_directory() . '/inc/transients.php';

/**
 * Remove excess frontend script
 */
require get_template_directory() . '/inc/cleanup.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/version.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/enqueue_scripts.php';

/**
 * Custom post type loader
 */
require get_template_directory() . '/inc/cpt/load_cpts.php';

/**
 * Load all ACF functions
 */
require get_template_directory() . '/inc/acf/acf_init.php';

/**
 * Load all Gravity Forms functions
 */
require get_template_directory() . '/inc/gravity_forms.php';

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
 * Dashboard customizations
 */
require get_template_directory() . '/inc/dashboard.php';
