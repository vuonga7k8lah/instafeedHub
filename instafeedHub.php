<?php
/**
 * Plugin Name: Wiloke InstaFeed Hub
 * Author: Wiloke
 * Version: 1.1.0
 * Language: wiloke-instaFeed-hub
 */
define('client_id', '140642897910557');
define('client_secret', '8bdb356cf99792a6b82620d6df541f8c');
define('redirect_uri', 'https://dfecea3b4c16.ngrok.io/wiloke/');

require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php';
new \IGHUB\Controllers\MenuController();