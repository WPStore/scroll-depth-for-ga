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
 * @todo
 *
 * @since 0.0.1
 */
class ScrollDepth {

	public $version = '0.0.1';

	public $file = __FILE__;


	protected static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	} // END instance()

	/**
	 * Constructor. Hooks all interactions to initialize the class.
	 *
	 * @since 0.0.1
	 *
	 * @return void
	 */
	public function __construct() {

		register_activation_hook( __FILE__, array( '\\WPStore\\ScrollDepth', 'activation' ) );

		// Initiate classes for all requests
//		new \WPStore\WebAnalytics\Init();

		// Frontend
		if ( ! is_admin() ) {
			new \WPStore\ScrollDepth\Frontend();
		} // END if

		// WP-Admin
		if ( is_admin() ) {

//			new \WPStore\ScrollDepth\Admin();

		} // END if

		// WP-Admin/Network
		if ( is_network_admin() ) {

//			new \WPStore\ScrollDepth\Network();

		} // END if

	} // END __construct()


	/** Helper functions ******************************************************/

	/**
	 * Get the plugin path.
	 *
	 * @since  0.0.1
	 * @return string
	 */
	public function get_version() {
		return $this->version;
	}

	public function get_file() {
		return $this->file;
	}

	public function activation( $network_wide ) {
		
//		if ( ! class_exists( '\\WPStore\\ScrollDepth\\Activation' ) ) {
//			require_once( dirname( __FILE__ ) . 'ScrollDepth/Activation.php' );
//		}

		$activate = new \WPStore\ScrollDepth\Activation( __FILE__ );
		$activate->check_parent_plugin( 'class', '\\WPStore\\WebAnalytics' );

	}

} // END class


function ScrollDepth() {
	return \WPStore\ScrollDepth::instance();
}

ScrollDepth();
