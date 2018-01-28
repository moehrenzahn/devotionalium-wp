<?php
/*
Plugin Name:  Devotionalium
Plugin URI:   https://devotionalium.com/wordpress/
Description:  Include today's bible verses from devotionalium.com, with rich support for original languages.
Version:      1.0
Author:       Max Melzer
Author URI:   http://moehrenzahn.de/en/about
License:      GPLv2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  devotionalium
Domain Path:  /languages
*/
if (!defined('ABSPATH')) {
    die('Invalid access');
};

require_once('src/Autoloader.php');
spl_autoload_register('Devotionalium\Autoloader::load');
load_plugin_textdomain(
    'devotionalium',
    false,
    basename(dirname(__FILE__)).'/languages'
);

new \Devotionalium\Plugin();
