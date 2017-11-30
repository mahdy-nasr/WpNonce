<?php
/**
 * this is the bootstrap of unittest
 */
define('WORDPRESS_PATH', dirname(__DIR__)."/wp-config.php");

//require the wordpress files.
require_once WORDPRESS_PATH;

// require the package autoload 
require_once __DIR__."/vendor/autoload.php";
