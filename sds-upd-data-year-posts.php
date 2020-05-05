<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://sdstudio.top
 * @since             1.0.0
 * @package           Sds_Upd_Data_Year_Posts
 *
 * @wordpress-plugin
 * Plugin Name:       SDStudio Updater Data Year Posts
 * Plugin URI:        https://techblog.sdstudio.top/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Serhii Dudchenko
 * Author URI:        https://sdstudio.top
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       sds-upd-data-year-posts
 * Domain Path:       /languages
 */


if( !function_exists('get_plugin_data') ){
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}
add_action('admin_init', 'SDStudioPluginName' );
function SDStudioPluginName(){
    $data = get_plugin_data(__FILE__);
    return $data['Name']; // выведет название плагина
}
add_action('admin_init', 'SDStudioPluginVersion' );
function SDStudioPluginVersion(){
    $data = get_plugin_data(__FILE__);
    return  $data['Version']; // выведет название плагина
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
define( 'SDS_UPD_DATA_YEAR_POSTS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-sds-upd-data-year-posts-activator.php
 */
function activate_sds_upd_data_year_posts() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sds-upd-data-year-posts-activator.php';
	Sds_Upd_Data_Year_Posts_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-sds-upd-data-year-posts-deactivator.php
 */
function deactivate_sds_upd_data_year_posts() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sds-upd-data-year-posts-deactivator.php';
	Sds_Upd_Data_Year_Posts_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_sds_upd_data_year_posts' );
register_deactivation_hook( __FILE__, 'deactivate_sds_upd_data_year_posts' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-sds-upd-data-year-posts.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_sds_upd_data_year_posts() {

	$plugin = new Sds_Upd_Data_Year_Posts();
	$plugin->run();

}
run_sds_upd_data_year_posts();

require_once plugin_dir_path( __FILE__ ) . '_Redux_Framework_Parser_POST_data.php';
require_once plugin_dir_path( __FILE__ ) . '_taxonomy.php';
require_once plugin_dir_path( __FILE__ ) . '_WORKER.php';
