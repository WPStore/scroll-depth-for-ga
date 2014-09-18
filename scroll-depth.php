<?php
/**
 * @author    WPStore.io <code@wpstore.io>
 * @copyright Copyright (c) 2014, WPStore.io
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GPL-2.0+
 * @package   WPStore\ScrollDepth
 * @version   0.0.1
 */
/*
Plugin Name: Scroll Depth for Google Analyticator
Plugin URI:  https://www.wpstore.io/plugins/scroll-depth-for-ga/
Description: @todo
Version:     0.0.1
Author:      WPStore.io
Author URI:  https://www.wpstore.io
License:     GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: scroll-depth
Domain Path: /languages

    Scroll Depth for Google Analyticator
    Copyright (C) 2014 WPStore.io (https://www.wpstore.io)

    This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace WPStore;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) { exit; }

require 'libs/autoload.php';

/**
 * @since 0.0.1
 */
class ScrollDepth {

	/**
	 * Current version of the plugin.
	 *
	 * @since 0.0.1
	 * @var string
	 */
	public $version = '0.0.1';

	/**
	 * Main File of the plugin.
	 *
	 * @since 0.0.1
	 * @var string
	 */
	public $file = __FILE__;

	/**
	 * Holds a copy of the object for easy reference.
	 *
	 * @since 0.0.1
	 * @static
	 * @var object $_instance
	 */
	protected static $_instance = null;

	/**
	 * Main ScrollDepth Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since  0.0.1
	 * @static
	 * @return object Instance
	 */
	public static function get_instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;

	} // END instance()

	/**
	 * Constructor. Hooks all interactions to initialize the class.
	 *
	 * @since  0.0.1
	 * @return void
	 */
	public function __construct() {

		register_activation_hook( __FILE__, array( '\\WPStore\\ScrollDepth', 'activation' ) );

		// Frontend
		if ( ! is_admin() ) {
			new \WPStore\ScrollDepth\Frontend();
		} // END if

		// WP-Admin
		if ( is_admin() ) {
			new \WPStore\ScrollDepth\Admin();
		} // END if

	} // END __construct()


	/** Helper functions ******************************************************/

	/**
	 * Get the plugin version.
	 *
	 * @since  0.0.1
	 * @return string
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Get the main plugin file.
	 *
	 * @since  0.0.1
	 * @return string
	 */
	public function get_file() {
		return $this->file;
	}

	/**
	 * Pre-Activation checks
	 *
	 * Checks if Google Analyticator is present otherwise prevents activation
	 *
	 * @since  0.0.1
	 * @param  bool $network_wide
	 * @return void
	 */
	public function activation( $network_wide ) {

		$parent = 'google-analyticator/google-analyticator.php';

		if ( $network_wide && ! is_plugin_active_for_network( $parent ) ) {

			// More verbose error message
			wp_die( __( 'Google Analyticator needs to be activate network-wide to allow this extension to be activated network-wide too!', 'scroll-depth' ) );

		}

		if ( is_plugin_inactive( $parent ) ) { // safe enough? // if ( ! class_exists( 'Google_Analyticator' ) ) {

			// More verbose error message
			wp_die( __( 'Requirements are not met! Download and activate Google Analyticator to use this plugin.', 'scroll-depth' ) );

		}

	} // END activation()

} // END class

/**
 * Returns the main instance
 *
 * @since  0.0.1
 * @return object ScrollDepth Instance
 */
function ScrollDepth() {
	return \WPStore\ScrollDepth::get_instance();
}

ScrollDepth();
