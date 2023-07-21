<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://tirony.me
 * @since             1.0.0
 * @package           Darkpress
 *
 * @wordpress-plugin
 * Plugin Name:       darkpress
 * Plugin URI:        https://tirony.me
 * Description:       A great darkmode plugin for wordpress
 * Version:           1.0.0
 * Author:            t.i.rony
 * Author URI:        https://tirony.me
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       darkpress
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'DARKPRESS_VERSION', '1.0.0' );
define( 'DARKPRESS_BASE_NAME', plugin_basename( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-darkpress-activator.php
 */
function activate_darkpress() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-darkpress-activator.php';
	Darkpress_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-darkpress-deactivator.php
 */
function deactivate_darkpress() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-darkpress-deactivator.php';
	Darkpress_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_darkpress' );
register_deactivation_hook( __FILE__, 'deactivate_darkpress' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-darkpress.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_darkpress() {

	$plugin = new Darkpress();
	$plugin->run();

}
run_darkpress();
