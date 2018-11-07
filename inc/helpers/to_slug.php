<?php

function to_slug( $name ){
    //Remove spaces
    $name = str_replace(' ', '-', $name);
    // convert the string to all lowercase
    $slug = strtolower($name);
    return $slug;
}
