<?php
/***
 *
 *
 * Plugin Name: High Team
 * Plugin URI: https://github.com/ernieshigh/samples
 * Description: Create Team members and template
 * version: 0.0.66 
 * Author: ernie
 * Author URI: https://ernieshigh.dev
 * License: GPLv2
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       high-team
 *
 *
 ***/

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

define('high_team_version', '0.0.66');


function activate_high_team()
{
	require_once plugin_dir_path(__FILE__) . 'inc/class-high-team-activator.php';
	high_team_Activator::activate();
}


function deactivate_high_team()
{
	require_once plugin_dir_path(__FILE__) . 'inc/class-high-team-deactivator.php';
	high_team_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_high_team');
register_deactivation_hook(__FILE__, 'deactivate_high_team');

require plugin_dir_path(__FILE__) . 'inc/class-high-team.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function load_high_team()
{

	$plugin = new high_team();
	$plugin->load();

}
load_high_team();


