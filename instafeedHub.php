<?php
/**
 * Plugin Name: Wiloke InstaFeed Hub
 * Author: Wiloke
 * Version: 1.1.0
 * Language: wiloke-instaFeed-hub
 */
define('ESC_HTML_TEXT_DOMAIN', 'wiloke-instaFeedHub');

require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php';
new \IGHUB\Controllers\MenuController();