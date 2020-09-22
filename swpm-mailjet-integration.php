<?php

/*
Plugin Name: SWPM Mailjet Integration
Version: 1.0.1
Plugin URI: https://github.com/Th0masL/swpm-mailjet-integration/
Author: Thomas L.
Author URI: https://github.com/Th0masL/
Description: This addon allows you to use Mailjet with SWPM membership plugin (https://simple-membership-plugin.com/)
*/

//Direct access to this file is not permitted
if (!defined('ABSPATH')){
    exit; //Exit if accessed directly
}

// Define some global variables
define('SWPM_MAILJET_INTEGRATION_PLUGIN_FOLDER', dirname(__FILE__));
define('SWPM_MAILJET_INTEGRATION_PLUGIN_NAME', basename(dirname(__FILE__)));

// Load the class of the plugin
require_once ('classes/class.swpm-mailjet-integration.php');

// Add an action to load the plugin
add_action('plugins_loaded', "swpm_mailjet_integration_plugins_loaded");

// Load the plugin
function swpm_mailjet_integration_plugins_loaded() {
    new SwpmMailjetIntegration();
}
