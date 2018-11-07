<?php

/*
 * Enable or disable confirmation anchor functionality
 *
 * For more info:
 * https://www.gravityhelp.com/documentation/article/gform_confirmation_anchor/
 */

add_filter( 'gform_confirmation_anchor', '__return_true' );     // Enables confirmation on all forms
//add_filter( 'gform_confirmation_anchor_2', '__return_false' );  // Diable confirmation for specific form


/*
 * Add custom AJAX spinner
 *
 * For more info:
 * https://www.gravityhelp.com/documentation/article/gform_ajax_spinner_url
 *
 */

add_filter( 'gform_ajax_spinner_url', 'fox_custom_g_forms_spinner' );



/**
 * Hide Input Field Label
 *
 * Add the setting to allow field labels on inputs
 * to be removed in field options
 **/

add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

/*
 * Changes the default Gravity Forms AJAX spinner to a transparent gif
 *
 * This allows us to a CSS spinner - stored in essentials
 * *
 * @param string $src  The default spinner URL.
 * @return string $src The new spinner URL.
 */

function fox_custom_g_forms_spinner( $src ) {
    return  'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';
}


/**
 * Filters the next, previous and submit buttons.
 * Replaces the forms <input> buttons with <button> while maintaining attributes from original <input>.
 * @param string $button Contains the <input> tag to be filtered.
 * @param object $form Contains all the properties of the current form.
 * @return string The filtered button.
 */

add_filter( 'gform_next_button', 'input_to_button', 10, 2 );
add_filter( 'gform_previous_button', 'input_to_button', 10, 2 );
add_filter( 'gform_submit_button', 'input_to_button', 10, 2 );
function input_to_button( $button, $form ) {
    $dom = new DOMDocument();
    $dom->loadHTML( $button );
    $input = $dom->getElementsByTagName( 'input' )->item(0);
    $new_button = $dom->createElement( 'button' );
    $button_span = $dom->createElement( 'span', $input->getAttribute( 'value' ) );
    $new_button->appendChild( $button_span );
    $input->removeAttribute( 'value' );
    foreach( $input->attributes as $attribute ) {
        $new_button->setAttribute( $attribute->name, $attribute->value );
    }
    $new_button->setAttribute( 'class', "btn btn--form" );
    $input->parentNode->replaceChild( $new_button, $input );
    return $dom->saveHtml( $new_button );
}


//Check if Gravity form Exists
function fox_gravity_form_exists($form_id){

    //If Gravity Forms Exists
    if ( class_exists( 'GFCommon' ) ) {
        $forms = GFFormsModel::get_forms();
        foreach($forms as &$form){
            if ($form->id == $form_id) {
                return true;
            }
        }
    }
    return false;
}



/**
 * Defer Gravity Forms Ajax Jquery until after Jquery Load
 * @link https://medium.com/@nasser.abouelazm/dealing-with-problem-scripts-in-gravity-forms-973c7d0ddb56
 */

 function defer_gravityforms_ajax( $confirmation, $form, $entry, $ajax ) {
     if ( $ajax && $form['confirmation']['type'] == 'redirect' ) {
         $confirmation = "<script>function gformRedirect(){document.location.href='" . $form['confirmation']['url'] . "';}</script>";
     }
     return $confirmation;
 }
add_filter( 'gform_confirmation', 'defer_gravityforms_ajax' );


/**
 * Dont fire forms jquery until after DOM load
 */

function wrap_gform_cdata_open( $content = '' ) {
    $content = 'document.addEventListener( "DOMContentLoaded", function() {';
    return $content;
}

function wrap_gform_cdata_close( $content = '' ) {
    $content = ' }, false );';
    return $content;
}

add_filter( 'gform_cdata_open','wrap_gform_cdata_open' );
add_filter( 'gform_cdata_close','wrap_gform_cdata_close' );
