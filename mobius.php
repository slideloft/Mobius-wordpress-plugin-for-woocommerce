<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://mwplug.com
 * @since             1.0.0
 * @package           Mobius
 *
 * @wordpress-plugin
 * Plugin Name:       Mobius Payment plugin (woocommerce)
 * Plugin URI:        http://mwplug.com
 * Description:       This is a Mobius Payment plugin for Wordpress WooCommerce, easy way to charge users on your website.
 * Version:           1.0.0
 * Author:            mwplug
 * Author URI:        http://mwplug.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mwplug.com
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mobius-activator.php
 */
function activate_mobius() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mobius-activator.php';
	Mobius_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mobius-deactivator.php
 */
function deactivate_mobius() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mobius-deactivator.php';
	Mobius_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mobius' );
register_deactivation_hook( __FILE__, 'deactivate_mobius' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mobius.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mobius() {

	$plugin = new Mobius();
	$plugin->run();

}
run_mobius();
