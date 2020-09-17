<?php

/**
 * Raccourcis de htmlentites
 *
 * @param  string $string
 * @return string
 */
function e (string $string ){
    return htmlentities($string);
}