<?php
/**
 * @package  RDextVc
 */
/*
Plugin Name: RD Extensions Bundle For King Composer
Plugin URI: https://wordpress.org/plugins/rd-extensions-bundle-for-king-composer/
Description: Add new elements to For King Composer, includes: Draggable Timeline, Metro Carousel and Tile, Zooma or Magnify, Carousel & Gallery, Tabs, Accordion, Image Hotspot with Tooltip, Parallax, Medium Gallery, Stack Gallery, Testimonial Carousel, iHover, Scrolling Notification and Masonry Gallery etc.
Author: codecans
Version: 1.4.8
Requires at least: 3.8
Tested up to:      4.9.8
Author URI: https://codecans.com
License: GPL2
Text Domain: rdext_vc
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/

// prevent direct access
defined( 'ABSPATH' ) or die( 'Hey, you can\t access this file, you silly human!' );

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'kingcomposer/kingcomposer.php' ) ) {

	// Vendor Composer Autoload
	if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
		require_once dirname( __FILE__ ) . '/vendor/autoload.php';
	}

	//The code that runs during plugin activation
	function activate_rdextkc_plugin() {
		Rdextkc\Base\Activate::activate();
	}

	register_activation_hook( __FILE__, 'activate_rdextkc_plugin' );


	//The code that runs during plugin deactivation
	function deactivate_rdextkc_plugin() {
		Rdextkc\Base\Deactivate::deactivate();
	}

	register_deactivation_hook( __FILE__, 'deactivate_rdextkc_plugin' );
	
		//The code that runs during plugin Uninstall
	function uninstall_rdextkc_plugin() {
		Rdextkc\Base\Uninstall::uninstall();
	}

	register_uninstall_hook( __FILE__, 'uninstall_rdextkc_plugin' );
	
	
	// Redirect Settings Page After Plugin Activation
	function rdextkc_activation_redirect( $plugin ) {
		if ( $plugin == plugin_basename( __FILE__ ) ) {
			exit( wp_redirect( admin_url( 'admin.php?page=rdextkc_kingcomposer' ) ) );
		}
	}

	add_action( 'activated_plugin', 'rdextkc_activation_redirect' );

	// Register ALL Services
	if ( class_exists( 'Rdextkc\\Init' ) ) {
		Rdextkc\Init::register_services();
	}
	// Register Extensions Services
	if ( class_exists( 'Rdextkc\\Extensions' ) ) {
		Rdextkc\Extensions::register_services();
	}

} else {
	function rdextkc_required_plugin() {
		if ( is_admin() && current_user_can( 'activate_plugins' ) && ! is_plugin_active( 'kingcomposer/kingcomposer.php' ) ) {
			add_action( 'admin_notices', 'rdextkc_required_plugin_notice' );

			deactivate_plugins( plugin_basename( __FILE__ ) );

			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}
		}
	}
	add_action( 'admin_init', 'rdextkc_required_plugin' );

	function rdextkc_required_plugin_notice() {
		?>
        <div class="error"><p>Error! you need to install or activate the <a href="https://wordpress.org/plugins/kingcomposer/">King Composer</a> plugin to run "<span style="font-weight: bold;">RD Extension Bundle For King Composer</span>" plugin.</p></div><?php
	}
}