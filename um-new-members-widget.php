<?php
/**
 * Plugin Name: UM New Members widget
 * Plugin URI: https://really-simple-plugins.com/um-new-members/
 * Description: Add-on to Ultimate member to show latest new members in a widget or with shortcode
 * Version: 1.0.11
 * Text Domain: um-new-members-widget
 * Domain Path: /languages
 * Author: Really Simple Plugins
 * Author URI: https://really-simple-plugins.com

 */


 /*  Copyright 2014  Rogier Lankhorst

     This program is free software; you can redistribute it and/or modify
     it under the terms of the GNU General Public License, version 2, as
     published by the Free Software Foundation.

     This program is distributed in the hope that it will be useful,
     but WITHOUT ANY WARRANTY; without even the implied warranty of
     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     GNU General Public License for more details.

     You should have received a copy of the GNU General Public License
     along with this program; if not, write to the Free Software
     Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

defined('ABSPATH') or die("you do not have acces to this page!");

require_once(ABSPATH.'wp-admin/includes/plugin.php');
$plugin_data = get_plugin_data( __FILE__ );

define('um_new_members_url', plugin_dir_url(__FILE__ ));
define('um_new_members_path', plugin_dir_path(__FILE__ ));
define('um_new_members_plugin', plugin_basename( __FILE__ ) );
define('um_new_members_extension', $plugin_data['Name'] );
define('um_new_members_version', $plugin_data['Version'] );
define('umnm_plugin_website', 'https://www.really-simple-plugins.com' );
define( 'umnm_product_name', 'UM New Members Widget' );

require_once( um_new_members_path . 'core/widgets/new-members-widget.php');
require_once( um_new_members_path . 'core/class-shortcode.php');
require_once( um_new_members_path . 'core/class-enqueue.php');
require_once( um_new_members_path . 'admin/admin.php');

$umnm_shortcodes = new umnm_shortcodes;
$umnm_enqueue    = new umnm_enqueue;

function umnm_plugins_loaded() {
  load_plugin_textdomain( 'um-new-members-widget', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'umnm_plugins_loaded', 0 );
