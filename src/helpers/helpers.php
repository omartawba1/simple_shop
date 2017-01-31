<?php

if (!function_exists("getFloat")) {
    /**
     * Get the float value from string
     * 
     * @param $str
     *
     * @return float
     */
    function getFloat($str)
    {
        if (strstr($str, ",")) {
            $str = str_replace(".", "", $str); // replace dots (thousand seps) with blancs 
            $str = str_replace(",", ".", $str); // replace ',' with '.' 
        }
        
        if (preg_match("#([0-9\.]+)#", $str, $match)) { // search for number that may contain '.' 
            return floatval($match[0]);
        } else {
            return floatval($str); // take some last chances with floatval 
        }
    }
}

if (!function_exists("sort_by_price")) {
    /**
     * Sorting multidimensional array according to price index 'USing it as a callback function'
     * 
     * @param $a
     * @param $b
     *
     * @return bool
     */
    function sort_by_price($a, $b)
    {
        return $a["price"] > $b["price"] ? true : false;
    }
}
