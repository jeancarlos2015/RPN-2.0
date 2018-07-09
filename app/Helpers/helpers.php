<?php

function replace($url) {

    $url = preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $url ) );
    $url = strtolower($url);
    return $url;
}

