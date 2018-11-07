<?php

/**
 * Check that the acf class exists
 *
 * Returns true or false, depending on existance
 **/

function is_acf_installed(){
    if( class_exists('acf') ) {
        return true;
    }
    return false;
}


/**
 * Check that ACF is installed correctly.
 * If the class is not found this will display an error in the admin area
 */

function acf_check_include() {
    if( !is_acf_installed() ) {
        $class = "error";
        $message = "ACF is not installed, install before continuing";
            echo"<div class=\"$class\"> <p>$message</p></div>";
    }
}
add_action( 'admin_notices', 'acf_check_include' );


/**
 * This file includes all ACF functions
 **/

if( is_acf_installed() ) {

    //Set the save/load location for ACF JSON files
    include ( 'json/json.php' );

    include ( 'assets/gravity_forms.php' );

}
