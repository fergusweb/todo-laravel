<?php
/**
 * Global helper functions will go here.
 */


if (!function_exists('stripLeadingSlash')) {
    /**
     * Strip the leading slash from a string
     */
    function stripLeadingSlash($string) {
        return ltrim($string, '/');
    }
}
