<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://edisonave.com
 * @since             1.0.0
 * @package           Wp_Lead_Stream
 *
 * @wordpress-plugin
 * Plugin Name:       WP Lead Stream
 * Plugin URI:        http://edisonave.com/wpleadstream
 * Description:       Lead forwarding and tracking plugin. Supports integration with Gravity Forms and Twillio for call forwarding
 * Version:           1.2
 * Author:            Tom Printy (Edison Aveneue Consulting LLC)
 * Author URI:        http://edisonave.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-lead-stream
 * Domain Path:       /languages
 */

//Freemius
if ( ! function_exists( 'wls_fs' ) ) {
    // Create a helper function for easy SDK access.
    function wls_fs() {
        global $wls_fs;

        if ( ! isset( $wls_fs ) ) {
            // Include Freemius SDK.
            require_once dirname(__FILE__) . '/freemius/start.php';

            $wls_fs = fs_dynamic_init( array(
                'id'                  => '3923',
                'slug'                => 'wp-lead-stream',
                'type'                => 'plugin',
                'public_key'          => 'pk_341badafeb1f5caa44192c8717187',
                'is_premium'          => false,
                'has_addons'          => false,
                'has_paid_plans'      => false,
                'menu'                => array(
                    'slug'           => 'wp_lead_stream_admin',
                    'account'        => false,
                    'support'        => false,
                ),
            ) );
        }

        return $wls_fs;
    }

    // Init Freemius.
    //wls_fs();
    // Signal that SDK was initiated.
    //do_action( 'wls_fs_loaded' );
} 
 
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WP_LEAD_STREAM_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-lead-stream-activator.php
 */
function activate_wp_lead_stream() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-lead-stream-activator.php';
	Wp_Lead_Stream_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-lead-stream-deactivator.php
 */
function deactivate_wp_lead_stream() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-lead-stream-deactivator.php';
	Wp_Lead_Stream_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_lead_stream' );
register_deactivation_hook( __FILE__, 'deactivate_wp_lead_stream' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-lead-stream.php';


/**
 * This is where we load the Gravity forms stuff
 */
 require plugin_dir_path( __FILE__ ) . 'includes/class-wp-lead-stream-gfaddon.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_lead_stream() {
	$plugin = new Wp_Lead_Stream();
	$plugin->run();
}
run_wp_lead_stream();






