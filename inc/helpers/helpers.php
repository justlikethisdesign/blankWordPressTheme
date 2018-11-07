<?php

/**
 * Folder directory to loop through
 **/

$path = get_stylesheet_directory() . '/inc/helpers';


/**
 * Loop through the specified folder and include
 * all PHP files.
 **/

foreach(glob( $path . '/*', GLOB_NOSORT) as $filename){
    require_once $filename;
}
