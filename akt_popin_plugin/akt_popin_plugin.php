<?
/*

Plugin Name: akt_popin_plugin

Plugin URI: http://akeltable.fr

Description: Le plugin popin image wordpress pour Akeltable

Version: 0.1

Author: sjcpi.net

Author URI: http://akeltabe.fr/

License: GNU

*/
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

define( 'AKT_POPIN_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'AKT_POPIN_VERSION', '1.0' );

require_once( AKT_POPIN_PLUGIN_DIR . 'class.akt_popin_plugin.php' );

function akt_popin_plugin_load(){

    if(is_admin()) //load admin files only in admin
        require_once(AKT_POPIN_PLUGIN_DIR.'includes/admin.php');

    // require_once(MSP_HELLOWORLD_DIR.'includes/core.php');
}

akt_popin_plugin_load();
