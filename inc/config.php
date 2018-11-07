<?php

/**
 * The base configuration for the Fox Agency theme
 **/

/**
 * Get the theme version from the stylesheet
 *
 * May seem pointless, but it avoids any
 * errors from changes later in the day
 *
 * @return string version
 */
function BLANKDOMAINNAME_theme_version(){
    $theme_details = wp_get_theme();
    return $theme_details->get('Version');
}


/**
 * Get the theme name from the stylesheet
 *
 * May seem pointless, but it avoids any
 * errors from changes later in the day
 *
 * @return string theme name
 */
function BLANKDOMAINNAME_theme_name(){
    $theme_details = wp_get_theme();
    return $theme_details->get('Name');
}


/**
 * Get the text domain from the stylesheet
 *
 * May seem pointless, but it avoids any
 * errors from changes later in the day
 *
 * @return string The text domain of the theme
 */
function BLANKDOMAINNAME_text_domain(){
    $theme_details = wp_get_theme();
    return $theme_details->get('TextDomain');
}


/**
 * Get the author from the stylesheet
 *
 * May seem pointless, but it avoids any
 * errors from changes later in the day
 *
 * @return string version
 */
function BLANKDOMAINNAME_theme_author(){
    $theme_details = wp_get_theme();
    return $theme_details->get('Author');
}


/**
 * Get the author URI from the stylesheet
 *
 * May seem pointless, but it avoids any
 * errors from changes later in the day
 *
 * @return string version
 */
function BLANKDOMAINNAME_theme_author_URL(){
    $theme_details = wp_get_theme();
    return $theme_details->get('AuthorURI');
}
